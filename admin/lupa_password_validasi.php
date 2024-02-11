<?php
include "library/inc.connection.php";

// set untuk email 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'library/PHPMailer/src/Exception.php';
require 'library/PHPMailer/src/PHPMailer.php';
require 'library/PHPMailer/src/SMTP.php';

#random password
function randomPassword()
{
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

if (isset($_POST['btnForgotPassword'])) {
  $pesanError = array();
  if (trim($_POST['txtEmail']) == "") {
    $pesanError[] = "Data <b> Username </b> tidak boleh kosong !";
  }

  $txtEmail = $_POST['txtEmail'];
  $txtPassword = randomPassword();

  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError) >= 1) {

    echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
    $noPesan = 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div>";

    // Tampilkan lagi halaman 
    include "lupa_password.php";
  } else {
    #  CEK KE TABEL 
      $mySql = "SELECT * FROM master_user u WHERE u.user_email='" . $txtEmail . "'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));
    $myData = mysqli_fetch_array($myQry);
   $jumlahdata = mysqli_num_rows($myQry);
    # JIKA SUKSES
    if (mysqli_num_rows($myQry) >= 1) {

      $Nama = $myData['user_fullname'];
      $Username = $myData['user_name'];
      $ID = $myData['user_id'];
      

      // Kirim email customer
      // Inisialisasi PHPMailer
      $mail = new PHPMailer(true);

      try {
        // Set pengaturan SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com'; // Ganti dengan alamat SMTP server Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'official@sf-selfstudio.com'; // Ganti dengan username SMTP Anda
        $mail->Password = 'SELFstudio123!'; // Ganti dengan password SMTP Anda
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;

        // Set informasi pengirim dan penerima
        $mail->setFrom('official@sf-selfstudio.com', 'Self Studio');
        $mail->addAddress($txtEmail); // Ganti dengan alamat email tujuan


        // set lokasi template email
        $template_file = "email_lupa_password.php";
        // cek template nya ready atau tidak
        if (file_exists($template_file))
          $email_message = file_get_contents($template_file);
        else
          die("Unable to locate your template file");

        // set variable 
        $swap_var = array(
          "{SITE_ADDR}" => "https://www.heytuts.com",
          "{EMAIL_LOGO}" => "uploads/NEX.png",
          "{EMAIL_TITLE}" => "Notification",
          "{CUSTOM_URL}" => "https://www.heytuts.com/web-dev/php/send-emails-with-php-from-localhost-with-sendmail",
          "{CUSTOM_IMG}" => "https://i1.wp.com/www.heytuts.com/wp-content/uploads/2019/05/thumbnail_Send-emails-with-php-from-localhost-with-SendMail.png",
          "{NAME}" => 'Hi ' . $Nama,
          "{PASSWORD}" =>  $txtPassword
        );

        // ngecek variable dan timpah dengan variable yang di cek , seperti SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
        foreach (array_keys($swap_var) as $key) {
          if (strlen($key) > 2 && trim($swap_var[$key]) != '')
            $email_message = str_replace($key, $swap_var[$key], $email_message);
        }
        // Set informasi email
        $mail->isHTML(true);
        $mail->MsgHTML($email_message);
        $mail->Subject = 'Admin Reset Password';

        // Kirim email
        $mail->send();
        // echo "Email berhasil dikirim";
      } catch (Exception $e) {
        echo "Gagal mengirim email: {$mail->ErrorInfo}";
      }
      // end kirim email customer

      // convert ke MD5
      $txtPassword = MD5($txtPassword);
      // update password di database
      $mySql = "UPDATE `master_user` SET `user_pass`='$txtPassword' WHERE user_id ='$ID'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));

      // Jika berhasil
      $pesanSukses[] = "Email Sudah Dikirimkan, silahkan cek email kamu.";

      echo "<div class='panel-body'><div class='alert alert-success' align='center'>";
      $noPesan = 0;
      foreach ($pesanSukses as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
      }
      echo "</div>";

 
      echo "<meta http-equiv='refresh' content='0; url=?page=Forgot-Password&s=ok'>";

      // Refreshaa

    } else {
      $pesanError[] = "Email Tidak Terdaftar";

      echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
      $noPesan = 0;
      foreach ($pesanError as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
      }
      echo "</div>";

      // Tampilkan lagi form login
      echo "<meta http-equiv='refresh' content='0; url=?page=Forgot-Password&s=notok'>";
    }
  }
} // End POST
