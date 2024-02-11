<?php
$_SESSION['SES_TITLE'] = "Position";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Position";


$Position  = isset($_GET['id']) ?  preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']) : '';
$mySql  = "SELECT * FROM master_position WHERE position_id='$Position'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL

$dataPosition  = isset($_POST['txtPosition']) ? $_POST['txtPosition'] : $myData['position'];

# Tombol cancel
if (isset($_POST['btnCancel'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Position'>";
}
# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['txtPosition']) == "") {
    $pesanError[] = "Data <b>Position</b> tidak boleh kosong !";
  }



  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtPosition = $_POST['txtPosition'];

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
    $mySql    = "UPDATE master_position SET position='$txtPosition', updated_by='$ses_nama'   , updated_date=now() WHERE position_id = '$Position'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error());
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Position'>";
    }
    exit;
  }
} // Penutup Tombol Submit


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
              <h2 class="content-header-title float-start mb-0">Add Position</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Position</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Position Add</a>
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
                <div class="content-header-right text-md-end col-md-12 col-12 d-md-block d-none">
                  <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1">
                    <div class="row">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="position-column">Position</label>
                              <input type="text" id="position-column" name='txtPosition' class="form-control" placeholder="Position" value="<?php echo $dataPosition ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-7 my-5">
                          <a type="reset" href="?page=Position" class="btn btn-outline-dark me-2">Discard</a>
                          <button type="submit" name="btnSubmit" class="btn btn-warning me-3">Save</button>
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
<!-- END: Content-->

<?php
include "footer_difan.php";
?>