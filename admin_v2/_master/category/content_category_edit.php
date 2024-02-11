<?php
$_SESSION['SES_TITLE'] = "Book Category";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Content-Categories";

# Tombol cancel
if (isset($_POST['btnCancel'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Content-Categories'>";
}
# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['txtCategory1']) == "") {
    $pesanError[] = "Data <b>Categories</b> tidak boleh kosong !";
  }



  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtID     = $_POST['txtID'];
  $txtIDOld   = $_POST['txtIDOld'];
  $txtCode    = $_POST['txtCode'];
  $txtCodeOld    = $_POST['txtCodeOld'];
  $txtCategory1 = $_POST['txtCategory1'];
  $txtCategory2 = $_POST['txtCategory2'];
  $txtCategory3 = $_POST['txtCategory3'];
  $txtCategory4 = $_POST['txtCategory4'];
  $txtCategory5 = $_POST['txtCategory5'];
  $txtCategory6 = $_POST['txtCategory6'];


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
    $kodeBaru  = $_POST['txtCode'];

    $ses_nama  = $_SESSION['SES_NAMA'];

    $mySql    = "UPDATE master_category SET category_id='$txtCode', category_level_1='$txtCategory1', category_level_2='$txtCategory2',category_level_3='$txtCategory3',category_level_4='$txtCategory4',category_level_5='$txtCategory5',category_level_6='$txtCategory6', updated_by='$ses_nama', updated_date=now() WHERE category_id='$txtCodeOld'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Content-Categories&code=$txtCategory1'>";
    }
    exit;
  }
} // Penutup Tombol Submit
$ID    = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtID'];
$Code  = isset($_GET['id2']) ?  $_GET['id2'] : $_POST['txtCode'];
$mySql  = "SELECT * FROM master_category WHERE category_id='$ID'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataCode    = $myData['category_id'];
$dataID      = $myData['id'];
$dataCategory1  = isset($_POST['txtCategory1']) ? $_POST['txtCategory1'] : $myData['category_level_1'];
$dataCategory2  = isset($_POST['txtCategory2']) ? $_POST['txtCategory2'] : $myData['category_level_2'];
$dataCategory3  = isset($_POST['txtCategory3']) ? $_POST['txtCategory3'] : $myData['category_level_3'];
$dataCategory4  = isset($_POST['txtCategory4']) ? $_POST['txtCategory4'] : $myData['category_level_4'];
$dataCategory5  = isset($_POST['txtCategory5']) ? $_POST['txtCategory5'] : $myData['category_level_5'];
$dataCategory6  = isset($_POST['txtCategory6']) ? $_POST['txtCategory6'] : $myData['category_level_6'];


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
              <h2 class="content-header-title float-start mb-0">Edit Categories</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Categories Management</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Categories Edit</a>
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
                  <!-- <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1"> -->
                  <div class="row">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="No">No</label>
                            <input type="text" id="no" class="form-control" placeholder="No" value="<?php echo $dataID ?>" name="txtID" />
                            <input class="form-control" name="txtIDOld" type="hidden" value="<?php echo $dataID; ?>" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="code">Code</label>
                            <input type="text" id="code" class="form-control" placeholder="Code" name="txtCode" value="<?php echo $dataCode ?>" />
                            <input class="form-control" name="txtCodeOld" type="hidden" value="<?php echo $dataCode; ?>" maxlength="10" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category1">Category 1</label>
                            <select name="txtCategory1" class="form-control" id="">
                              <option value="DIGITAL" <?php echo ($dataCategory1 == 'DIGITAL') ? 'selected' : ''; ?>>DIGITAL</option>
                              <option value="PHYSICAL" <?php echo ($dataCategory1 == 'PHYSICAL') ? 'selected' : ''; ?>>PHYSICAL</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category2">Category 2</label>
                            <input type="text" id="category2" class="form-control" name="txtCategory2" value="<?php echo $dataCategory2 ?>" placeholder="Category 2" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category3">Category 3</label>
                            <input type="text" id="category3" class="form-control" name="txtCategory3" value="<?php echo $dataCategory3 ?>" placeholder="Category 3" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category4">Category 4</label>
                            <input type="text" id="category4" class="form-control" name="txtCategory4" value="<?php echo $dataCategory4 ?>" placeholder="Category 4" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category5">Category 5</label>
                            <input type="text" id="category5" class="form-control" name="txtCategory5" value="<?php echo $dataCategory5 ?>" placeholder="Category 5" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category6">Category 6</label>
                            <input type="text" id="category6" class="form-control" name="txtCategory6" value="<?php echo $dataCategory6 ?>" placeholder="Category 6" />
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Content-Categories" class="btn btn-outline-dark me-2">Discard</button>
                        <button type="submit" class="btn btn-warning me-3" name="btnSubmit">Save</button>
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
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_difan.php";
?>