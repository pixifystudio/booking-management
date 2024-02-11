<?php
$_SESSION['SES_TITLE'] = "Edit Jenis";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Jenis-Edit";
$id = $_GET['id'];

?>
<div class="app-content content ">
  <?php

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    $dataJenis  = $_POST['txtJenis'];

    # VALIDASI JAM 
    # CEK DATA LAMA APAKAH SUDAH PERNAH ADA NAMA TSB DI DATABASE 
  
    $mySqlCek  = "SELECT jenis FROM master_jenis_head WHERE  jenis ='$dataJenis'";
    $myQryCek  = mysqli_query($koneksidb, $mySqlCek)  or die("Query ambil data salah : " . mysqli_error());
    $JumlahDataCek = mysqli_num_rows($myQryCek);
    if ($JumlahDataCek >= 1) {
      $pesanError[] = "Data tersebut sudah diset sebelumnya";
    }


    # CEK DATA AMBIL NAMA LAMA NYA

    $mySqlCek  = "SELECT jenis FROM master_jenis_head WHERE  id ='$id'";
    $myQryCek  = mysqli_query($koneksidb, $mySqlCek)  or die("Query ambil data salah : " . mysqli_error());
    $DataCek = mysqli_fetch_array($myQryCek);

    $dataJenisOld = $DataCek['jenis'];


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
      // Jika tidak menemukan error, update data ke database
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "UPDATE master_jenis_head set jenis ='$dataJenis' where id='$id'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

      // update ke anak id nya
      $mySql    = "UPDATE master_jenis set jenis ='$dataJenis' where jenis='$dataJenisOld'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jenis&s=edited'>";
      }
      exit;
    }
  } // Penutup Tombol Submit

  # MASUKKAN DATA KE VARIABEL
  # TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
  $Code  = isset($_GET['id']) ?  $_GET['id'] : '';
  $mySql  = "SELECT * FROM master_jenis_head WHERE id='$Code'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL
  $dataCode    = $myData['id'];
  $dataJenis    = $myData['jenis'];
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
            <h2 class="content-header-title float-start mb-0">Jenis</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Edit</a>
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
                          <div class="form-group">
                            <label>Jenis <span class="required">*</span></label>
                            <input type="text" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtJenis' value="<?php echo $dataJenis; ?>" aria-describedby="basic-addon-name" />
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-7 my-5">
                      <a type="button" href="?page=Master-Jenis" class="btn btn-warning me-2">Kembali</a>
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