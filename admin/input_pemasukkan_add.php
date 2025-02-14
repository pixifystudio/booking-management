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
    $dataNominal  = $_POST['txtNominal'];
    $dataMetode  = $_POST['txtMetode'];
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

      // Record Stock InOut
      $mySql   = "INSERT INTO `transaction`( `keterangan`, `nominal`,`qty`,`metode`,`booking_detail_id`, `status`, `updated_date`)
     VALUES ('$dataKeterangan','$dataNominal','$dataQty','$dataMetode','','$dataStatus',now())";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));

    //   // Jika tidak menemukan error, update data ke database
    //   $ses_nama  = $_SESSION['SES_NAMA'];
    //   $mySql    = "UPDATE master_product set  `stock` ='$dataTotal' where id='$id'";
    //   $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));


      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Input-Pengeluaran'>";
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
            <h2 class="content-header-title float-start mb-0">Input Pengeluaran</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a></a>
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
                          <label>Keterangan</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Keterangan" aria-label="Name" name='txtKeterangan'  aria-describedby="basic-addon-name" />
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Tipe</label>
                             <select class="select2 form-select" name="txtMetode" aria-label="Default select example" autocomplete="off" required>
                                          <option value="">Pilih</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Transfer Bank">Transfer Bank</option>
                                          <option value="QRIS">QRIS</option>
                                        </select>
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Nominal</label>
                          <input type="number" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtNominal' aria-describedby="basic-addon-name" />
                        </div>
                      </div>

                    </div>
                    <div class="col-7 my-5">
                      <a type="button" href="?page=Master-Product-Price" class="btn btn-warning me-2">Kembali</a>
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