<?php
$id  = isset($_POST['cari']) ?  $_POST['cari'] : '';
$Paket  = isset($_POST['txtPaket']) ?  $_POST['txtPaket'] : '';
$Background  = isset($_POST['txtBackground']) ?  $_POST['txtBackground'] : '';
$date  = isset($_POST['txtDate']) ?  $_POST['txtDate'] : '';
$date2  = isset($_POST['txtDate2']) ?  $_POST['txtDate2'] : '';
$datefrom  = isset($_POST['txtFrom']) ?  $_POST['txtFrom'] : '';
$dateto  = isset($_POST['txtTo']) ?  $_POST['txtTo'] : '';



if (isset($_POST['btnHistory'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Management-History&from=" . $datefrom  . "&to=" . $dateto  . "&p=" . $Paket   . "&b=" . $Background  . "'>";
}
