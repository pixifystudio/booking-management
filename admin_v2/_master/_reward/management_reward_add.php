<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
?>
<div class="app-content content ">
   <?php
   # Tombol Submit diklik
   if (isset($_POST['btnSubmit'])) {
      # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
      $pesanError = array();
      if (trim($_POST['txtValue']) == "") {
         $pesanError[] = "Data <b>User</b> tidak boleh kosong !";
      }

      # GET MAX NEXT ID
      $mySql  = "SELECT MAX(id) as max_id FROM `master_reward`";
      $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
      $myData = mysqli_fetch_array($myQry);
      $dataCode  = $myData['max_id'] + 1;

      if ($_FILES['txtPhoto']['name'] != "") {
         $file_size2   = $_FILES['txtPhoto']['size'];
         $file_type2  = $_FILES['txtPhoto']['type'];
         $tmp2 = explode('.', $_FILES['txtPhoto']['name']);
         $file_ext2 = end($tmp2);
         // Valid extension
         $valid_ext = array('png', 'jpeg', 'jpg');
         $file_name   = $dataCode . '.' . $file_ext2;
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
      // $id    = $_POST['txtCode'];
      $txtName  = $_POST['txtName'];
      $dataValue  = $_POST['txtValue'];
      $txtPhoto    = $file_photo;
      $txtStatus     = $_POST['txtStatus'];

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
         $mySql    = "INSERT INTO master_reward (icon, nama, value, status, updated_by, updated_date)
						VALUES ('$txtPhoto', '$txtName', '$dataValue', '$txtStatus', '$ses_nama', now())";
         $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
         if ($myQry) {
            echo "<meta http-equiv='refresh' content='0; url=?page=Management-Reward&msg=add'>";
         }
         exit;
      }
   } // Penutup Tombol Submit

   # MASUKKAN DATA KE VARIABEL
   // $id    = isset($_POST['txtCode']) ? $_POST['txtCode'] : '';
   $dataStatus    = isset($_POST['txtStatus']) ? $_POST['txtStatus'] : '';
   $dataValue  = isset($_POST['txtValue']) ? $_POST['txtValue'] : '';
   $dataName  = isset($_POST['txt']) ? $_POST['txt'] : '';
   $dataPhoto    = isset($_POST['txtPhoto']) ? $_POST['txtPhoto'] : '';
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
                  <h2 class="content-header-title float-start mb-0">Reward & Badges Management</h2>
                  <div class="breadcrumb-wrapper">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=Management-Reward"> Reward Management</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#"> Reward Management Add</a>
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
                                       <div class="mb-1">
                                          <label class="form-label" for="code">Name</label>
                                          <input class="form-control" placeholder="Name" name="txtName" type="text" value="<?php echo $dataName; ?>" maxlength="100" required />
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                       <div class="mb-1">
                                          <label class="form-label" for="status">Photo</label>
                                          <input class="form-control" type="file" name="txtPhoto" value="<?php echo $dataPhoto; ?>" />
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                       <div class="mb-1">
                                          <label class="form-label" for="value">Value</label>
                                          <input class="form-control" placeholder="value" name="txtValue" type="number" value="<?php echo $dataValue; ?>" maxlength="100" required />
                                       </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                       <label class="form-label" for="basicSelect">Status</label>
                                       <select name="txtStatus" class="form-control" tabindex="-1">
                                          <option value="Active">Active</option>
                                          <option value="Not Active">Not Active</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-7 my-3">
                                    <a type="button" href="?page=Management-Reward" class="btn btn-outline-dark me-2">Cancel</a>
                                    <button type="submit" name="btnSubmit" class="btn btn-warning me-3">Save</button>
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