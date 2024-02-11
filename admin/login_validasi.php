<?php
include "library/inc.connection.php";
if (isset($_POST['btnLogin'])) {
  $pesanError = array();
  if (trim($_POST['txtUser']) == "") {
    $pesanError[] = "Data <b> Username </b> tidak boleh kosong !";
  }
  if (trim($_POST['txtPassword']) == "") {
    $pesanError[] = "Data <b> Password </b> tidak boleh kosong !";
  }

  # Baca variabel form
   $txtUser   = $_POST['txtUser'];
  //$txtUser 	= str_replace("'","&acute;",$txtUser);

  $txtPassword = $_POST['txtPassword'];
  //$txtPassword= str_replace("'","&acute;",$txtPassword);

  # Baca IP Address

  $ip = $_SERVER['REMOTE_ADDR'];

  #$cmbLevel	=$_POST['cmbLevel'];

  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError) >= 1) {

    echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
    $noPesan = 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div>";

    // Tampilkan lagi form login
    include "login.php";
  } else {
    # LOGIN CEK KE TABEL USER LOGIN
      $mySql = "SELECT * FROM master_user u WHERE u.user_name='" . $txtUser . "' 
					AND u.user_pass='" . md5($txtPassword) . "' ";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));
    $myData = mysqli_fetch_array($myQry);
  $jumlahdata = mysqli_num_rows($myQry);
    # JIKA LOGIN SUKSES
    if (mysqli_num_rows($myQry) >= 1) {
      $_SESSION['SES_LOGIN'] = $myData['user_name'];
      $_SESSION['SES_USERID'] = $myData['user_id'];
      $_SESSION['SES_NAMA'] = $myData['user_fullname'];
      $_SESSION['SES_PHOTO'] = $myData['user_photo'];
      $_SESSION['SES_BRANCH'] = '';
      $_SESSION['SES_GROUP'] = $myData['user_group'];
      // $mySql2 = "SELECT photo FROM hrd_employee_personal WHERE nik='" . $myData['user_id'] . "'";
      // $myQry2  = mysqli_query($koneksidb, $mySql2)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
      // $myData2 = mysqli_fetch_array($myQry2);
      // $_SESSION['SES_PHOTO'] = $myData2['photo'];

      // Jika yang login Administrator
 
      echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking'>";

      // Refreshaa

    } else {
      $pesanError[] = "Username atau password yang dimasukan salah !";
      if (empty($_SESSION['failed_login'])) {
        $_SESSION['failed_login'] = 1;
      } else {
        $_SESSION['failed_login']++;
      }

      echo "<div class='panel-body'><div class='alert alert-warning' align='center'>";
      $noPesan = 0;
      foreach ($pesanError as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
      }
      echo "</div>";

      // Tampilkan lagi form login
      include "login.php";
    }
  }
} // End POST
