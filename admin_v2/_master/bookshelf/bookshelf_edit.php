<?php
$_SESSION['SES_TITLE'] = "Book Category";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Content-Categories";
$ID = $_GET['id'];

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
    $mySql    = "UPDATE master_racking set racking_number = '$txtShelfID', racking_capacity='$txtCapacity', racking_status='$txtStatus', updated_by='$ses_nama' ,updated_date=now()
    WHERE racking_id ='$ID'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Bookshelf'>";
    }
    exit;
  }
} // Penutup Tombol Submit

$mySql  = "SELECT * FROM master_racking WHERE racking_id='$ID'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataNumber    = $myData['racking_number'];
$dataCapacity    = $myData['racking_capacity'];
$dataStatus    = $myData['racking_status'];



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
              <h2 class="content-header-title float-start mb-0">Add Location Book</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Location Book</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Location Book Add</a>
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
                              <label class="form-label" for="code">Shelf Number</label>
                              <input type="text" id="code" class="form-control" value="<?php echo $dataNumber ?>" placeholder="Code" name="txtShelfID" required />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="category2">Capacity</label>
                              <input type="number" id="category2" class="form-control" name="txtCapacity" value="<?php echo $dataCapacity ?>" placeholder="Capacity" />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="category2">Status</label>
                              <select name="txtStatus" class="form-control">
                                <?php

                                $mySql = "SELECT * FROM master_status WHERE status_group='Data'";
                                $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                while ($dataRow = mysqli_fetch_array($dataQry)) {
                                  if ($dataRow['status_id'] == $dataStatus) {
                                    $cek = " selected";
                                  } else {
                                    $cek = "";
                                  }
                                  echo "<option value='$dataRow[status_id]' $cek>$dataRow[status_name]</option>";
                                }
                                ?>
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