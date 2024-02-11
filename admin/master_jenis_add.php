<?php
include "library/inc.connection.php";

# ADD KE DATABASE BOOKING

$txtJenis = $_POST['txtJenis'];

    $mySql   = "INSERT INTO `master_jenis_head`( `jenis`, `updated_by`, `updated_date`)
     VALUES ('$txtJenis','ADMIN', now())";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jenis&s=tambah'>";
    }
    else {
      echo "Query Gagal";
    }
 
