<?php
include "library/inc.connection.php";

# ADD KE DATABASE BOOKING

$txtJam = $_POST['txtJam'];

    $mySql   = "INSERT INTO `jadwal`( `jam`, `status`, `availability`, `updated_by`)
     VALUES ('$txtJam','1','0','ADMIN')";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jadwal&s=tambah'>";
    }
    else {
      echo "Query Gagal";
    }
 
