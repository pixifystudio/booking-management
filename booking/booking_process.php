<?php
include "library/inc.connection.php";

// set untuk email 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'library/PHPMailer/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';



if (isset($_POST['btnSubmit'])) {

 
  $pesanError = array();
  // set validasi
  // if (trim($_POST['txtUser']) == "") {
  //   $pesanError[] = "Data <b> Username </b> tidak boleh kosong !";
  // }
  // if (trim($_POST['txtPassword']) == "") {
  //   $pesanError[] = "Data <b> Password </b> tidak boleh kosong !";
  // }

  # Baca variabel form
  $txtTanggal   = $_POST['txtTanggal'];
  // ganti format tanggal
  $originalDate = $txtTanggal;
  $txtTanggal = date("Y-m-d", strtotime($originalDate));
  $txtWaktu = $_POST['txtWaktu'];
  $txtJenis = $_POST['txtJenis'];
  $txtPaket = $_POST['txtPaket'];
  $txtBackground = $_POST['txtBackground'];
  $txtNama = $_POST['txtNama'];
  $txtEmail = $_POST['txtEmail'];
  $txtWhatsapp = $_POST['txtWhatsapp'];
  $txtInstagram = isset($_POST['txtInstagram']) ? $_POST['txtInstagram'] : '';
  $txtStatus = 'Dibuat';
  $txtToken = $_POST['txtToken'];

  // ambil nama hari ini
  function hari_ini()
  {
    $txtTanggal = $_POST['txtTanggal'];
    $hari = date("D", strtotime($txtTanggal));

    switch ($hari) {
      case 'Sun':
        $hari_ini = "Minggu";
        break;

      case 'Mon':
        $hari_ini = "Senin";
        break;

      case 'Tue':
        $hari_ini = "Selasa";
        break;

      case 'Wed':
        $hari_ini = "Rabu";
        break;

      case 'Thu':
        $hari_ini = "Kamis";
        break;

      case 'Fri':
        $hari_ini = "Jumat";
        break;

      case 'Sat':
        $hari_ini = "Sabtu";
        break;

      default:
        $hari_ini = "Tidak di ketahui";
        break;
    }

    return "<b>" . $hari_ini . "</b>";
  }

  // ambil nama hari ini
  function bulan_ini()
  {
    $txtTanggal = $_POST['txtTanggal'];
    $bulan = date("M", strtotime($txtTanggal));

    switch ($bulan) {
      case 'Jan':
        $bulan_ini = "Januari";
        break;

      case 'Feb':
        $bulan_ini = "Februari";
        break;

      case 'Mar':
        $bulan_ini = "Maret";
        break;

      case 'Apr':
        $bulan_ini = "April";
        break;

      case 'May':
        $bulan_ini = "Mei";
        break;

      case 'Jun':
        $bulan_ini = "Juni";
        break;

      case 'Jul':
        $bulan_ini = "Juli";
        break;

      case 'Aug':
        $bulan_ini = "Agustus";
        break;

      case 'Sep':
        $bulan_ini = "September";
        break;

      case 'Oct':
        $bulan_ini = "Oktober";
        break;

      case 'Nov':
        $bulan_ini = "November";
        break;

      case 'Dec':
        $bulan_ini = "Desember";
        break;

      default:
        $bulan_ini = "Tidak di ketahui";
        break;
    }

    return "<b>" . $bulan_ini . "</b>";
  }

  // set ke variabel 
  $hari_ini = hari_ini();
  $bulan_ini = bulan_ini();
  $tanggal_ini = date("j", strtotime($txtTanggal));
  $tahun_ini = date("Y", strtotime($txtTanggal));

  $date_ini = $tanggal_ini . ' ' . $bulan_ini . ' ' . $tahun_ini;

  

  // cek apakah detail transaksi dengan token yang diset sudah ada di database
  $mySql  = "SELECT token from booking where token ='$txtToken'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
  $JumlahData = mysqli_num_rows($myQry);

  // jalankan proses submit jika data = 0
  if ($JumlahData >= 1) {
    $pesanError[] = "Tidak good";
  }

  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError) >= 1) {

    // ambil data sesuai token yang sudah ada di set
    $mySql  = "SELECT id, token from booking where token ='$txtToken'";
    $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
    $Ambildata = mysqli_fetch_array($myQry);

    $last_id = $Ambildata['id'];
    // echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
    // $noPesan = 0;
    // foreach ($pesanError as $indeks => $pesan_tampil) {
    //   $noPesan++;
    //   echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    // }
    // echo "</div>";

    // Tampilkan booking success tanpa submit
    echo "<meta http-equiv='refresh' content='0; url=?page=Booking-Success&id=$last_id'>";
  } else {
    # INSERT KE DATABASE BOOKING DAN KIRIM EMAIL



    $mySql = "INSERT INTO `booking`( `nama`, `email`, `no_wa`, `jenis`, `paket`, `background`, `instagram`, `tanggal`, `jam`, `status`, `updated_date`,`token`) VALUES 
      ('$txtNama','$txtEmail','$txtWhatsapp','$txtJenis','$txtPaket','$txtBackground','$txtInstagram','$txtTanggal','$txtWaktu','$txtStatus', now(),'$txtToken') ";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Query Insert Salah : " . mysqli_error($koneksidb));

    #ambil harga
    $mySqlPrice = "SELECT * FROM `master_product` where `name` = '$txtPaket' ORDER BY id DESC LIMIT 1";
    $myQryPrice = mysqli_query($koneksidb, $mySqlPrice) or die("Query Insert Salah : " . mysqli_error($koneksidb));
    $DataPrice = mysqli_fetch_array($myQryPrice);

    $txtNominal = $DataPrice['price'];



    // ambil id terakhir
    $mySqlID = "SELECT * FROM `booking` ORDER BY id DESC LIMIT 1";
    $myQryID = mysqli_query($koneksidb, $mySqlID) or die("Query Insert Salah : " . mysqli_error($koneksidb));
    $DataID = mysqli_fetch_array($myQryID);

    $id_terakhir = $DataID['id'];
    
    #detail
    $mySql = "INSERT INTO `booking_detail`( `booking_id`, `item`, `nominal`,`qty`, `updated_date`,`updated_by`,`metode_pembayaran`) VALUES 
      ('$id_terakhir','$txtPaket','$txtNominal','1', now(),'$txtNama','Cash') ";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Query Insert Salah : " . mysqli_error($koneksidb));

    // Kirim email customer
    // Inisialisasi PHPMailer
    $mail = new PHPMailer(true);

    $urlcancel = "https://pixify.id/booking/?page=Booking-Cancel&id=" . $id_terakhir;


    try {
      // Set pengaturan SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.hostinger.com'; // Ganti dengan alamat SMTP server Anda
      $mail->SMTPAuth = true;
      $mail->Username = 'official@pixify.id'; // Ganti dengan username SMTP Anda
      $mail->Password = 'ForwardDigiCraft@123'; // Ganti dengan password SMTP Anda
      $mail->SMTPSecure = 'TLS';
      $mail->Port = 587;

      // Set informasi pengirim dan penerima
      $mail->setFrom('official@pixify.id', 'Pixify');
      $mail->addAddress($txtEmail); // Ganti dengan alamat email tujuan


      // set lokasi template email
      $template_file = "email_customer.php";
      // cek template nya ready atau tidak
      if (file_exists($template_file))
        $email_message = file_get_contents($template_file);
      else
        die("Unable to locate your template file");

      $formfields = "Nama: $txtNama <br>
Pilihan Paket: $txtPaket <br>
Alamat Email: $txtEmail <br>
No WhatsApp: $txtWhatsapp <br>
Background: $txtBackground <br>
Username Instagram: $txtInstagram <br>
Jenis Foto: $txtJenis <br>";

      // set variable 
      $swap_var = array(
        "{SITE_ADDR}" => "https://www.heytuts.com",
        "{EMAIL_LOGO}" => "uploads/NEX.png",
        "{EMAIL_TITLE}" => "Notification",
        "{CUSTOM_URL}" => "https://www.heytuts.com/web-dev/php/send-emails-with-php-from-localhost-with-sendmail",
        "{CUSTOM_IMG}" => "https://i1.wp.com/www.heytuts.com/wp-content/uploads/2019/05/thumbnail_Send-emails-with-php-from-localhost-with-SendMail.png",
        "{NAME}" => 'Hi ' . $txtNama,
        "{DATE}" =>  $date_ini,
        "{TIME}" =>  $txtWaktu,
        "{HARI}" =>  $hari_ini,
        "{FORMFIELDS}" => $formfields,
        "{URLTIKETV}" => $urlcancel

      );

      // ngecek variable dan timpah dengan variable yang di cek , seperti SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
      foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($swap_var[$key]) != '')
          $email_message = str_replace($key, $swap_var[$key], $email_message);
      }



      // Set informasi email
      $mail->isHTML(true);
      $mail->MsgHTML($email_message);
      $mail->Subject = 'Booking Kamu Telah Dikonfirmasi!';

      // Kirim email
      $mail->send();
      // echo "Email berhasil dikirim";
    } catch (Exception $e) {
      echo "Gagal mengirim email: {$mail->ErrorInfo}";
    }

    // end kirim email customer


    // Kirim email customer
    // Inisialisasi PHPMailer
    $mail2 = new PHPMailer(true);

    try {
      // Set pengaturan SMTP
      $mail2->isSMTP();
      $mail2->Host = 'smtp.hostinger.com'; // Ganti dengan alamat SMTP server Anda
      $mail2->SMTPAuth = true;
      $mail2->Username = 'official@pixify.id'; // Ganti dengan username SMTP Anda
      $mail2->Password = 'ForwardDigiCraft@123'; // Ganti dengan password SMTP Anda
      $mail2->SMTPSecure = 'TLS';
      $mail2->Port = 587;

      // Set informasi pengirim dan penerima
      $mail2->setFrom('official@pixify.id', 'Pixify');
      $mail2->addAddress('pixify.capture@gmail.com'); // Ganti dengan alamat email tujuan
      // $mail2->addAddress('dickypramanasukma@gmail.com'); // Ganti dengan alamat email tujuan



      // set lokasi template email
      $template_file = "email_admin.php";
      // cek template nya ready atau tidak
      if (file_exists($template_file))
        $email_message = file_get_contents($template_file);
      else
        die("Unable to locate your template file");

      $formfields = "Nama: $txtNama <br>
Pilihan Paket: $txtPaket <br>
Alamat Email: $txtEmail <br>
No WhatsApp: $txtWhatsapp <br>
Background: $txtBackground <br>
Username Instagram: $txtInstagram <br>
Jenis Foto: $txtJenis <br>";

      // set variable 
      $swap_var = array(
        "{SITE_ADDR}" => "https://www.heytuts.com",
        "{EMAIL_LOGO}" => "uploads/NEX.png",
        "{EMAIL_TITLE}" => "Notification",
        "{CUSTOM_URL}" => "https://www.heytuts.com/web-dev/php/send-emails-with-php-from-localhost-with-sendmail",
        "{CUSTOM_IMG}" => "https://i1.wp.com/www.heytuts.com/wp-content/uploads/2019/05/thumbnail_Send-emails-with-php-from-localhost-with-SendMail.png",
        "{NAME}" => 'Hi ' . $txtNama,
        "{DATE}" =>  $date_ini,
        "{TIME}" =>  $txtWaktu,
        "{HARI}" =>  $hari_ini,
        "{FORMFIELDS}" => $formfields
      );

      // ngecek variable dan timpah dengan variable yang di cek , seperti SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
      foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($swap_var[$key]) != '')
          $email_message = str_replace($key, $swap_var[$key], $email_message);
      }



      // Set informasi email
      $mail2->isHTML(true);
      $mail2->MsgHTML($email_message);
      $mail2->Subject = $txtNama . ' booking';

      // Kirim email
      $mail2->send();
      // echo "Email berhasil dikirim";
    } catch (Exception $e) {
      echo "Gagal mengirim email: {$mail2->ErrorInfo}";
    }

    // ambil id nya
    $last_id = mysqli_insert_id($koneksidb);
    # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Booking-Success&id=$id_terakhir'>";
    } else {
      echo "Query Gagal";
    }
  }
} // End POST
