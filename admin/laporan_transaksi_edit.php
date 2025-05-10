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



?>
<div class="app-content content ">
  <?php

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    $dataNominal  = $_POST['txtNominal'];
    $dataItem  = $_POST['txtItem'];
    $dataType  = $_POST['txtType'];
    $dataBookingDetailID  = $_POST['txtBookingDetailID'];
    $dataQty  = $_POST['txtQty'];
    $dataMetode  = $_POST['txtMetode'];
    $dataStatus = "OUT";




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
      $mySql   = "UPDATE `transaction` SET keterangan= '$dataItem', nominal = '$dataNominal', qty = '$dataQty', metode ='$dataMetode' WHERE `id` = '$detailid'";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
        if ($dataBookingDetailID >0) {
          # code...
      $mySql   = "UPDATE `booking_detail` SET item= '$dataItem',  nominal = '$dataNominal', qty = '$dataQty', metode ='$dataMetode' WHERE `booking_detail_id` = '$dataBookingDetailID'";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
        }
      } else {
      $mySql   = "UPDATE `data_qr_detail` SET item= '$dataItem',  nominal = '$dataNominal', qty = '$dataQty', metode_pembayaran ='$dataMetode' WHERE `id` = '$detailid'";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));


      }

      // Record Stock InOut

    //   // Jika tidak menemukan error, update data ke database
    //   $ses_nama  = $_SESSION['SES_NAMA'];
    //   $mySql    = "UPDATE master_product set  `stock` ='$dataTotal' where id='$id'";
    //   $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));


      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Finance-Laporan-Transaksi'>";
      }
      exit;
    }
  } // Penutup Tombol Submit

  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay">
  </div>
  <div class="header-navbar-shadow">
  </div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0"><Em>Edit Transaksi</Em></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>
                </a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class="row">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-bottom">
                <div class="content-header-right col-md-12 col-12 d-md-block d-none">

                  <div class="row">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3 col-12">
                          <label>Item</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Keterangan" aria-label="Name" name='txtItem' value="<?= $item ?>"  aria-describedby="basic-addon-name" />
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Tipe</label>
                             <select class="select2 form-select" name="txtMetode" aria-label="Default select example" autocomplete="off" required>
                                          <option value="">Pilih</option>
                                          <option value='Cash' <?php echo ($metodepembayaran == 'Cash') ? 'selected' : ''; ?> >Cash</option>
                                          <option value='Transfer Bank' <?php echo ($metodepembayaran == 'Transfer Bank') ? 'selected' : ''; ?> >Transfer Bank</option>
                                          <option value='QRIS' <?php echo ($metodepembayaran == 'QRIS') ? 'selected' : ''; ?> >QRIS</option>

                                        </select>
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Nominal</label>
                          <input type="number" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtNominal' value="<?= $nominal ?>" aria-describedby="basic-addon-name" />
                          <input type="hidden" id="basic-addon-name" class="form-control" placeholder="" aria-label="" name='txtType' value="<?= $type ?>" aria-describedby="basic-addon-name" />
                          <input type="hidden" id="basic-addon-name" class="form-control" placeholder="" aria-label="" name='txtBookingDetailID' value="<?= $booking_detail_id ?>" aria-describedby="basic-addon-name" />
                        </div>
                         <div class="col-md-3 col-12">
                          <label>Qty</label>
                          <input type="number" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtQty' value="<?= $qty ?>" aria-describedby="basic-addon-name" />
                        </div>
                      </div>

                    </div>
                    <div class="col-7 my-5">
                      <a type="button" href="?page=Finance-Laporan-Transaksi" class="btn btn-warning me-2">Kembali</a>
                      <button type="submit" name="btnSubmit" class="btn btn-success me-3">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_v2.php";
?>