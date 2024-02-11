<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";

// set
function autofalse()
{
  global $koneksidb;
  mysqli_autocommit($koneksidb, FALSE);
}
function commit()
{
  global $koneksidb;
  mysqli_commit($koneksidb);
}
function rollback()
{
  global $koneksidb;
  mysqli_rollback($koneksidb);
}



# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  // if (trim($_POST['txtCategory1']) == "") {
  //   $pesanError[] = "Data <b>Category</b> tidak boleh kosong !";
  // }



  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtType = $_POST['txtType'];
  $txtWriter = $_POST['txtWriter'];
  $txtTitleIN = addslashes($_POST['txtTitleIN']);
  $txtBodyIN = addslashes($_POST['txtBodyIN']);
  $txtTitleEN = addslashes($_POST['txtTitleEN']);
  $txtBodyEN = addslashes($_POST['txtBodyEN']);
  $txtSource = addslashes($_POST['txtSource']);

  $file_cover = "photo.png";
  $wmax = 300;
  $hmax = 300;


  if ($_FILES['txtFileCover']['name'] != "") {

    $file_size2   = $_FILES['txtFileCover']['size'];
    $file_tmp2   = $_FILES['txtFileCover']['tmp_name'];
    $file_type2  = $_FILES['txtFileCover']['type'];
    $tmp2 = explode('.', $_FILES['txtFileCover']['name']);
    $file_ext2 = end($tmp2);



    // Valid extension
    $valid_ext = array(
      'png', 'jpeg', 'jpg'
    );
    $txtTitleINFoto = substr($txtTitleIN, 0,5); // PHP di Duniailkom
    $file_name   = $txtTitleINFoto . '.' . $file_ext2;
    // Location
    $location = "../uploads/cover_information/" . $file_name;
    move_uploaded_file($_FILES["txtFileCover"]["tmp_name"], $location);
    // file extension
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);


    // menentukan nama image setelah dibuat
    $resize_image = $location;
    // tentukan ukuran width yang diharapkan
    $width_size = 720;
    // mendapatkan ukuran width dan height dari image
    list($width, $height) = getimagesize($location);

    // mendapatkan nilai pembagi supaya ukuran skala image yang dihasilkan sesuai dengan aslinya
    $k = $width / $width_size;

    // menentukan width yang baru
    // $newwidth = $width / $k;
    $newwidth = 720;

    // menentukan height yang baru
    // $newheight = $height / $k;
    $newheight = 480;

    // fungsi untuk membuat image yang baru
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if ($file_ext2 == 'png') {
      $source = imagecreatefrompng($location);
    }else {
      $source = imagecreatefromjpeg($location);
    }

    // men-resize image yang baru
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


    if ($file_ext2 == 'png') {
      imagepng($thumb, $resize_image);
    } else {
      imagejpeg($thumb, $resize_image);
    }
    // menyimpan image yang baru
    imagejpeg($thumb, $resize_image);

    imagedestroy($thumb);
    imagedestroy($source);

    // Check extension
    if (in_array($file_extension, $valid_ext)) {

      $file_cover = $file_name;
    } else {
      $pesanError[] = "Invalid file type.";
    }
  }

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
    try {
      autofalse();
      # SIMPAN DATA KE DATABASE. 


      $ses_nama  = $_SESSION['SES_NAMA'];

      $mySql    = "INSERT INTO information (type, writer, title_in, title_en,
						description_in,description_en,source, file ,status, updated_date, updated_by)
						VALUES ('$txtType','$txtWriter','$txtTitleIN','$txtTitleEN', '$txtBodyIN', 
						'$txtBodyEN', '$txtSource','$file_cover','Active', now(),'$ses_nama')";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
      if (!$myQry)
        throw new Exception("Form gagal diinput. code:d1. " . mysqli_error($koneksidb));
      commit();
      echo "<meta http-equiv='refresh' content='0; url=?page=Information&msg=add'>";
      exit;
    } catch (Exception $e) {
      rollback();
      // echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Physical-Add-Add&id=$Code&info=" . $e->getMessage() . "'>";
      // echo $e->getMessage();
    }
  }
} // Penutup Tombol Submit
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Upload</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Information, News & Article</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Upload</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Bootstrap Validation -->
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">

      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">General Information</h4>
          </div>
          <div class="card-body">

            <div class="mb-1">
              <label class="form-label" for="select-country1">Type</label>
              <select class="form-select" id="select-country1" name="txtType" required>
                <option value="">Select Type</option>
                <option value="Article">Article</option>
                <option value="News">News</option>
                <option value="Information">Information</option>

              </select>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Writer/Uploaders Name</label>

              <input type="text" name="txtWriter" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon-name" required />
            </div>
            <h2>Content</h2>
            <span><i class="flag-icon flag-icon-id"></i> Indonesia</span>
            <br>
            <br>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Title </label>

              <input type="text" name="txtTitleIN" id="basic-addon-name" class="form-control" placeholder="Title" aria-label="Name" aria-describedby="basic-addon-name" required />
            </div>
            <div class="mb-1">
              <label class="d-block form-label" for="validationBioBootstrap">Body</label>
              <textarea class="form-control" id="validationBioBootstrap" name="txtBodyIN" rows="3" required></textarea>
            </div>
            <span><i class="flag-icon flag-icon-us"></i> English</span>
            <br>
            <br>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Title </label>

              <input type="text" name="txtTitleEN" id="basic-addon-name" class="form-control" placeholder="Title" aria-label="Name" aria-describedby="basic-addon-name" required />
            </div>

            <div class="mb-1">
              <label class="d-block form-label" for="validationBioBootstrap">Body</label>
              <textarea class="form-control" id="validationBioBootstrap" name="txtBodyEN" rows="3" required></textarea>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Source </label>

              <input type="text" name="txtSource" id="basic-addon-name" class="form-control" placeholder="Source" aria-label="Name" aria-describedby="basic-addon-name" required />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Add Photo </label>
              <input type="file" id="basic-addon-name" name="txtFileCover" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon-name" required />
              <span> <i>*Recommended Resolution 720px x 360px</i> </span>

            </div>
            <!-- <div class="mb-1">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="validationCheckBootstrap" required />
                <label class="form-check-label" for="validationCheckBootstrap">Agree to our terms and conditions</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div> -->
            <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>
<!-- /Bootstrap Validation -->

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