<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_user.php";
$_SESSION['SES_PAGE'] = "?page=Organization";

$user_id = $_SESSION['SES_USERID'];

# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['txtPassword']) != trim($_POST['txtPassword'])) {
    $pesanError[] = "Data <b>Password Baru</b> tidak sama !";
  }

  $file_photo = "photo.png";
  $wmax = 300;
  $hmax = 300;

  if ($_FILES['txtPhoto']['name'] != "") {
    $file_size2   = $_FILES['txtPhoto']['size'];
    echo  $file_tmp2   = $_FILES['txtPhoto']['tmp_name'];
    $file_type2  = $_FILES['txtPhoto']['type'];
    $tmp2 = explode('.', $_FILES['txtPhoto']['name']);
    $file_ext2 = end($tmp2);
    // Valid extension
    $valid_ext = array('png', 'jpeg', 'jpg');
    $file_name   = $user_id . '.' . $file_ext2;
    // Location
    $location = "../uploads/user/" . $file_name;
    move_uploaded_file($_FILES["txtPhoto"]["tmp_name"], $location);
    // file extension
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // Check extension
    if (in_array($file_extension, $valid_ext)) {

      $file_photo = $file_name;
    } else {
      $pesanError[] = "Invalid file type.";
    }
  }
  # BACA DATA DALAM FORM, masukkan datake variabel

  $txtPassword  = $_POST['txtPassword'];
  $txtPassLama  = $_POST['txtPassLama'];
  //$txtPhoto		= $file_photo;	
  # VALIDASI USER LOGIN (USERNAME), jika sudah ada akan ditolak
  //$mySql="SELECT * FROM master_user WHERE user_name='$txtUsername' AND NOT(user_name='".$_POST['txtUsernameLm']."')";
  //$cekQry=mysqli_query($koneksidb,$mySql) or die ("Eror Query".mysqli_error()); 
  //if(mysqli_num_rows($cekQry)>=1){
  //	$pesanError[] = "USERNAME<b> $txtUsername </b> sudah ada, ganti dengan yang lain";
  //}

  # Cek Password baru
  if (trim($txtPassword) == "") {
    $sqlPasword = ", password='$txtPassLama'";
  } else {
    $sqlPasword = ",  password='" . md5($txtPassword) . "'";
    if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $txtPassword)) {
    } else {
      $pesanError[] = "Data <b>Password</b> minimal 8 karakter, ada huruf besar, huruf dan angka !";
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


    // echo $sqlPasword;
    // exit;
    # SIMPAN DATA KE DATABASE. 
    // Jika tidak menemukan error, simpan data ke database
    $ses_nama  = $_SESSION['SES_NAMA'];
    $mySql    = "UPDATE master_user SET user_photo='$file_photo', updated_by='$ses_nama'  , updated_date=now()
					    $sqlPasword 
						WHERE user_id = '$user_id'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Profile-User'>";
    }
    exit;
  }
} // Penutup Tombol Submit



$Code  = $_SESSION['SES_LOGIN'];
$mySql  = "SELECT * FROM master_user u, master_company c WHERE u.company_id=c.company_id AND u.username='$Code'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
$myData = mysqli_fetch_array($myQry);
# MASUKKAN DATA KE VARIABEL
$dataCode    = $myData['user_id'];
$dataCompanyName = isset($_POST['txtCompany']) ? $_POST['txtCompany'] : $myData['company_name'];
$dataUsergroup  = isset($_POST['txtUsergroup']) ? $_POST['txtUsergroup'] : $myData['user_group'];
$dataStatus    = isset($_POST['txtStatus']) ? $_POST['txtStatus'] : $myData['user_status'];
$dataUsername  = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username'];
$dataFullname  = isset($_POST['txtFullname']) ? $_POST['txtFullname'] : $myData['user_fullname'];
$dataPassword  = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : $myData['password'];
$dataPhoto    = $myData['user_photo'];
$dataEmail    = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : $myData['user_email'];
$dataPhone    = isset($_POST['txtPhone']) ? $_POST['txtPhone'] : $myData['user_phone'];
$dataDivision  = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : $myData['division'];
$dataDepartment  = isset($_POST['txtDepartment']) ? $_POST['txtDepartment'] : $myData['department'];
$dataUnit  = isset($_POST['txtUnit']) ? $_POST['txtUnit'] : $myData['unit'];
$dataBranch  = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : $myData['branch'];
$dataPosition  = isset($_POST['txtPosition']) ? $_POST['txtPosition'] : $myData['position'];




?>
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Akun</h2>
            <div class="breadcrumb-wrapper">
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class='row'>
        <div class="col-5 col-sm-3 mb-1">
        </div>
        <div class="col-12 col-sm-12 mb-1">
          <!-- profile -->
          <div class="card">
            <div class="card-header border-bottom">
            </div>
            <div class="card-body py-2 my-25">
              <!-- header section -->
              <div class="d-flex">
                <a href="#" class="me-25">
                  <img src="../uploads/user/<?php echo $dataPhoto ?>" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                </a>
                <!-- upload and reset button -->
                <div class="d-flex align-items-end mt-75 ms-1">
                  <div>
                  </div>
                </div>
                <!--/ upload and reset button -->
              </div>
              <!--/ header section -->

              <!-- form -->
              <br>
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountFirstName">Password Lama</label>
                    <input type="password" class="form-control" id="accountFirstName" name="txtPassLama" placeholder="Enter Password" value="" data-msg="Please enter first name" />
                  </div>
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountFirstName">Password Baru</label>
                    <input type="password" class="form-control" id="accountFirstName" name="txtPassword" placeholder="Enter Password" value="" data-msg="Please enter first name" />
                  </div>

                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountFirstName">File Photo</label>
                    <input type="file" class="form-control" id="accountFirstName" name="txtPhoto" />
                  </div>



                </div>

                <!--/ form -->
            </div>
          </div>
          <center>
            <div class="col-6">
              <button type="submit" name='btnSubmit' class="btn btn-warning mt-1 me-1">Simpan Perubahan</button>
              <a href="?page=Main-User" type="reset" class="btn btn-outline-secondary mt-1">Batalkan </a>
            </div>
          </center>
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
<!-- END: Content-->

<?php
include "footer_user.php";
?>