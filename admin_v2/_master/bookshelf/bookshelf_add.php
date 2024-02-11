<?php
$_SESSION['SES_TITLE'] = "Category";
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




  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtShelfID = $_POST['txtShelfID'];
  $txtShelf = $_POST['txtShelf'];
  $txtCapacity = $_POST['txtCapacity'];
  $txtStatus = $_POST['txtStatus'];


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

    $ses_nama  = $_SESSION['SES_NAMA'];
    $mySql    = "INSERT INTO master_racking ( racking_number, racking_capacity, racking_status, updated_by ,updated_date)
						VALUES ('$txtShelfID','$txtCapacity','" . $txtStatus . "', '$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Bookshelf'>";
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
              <h2 class="content-header-title float-start mb-0">Add Location</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Location</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Location Add</a>
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
                <div class="content-header-right col-md-12 col-12 d-md-block d-none">
                  <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1">
                    <div class="row">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="code">Location Name</label>
                              <input type="text" id="code" class="form-control" placeholder="Location" name="txtShelfID" value="" required />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="category2">Capacity</label>
                              <input type="number" id="category2" class="form-control" name="txtCapacity" placeholder="Capacity" />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="category2">Status</label>
                              <select name="txtStatus" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                              </select>
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