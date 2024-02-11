<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
# Tombol cancel
if (isset($_POST['btnCancel'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Organization'>";
}
# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();



  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtDivision  = $_POST['txtDivision'];
  $txtDepartment  = $_POST['txtDepartment'];
  $txtUnit     = $_POST['txtUnit'];
  $txtBranch     = $_POST['txtBranch'];


  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError) >= 1) {
    echo "&nbsp;<div class='alert alert-warning'>";
    $noPesan = 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div>";
  } else {
    # SIMPAN DATA KE DATABASE. 
    // Jika tidak menemukan error, simpan data ke database


    $ses_nama  = $_SESSION['SES_NAMA'];
    $mySql    = "INSERT INTO master_organization (branch,division,department,unit, updated_by ,updated_date)
						VALUES ('$txtBranch','$txtDivision','$txtDepartment','$txtUnit','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Organization'>";
    }
    exit;
  }
} // Penutup Tombol Submit


# MASUKKAN DATA KE VARIABEL


$dataDivision  = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : '';
$dataDepartment  = isset($_POST['txtDepartment']) ? $_POST['txtDepartment'] : '';
$dataUnit  = isset($_POST['txtUnit']) ? $_POST['txtUnit'] : '';
$dataBranch  = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : '';


?>
<!-- BEGIN: Content-->
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0">Add Organization</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Organization</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Organization Add</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-bottom">
                <div class="content-header-right  col-md-12 col-12 d-md-block d-none">
                  <div class="row">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="institution-column">Institution</label>
                            <input type="text" id="institution-column" name='txtBranch' class="form-control" placeholder="Institution" name="fname-column" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="unit-column">Unit</label>
                            <input type="text" id="unit-column" name='txtDepartment' class="form-control" placeholder="Unit" name="lname-column" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="division">Division</label>
                            <input type="text" id="division" name='txtDivision' class="form-control" name="division" placeholder="Division" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="prodi-column">Major</label>
                            <input type="text" id="prodi-column" name="txtUnit" class="form-control" name="prodi-column" placeholder="Major" />
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Organization" class="btn btn-outline-dark me-2">Discard</button>
                        <button type="submit" name="btnSubmit" class="btn btn-warning me-3">Save</button>
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
</form>

<!-- END: Content-->

<?php
include "footer_difan.php";
?>