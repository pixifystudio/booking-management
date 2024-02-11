<?php
$_SESSION['SES_TITLE'] = "Edit Jadwal";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Jadwal-Edit";
$id = $_GET['id'];

?>
<div class="app-content content ">
  <?php

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    $dataJam  = $_POST['txtJam'];
    $dataStatus  = $_POST['txtStatus'];

    # VALIDASI JAM 
    # CEK APAKAH JAM TERSEBUT SUDAH DIGUNAKAN DI HARI YANG DIPILIH
    $mySqlCek  = "SELECT jam FROM jadwal WHERE  jam ='$dataJam'";
    $myQryCek  = mysqli_query($koneksidb, $mySqlCek)  or die("Query ambil data salah : " . mysqli_error());
    $JumlahDataCek = mysqli_num_rows($myQryCek);

    if ($JumlahDataCek >= 1) {
      $pesanError[] = "Jam tersebut sudah diset sebelumnya";
    }
    #VALIDASI JAM SELESAI


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
      // Jika tidak menemukan error, simpan data ke database
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "UPDATE jadwal set jam ='$dataJam' where id='$id'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jadwal&s=edited'>";
      }
      exit;
    }
  } // Penutup Tombol Submit

  # MASUKKAN DATA KE VARIABEL
  # TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
  $Code  = isset($_GET['id']) ?  $_GET['id'] : '';
  $mySql  = "SELECT * FROM jadwal WHERE id='$Code'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL
  $dataCode    = $myData['id'];
  $dataStatus    = $myData['status'];
  $dataJam    = $myData['jam'];
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
            <h2 class="content-header-title float-start mb-0">Jadwal</h2>
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
                            <label>Jam <span class="required">*</span></label>
                            <input type="time" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtJam' value="<?php echo $dataJam; ?>" aria-describedby="basic-addon-name" />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                              <label>Status*</label>
                              <select class="form-select" id="waktu" name="txtStatus" aria-label="Default select example" autocomplete="off" required>
                                <?php if ($dataStatus == 1) { ?>
                                  <option value="1" selected>Aktif</option>
                                  <option value="0">Tidak Aktif</option>
                                <?php } else { ?>
                                  <option value="1">Aktif</option>
                                  <option value="0" selected>Tidak Aktif</option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>

                      </div>

                    </div>
                    <div class="col-7 my-5">
                      <a type="button" href="?page=Master-Jadwal" class="btn btn-warning me-2">Kembali</a>
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