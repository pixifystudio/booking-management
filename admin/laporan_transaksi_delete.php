<?php
$_SESSION['SES_TITLE'] = "Master Product Stock Adjusment";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Product-Stock-Adjusment";
$detailid = $_GET['detailid'];
$id = $_GET['id'];
$booking_detail_id = 0;
// jika $id = 0 ambil dari transaction
  if ($id==0) {
  $mySql = "SELECT * FROM `transaction` t WHERE t.id='" . $detailid . "'";
  $myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $type = 'Transaction';
  $booking_detail_id = $myData['booking_detail_id'];
  $item = $myData['keterangan'];
  $metodepembayaran = $myData['metode'];

  }
  else {
  $mySql = "SELECT * FROM `data_qr_detail` t WHERE t.id='" . $detailid . "'";
  $myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $type = 'Non-Transaction';
  $item = $myData['item'];
  $metodepembayaran = $myData['metode_pembayaran'];
  }

  
  $nominal = $myData['nominal'];
  $qty = $myData['qty'];





    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();

    $dataBookingDetailID  = $booking_detail_id;




    # VALIDASI JAM 
    # CEK DATA LAMA APAKAH SUDAH PERNAH ADA NAMA TSB DI DATABASE 

    # JIKA ADA PESAN ERROR DARI VALIDASI
    if (count($pesanError) >= 1) {
      echo "&nbsp;<div class='alert alert-warning'>";
      $noPesan = 0;
      foreach ($pesanError as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $pesan_tampil<br>";
      }
      echo "</div>";
    } else {
      # SIMPAN DATA KE DATABASE. 

      if ($dataType =='Transaction') {
         // Record Stock InOut
      $mySql   = "DELETE FROM `transaction` WHERE`id` = '$detailid'";
      // $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR TRANSACTION:  " . mysqli_error($koneksidb));
        if ($dataBookingDetailID >0) {
          # code...
      $mySql   = "DELETE FROM `booking_detail` WHERE `booking_detail_id` = '$dataBookingDetailID'";
      // $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
        }
      } else {
      $mySql   = "DELETE FROM `data_qr_detail`  WHERE `id` = '$detailid'";
      // $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR QR DETAIL:  " . mysqli_error($koneksidb));


      }
      echo $mySql;
      exit;

      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Finance-Laporan-Transaksi&s=deleted'>";
      }
      exit;
    }

