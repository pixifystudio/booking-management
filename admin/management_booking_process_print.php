<?php
$_SESSION['SES_TITLE'] = "Re-Schedule Booking";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-Booking-Rescheduled";
$id = isset($_GET['id']) ? $_GET['id'] : '';

?>
<div class="app-content content ">
  <?php

  if (isset($_POST['btnSubmit2'])) {
$txtID = $_POST['txtID'];
$txtMetode = $_POST['txtMetodePembayaran'];

# UPDATE KE DATABASE BOOKING
$mySql = "UPDATE `booking_detail` SET `metode_pembayaran`='$txtMetode' WHERE `booking_id`='$txtID'";
$myQry = mysqli_query($koneksidb, $mySql) or die("ERROR BOOKING: " . mysqli_error($koneksidb));

$mySql = "UPDATE `transaction` SET `metode`='$txtMetode' WHERE `booking_id`='$txtID'";
$myQry = mysqli_query($koneksidb, $mySql) or die("ERROR BOOKING: " . mysqli_error($koneksidb));

// cek DP 

#ambil DP
    $mySqlDP = "SELECT * FROM `booking` where id = '$txtID'";
    $myQryDP = mysqli_query($koneksidb, $mySqlDP) or die("Query Insert Salah : " . mysqli_error($koneksidb));
    $DataDP = mysqli_fetch_array($myQryDP);

    $NominalDP = isset($DataDP['dp']) ? $DataDP['dp'] :0;
    $MetodePembayaranDP = $DataDP['metode_pembayaran_dp'];
    $NamaKonsumen = $DataDP['nama'];

    if ($NominalDP  >0) {
      // keluarkan nominal sesuai nominal DP
    $mySql1   = "INSERT INTO `transaction`( `keterangan`,`nominal`,`qty`,`metode`,`booking_detail_id`, `status`,`updated_date`)
     VALUES ('Convert DP Nama Konsumen : $NamaKonsumen','$NominalDP','1','$txtMetode','$id','OUT',now())";
    $myQry1   = mysqli_query($koneksidb, $mySql1)  or die("ERROR INPUT TRANSACTION:  " . mysqli_error($koneksidb));

     $mySql1   = "INSERT INTO `transaction`( `keterangan`,`nominal`,`qty`,`metode`,`booking_detail_id`, `status`,`updated_date`)
     VALUES ('Convert DP Nama Konsumen : $NamaKonsumen','$NominalDP','1','$MetodePembayaranDP','$id','IN',now())";
    $myQry1   = mysqli_query($koneksidb, $mySql1)  or die("ERROR INPUT TRANSACTION:  " . mysqli_error($koneksidb));
    }

 

if ($myQry) {
    // Redirect ke halaman Management-Booking-Process
    echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking-Process&print=$txtID'>";

    // Membuka halaman Print-Struk di tab baru menggunakan JavaScript
    echo "<script>
            window.open('?page=Print-Struk&id=$txtID', '_blank');
          </script>";
}
}