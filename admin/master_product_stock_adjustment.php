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
    $dataJumlah  = $_POST['txtJumlah'];
    $dataType  = $_POST['txtType'];

    // validasi plus minus
    if ($dataType =='Kurang') {
      $dataJumlah = '-' . $dataJumlah;
    }

  // check stock akhir
  $mySqlStock   = "SELECT stock FROM master_product where id ='$id'";
  $myQryStock   = mysqli_query($koneksidb, $mySqlStock)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
  $myDataStock = mysqli_fetch_array($myQryStock);

  $stock_akhir = $myDataStock['stock'];
  // set default 1
  if ($stock_akhir =='') {
      $stock_akhir = 1;
  }

    // akumulasi stock akhir - / + jumlah input

    if ($dataType == 'Kurang') {
      $dataTotal = $stock_akhir - $dataJumlah;
    } else {
      $dataTotal = $stock_akhir + $dataJumlah;
    }

    if ($dataTotal <0) {
      $pesanError[] = "Jumlah stock kurang dari 0";
    }


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
      $mySql   = "INSERT INTO `master_product_stock`( `product_id`, `stock`, `updated_date`)
     VALUES ('$id','$dataJumlah',now())";
      $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));

      // Jika tidak menemukan error, update data ke database
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "UPDATE master_product set  `stock` ='$dataTotal' where id='$id'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));


      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Master-Product-Stock&s=edited'>";
      }
      exit;
    }
  } // Penutup Tombol Submit

  # MASUKKAN DATA KE VARIABEL
  # TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
  $Code  = isset($_GET['id']) ?  $_GET['id'] : '';
  $mySql  = "SELECT * FROM master_product WHERE id='$Code'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL
  $dataCode    = $myData['id'];
  $dataStock    = $myData['stock'];
  $dataName   = $myData['name'];
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
            <h2 class="content-header-title float-start mb-0">Product Adjusment</h2>
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
                          <label>Nama Produk</label>
                          <input type="text" id="basic-addon-name" class="form-control" placeholder="Nama Product" aria-label="Name" name='txtProduct' value="<?= $dataName ?>" aria-describedby="basic-addon-name" readonly />
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Tambah/Kurang</label>
                          <select class="form-select" name="txtType" aria-label="Default select example" autocomplete="off" required>
                            <option selected value="">Pilih</option>
                            <?php
                            // deklarasi selected
                            $cek = '';
                            // panggil database
                            $mySql  = "SELECT * from master_status where status_name = 'adjustment' group by status_sub_name order by status_sub_name asc";
                            $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                            while ($myData = mysqli_fetch_array($myQry)) {

                            ?>


                              <option value="<?php echo $myData['status_sub_name']  ?>"><?php echo $myData['status_sub_name'] ?></option>;
                            <?php
                            };
                            ?>
                          </select>
                        </div>
                        <div class="col-md-3 col-12">
                          <label>Jumlah</label>
                          <input type="number" id="basic-addon-name" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name='txtJumlah' aria-describedby="basic-addon-name" />
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