<?php
include "library/inc.connection.php";

# ADD KE DATABASE BOOKING

$txtProduct = $_POST['txtProduct'];
$txtType = $_POST['txtType'];
$ses_name = $_SESSION['SES_NAMA'];

    $mySql   = "INSERT INTO `master_product`( `name`, `type`, `updated_date`, `updated_by`)
     VALUES ('$txtProduct','$txtType',now(),'$ses_name')";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Product&s=tambah'>";
    }
    else {
      echo "Query Gagal";
    }
 
