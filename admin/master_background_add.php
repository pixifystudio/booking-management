<?php
include "library/inc.connection.php";

# ADD KE DATABASE BOOKING

$txtJenis = $_POST['txtJenis'];
$txtBackground = $_POST['txtBackground'];
$ses_nama = $_SESSION['SES_NAMA'];

    $mySql   = "INSERT INTO `master_background`( `background`,`jenis`, `updated_by`, `updated_date`)
     VALUES ('$txtBackground','$txtJenis','$ses_nama', now())";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Background&s=tambah'>";
    }
    else {
      echo "Query Gagal";
    }
 
