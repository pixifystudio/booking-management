<?php
include "library/inc.connection.php";

  $pesanError = array();

  # Baca variabel form
  $id   = $_GET['id'];

#cek status sebelumnya
$mySql   = "SELECT status FROM jadwal WHERE id='$id'";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);

$status = $myData['status'];
if ($status =='1') {
  $updatestatus = 0;
} else {
  $updatestatus = 1;
}
# UPDATE KE DATABASE BOOKING

    $mySql   = "UPDATE `jadwal` 
      SET `status`='$updatestatus' WHERE id='$id'";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jadwal&s=ok'>";
    }
    else {
      echo "Query Gagal";
    }
 
