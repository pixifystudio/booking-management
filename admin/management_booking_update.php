<?php
include "library/inc.connection.php";

  $pesanError = array();
  // set validasi
  // if (trim($_POST['txtUser']) == "") {
  //   $pesanError[] = "Data <b> Username </b> tidak boleh kosong !";
  // }
  // if (trim($_POST['txtPassword']) == "") {
  //   $pesanError[] = "Data <b> Password </b> tidak boleh kosong !";
  // }

  # Baca variabel form
  $id   = $_GET['id'];
# UPDATE KE DATABASE BOOKING

    $mySql   = "UPDATE `booking` 
      SET `status`='Dikonfirmasi',`updated_date`=now() WHERE id='$id'";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;


   # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking&status=confirmation'>";
    }
    else {
      echo "Query Gagal";
    }
 
