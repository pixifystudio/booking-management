<?php
include "library/inc.connection.php";

# ADD KE DATABASE BOOKING

$txtJenis = $_POST['txtJenis']; //Array of string
$txtBackground = $_POST['txtBackground'];
$ses_nama = $_SESSION['SES_NAMA'];

    // $mySql   = "INSERT INTO `master_background`( `background`,`jenis`, `updated_by`, `updated_date`)
    //  VALUES ('$txtBackground','$txtJenis','$ses_nama', now())";//Old Query for Insert 1 Paket
    $mySql = "";
    foreach ($txtJenis as $paket) {//looping paket
      $mySql .= "INSERT INTO `master_background`( `background`,`jenis`, `updated_by`, `updated_date`)
     VALUES ('$txtBackground','$paket','$ses_nama', now());";//Query insert     
    }
    $myQry   = $conn->multi_query($mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry === TRUE) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Background&s=tambah'>";
    }
    else {
      echo "Query Gagal";
    }
 
