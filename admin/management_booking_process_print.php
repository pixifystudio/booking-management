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
$txtMetode =  $_POST['txtMetodePembayaran'];
  
    # UPDATE KE DATABASE BOOKING

    $mySql   = "UPDATE `booking_detail`  SET `metode_pembayaran`='$txtMetode' WHERE `booking_id`='$txtID'";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Print-Struk&id=$txtID'>";
    }

}