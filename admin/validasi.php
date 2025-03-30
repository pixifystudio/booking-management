<?php
$id  = isset($_POST['cari']) ?  $_POST['cari'] : '';
$Paket  = isset($_POST['txtPaket']) ?  $_POST['txtPaket'] : '';
$Background  = isset($_POST['txtBackground']) ?  $_POST['txtBackground'] : '';
$date  = isset($_POST['txtDate']) ?  $_POST['txtDate'] : '';
$date2  = isset($_POST['txtDate2']) ?  $_POST['txtDate2'] : '';
$datefrom  = isset($_POST['txtFrom']) ?  $_POST['txtFrom'] : '';
$dateto  = isset($_POST['txtTo']) ?  $_POST['txtTo'] : '';
 $txtMonth  = isset($_POST['txtMonth']) ?  $_POST['txtMonth'] : '';
$txtYear  = isset($_POST['txtYear']) ?  $_POST['txtYear'] : '';
$txtMonthYear  = isset($_POST['txtMonthYear']) ?  $_POST['txtMonthYear'] : '';
$pecahMonthYear =  (explode("-",$txtMonthYear));
 $txtMonth2  = $pecahMonthYear[1];
$txtYear2  = $pecahMonthYear[0];
$txtMetode  = isset($_POST['txtMetode']) ?  $_POST['txtMetode'] : '';
$txtDateFrom  = isset($_POST['txtDateFrom']) ?  $_POST['txtDateFrom'] : '';
$txtDateUntil  = isset($_POST['txtDateUntil']) ?  $_POST['txtDateUntil'] : '';


if (isset($_POST['btnHistory'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Management-History&from=" . $datefrom  . "&to=" . $dateto  . "&p=" . $Paket   . "&b=" . $Background  . "'>";
}

if (isset($_POST['btnLaporanTransaksi'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Finance-Laporan-Transaksi&from=" . $txtDateFrom  . "&until=" . $txtDateUntil  . "&mtd=" . $txtMetode   . "'>";
}

if (isset($_POST['btnDashboard'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Dashboard&month=" . $txtMonth2  . "&year=" . $txtYear2  . "'>";
}