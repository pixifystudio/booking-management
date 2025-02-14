<?php
$_SESSION['SES_TITLE'] = "Master Product Stock Adjusment";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Product-Stock-Adjusment";
$id = $_GET['id'];

?>
<div class="app-content content ">
  <?php

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    $dataMetodeDari  = $_POST['txtMetodeDari'];
    $dataMetodeKe  = $_POST['txtMetodeKe'];
    $dataNominalDari  = $_POST['txtNominalDari'];
    $dataKeterangan  = $_POST['txtKeterangan'];
    $dataQty = 1;
    $dataStatus = "IN";




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

      // Record Stock OUT
      $mySql   = "INSERT INTO `transaction`( `keterangan`, `nominal`,`qty`,`metode`,`booking_detail_id`, `status`, `updated_date`)
     VALUES ('$dataKeterangan','$dataNominalDari','$dataQty','$dataMetodeDari','OUT','$dataStatus',now())";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));

       // Record Stock IN
      $mySql2   = "INSERT INTO `transaction`( `keterangan`, `nominal`,`qty`,`metode`,`booking_detail_id`, `status`, `updated_date`)
     VALUES ('$dataKeterangan','$dataNominalDari','$dataQty','$dataMetodeKe','IN','$dataStatus',now())";
      $myQry2   = mysqli_query($koneksidb, $mySql2)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));

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

  // ambil nominal tiap type

                                     // ambil pendapatan QRIS
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql3   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP'  AND metode='QRIS'";
                                                $myQry3 = mysqli_query($koneksidb, $mySql3);
                                                $sum_total3 = 0;
                                                $sum_total_out3 = 0;

                                                while ($myData3 = mysqli_fetch_array($myQry3)) {
                                                    $status3 =  $myData3['status'];
                                                    if ($status3 =="IN") {
                                                    $qty3 = $myData3['qty'];
                                                    $nominal3 = $myData3['nominal'];

                                                    $total3 = $nominal3 * $qty3;
                                                    $sum_total3 += $total3;
                                                    } else {
                                                    $qty3 = $myData3['qty'];
                                                    $nominal3 = $myData3['nominal'];

                                                    $total3 = $nominal3 * $qty3;
                                                    $sum_total_out3 += $total3;  
                                                    }
                                                }
                                                $sum_total3 = $sum_total3 - $sum_total_out3;


                                        // ambil pendapatan CASH
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql4   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP'  AND metode='Cash'";
                                                $myQry4 = mysqli_query($koneksidb, $mySql4);
                                                $sum_total4 = 0;
                                                $sum_total_out4 = 0;

                                                while ($myData4 = mysqli_fetch_array($myQry4)) {
                                                    $status4 =  $myData4['status'];
                                                    if ($status4 =="IN") {
                                                    $qty4 = $myData4['qty'];
                                                    $nominal4 = $myData4['nominal'];

                                                    $total4 = $nominal4 * $qty4;
                                                    $sum_total4 += $total4;
                                                    } else {
                                                    $qty4 = $myData4['qty'];
                                                    $nominal4 = $myData4['nominal'];

                                                    $total4 = $nominal4 * $qty4;
                                                    $sum_total_out4 += $total4;  
                                                    }
                                                }
                                                $sum_total4 = $sum_total4 - $sum_total_out4;



                                        // ambil pendapatan Transfer Bank
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql5   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP'  AND metode='Transfer Bank'";
                                                $myQry5 = mysqli_query($koneksidb, $mySql5);
                                                $sum_total5 = 0;
                                                $sum_total_out5 = 0;

                                                while ($myData5 = mysqli_fetch_array($myQry5)) {
                                                    $status5 =  $myData5['status'];
                                                    if ($status5 =="IN") {
                                                    $qty5 = $myData5['qty'];
                                                    $nominal5 = $myData5['nominal'];

                                                    $total5 = $nominal5 * $qty5;
                                                    $sum_total5 += $total5;
                                                    } else {
                                                    $qty5 = $myData5['qty'];
                                                    $nominal5 = $myData5['nominal'];

                                                    $total5 = $nominal5 * $qty5;
                                                    $sum_total_out5 += $total5;  
                                                    }
                                                }
                                                $sum_total5 = $sum_total5 - $sum_total_out5;

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
            <h2 class="content-header-title float-start mb-0">Pindah Nominal</h2>
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
                        <div class="col-md-4 col-12">
                          <label>Cash</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtCash' value="<?=  'Rp' . number_format($sum_total4, 0, ',', '.')?>" aria-describedby="basic-addon-name" readonly />
                        </div>

                        <div class="col-md-4 col-12">
                          <label>Transfer Bank</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtTransfer'   value="<?=  'Rp' . number_format($sum_total5, 0, ',', '.')?>" aria-describedby="basic-addon-name" readonly />
                        </div>

                        <div class="col-md-4 col-12">
                          <label>QRIS</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtQRIS'  value="<?=  'Rp' . number_format($sum_total3, 0, ',', '.')?>" aria-describedby="basic-addon-name" readonly />
                        </div>

                        <div class="col-md-4 col-12">
                          <label>Dari Metode</label>
                             <select class="select2 form-select" name="txtMetodeDari" aria-label="Default select example" autocomplete="off" required>
                                          <option value="">Pilih</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Transfer Bank">Transfer Bank</option>
                                          <option value="QRIS">QRIS</option>
                                        </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <label>Nominal</label>
                          <input type="number" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtNominalDari' aria-describedby="basic-addon-name" />
                        </div>


                        <div class="col-md-4 col-12">
                          <label>Ke Metode</label>
                             <select class="select2 form-select" name="txtMetodeKe" aria-label="Default select example" autocomplete="off" required>
                                          <option value="">Pilih</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Transfer Bank">Transfer Bank</option>
                                          <option value="QRIS">QRIS</option>
                                        </select>
                        </div>
                       <div class="col-md-12 col-12">
                          <label>Keterangan</label>
                          <textarea id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtKeterangan' aria-describedby="basic-addon-name"></textarea>
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