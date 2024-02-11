<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
$CodeId    = isset($_GET['id']) ?  $_GET['id'] : '';
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
   <?php
   # Tombol Submit diklik
   if (isset($_POST['btnSubmit'])) {
      # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError


      # BACA DATA DALAM FORM, masukkan datake variabel
      $txtArrCreate = '';
      $i = 0;
      foreach ($_POST['txtCreate'] as $key => $value) {
         if ($i != 0)
            $koma = ',';
         else
            $koma = '';
         $i++;
         $txtArrCreate = $txtArrCreate . $koma . $value;
      }

      # BACA DATA DALAM FORM, masukkan datake variabel
      $txtDepartmentArrCreate = '';

      $i = 0;
      foreach ($_POST['txtDepartmentCreate'] as $key => $value) {
         if ($i != 0)
            $koma = ',';
         else
            $koma = '';
         $i++;
         $txtDepartmentArrCreate = $txtDepartmentArrCreate . $koma . $value;
      }
      # JIKA ADA PESAN ERROR DARI VALIDASI
      if (count($pesanError) < 1) {
         # SIMPAN DATA KE DATABASE. 
         // Jika tidak menemukan error, simpan data ke database
         $ses_nama    = $_SESSION['SES_NAMA'];
         $mySql      = "UPDATE master_menu SET user_group='$txtArrCreate', 
            user_department='$txtDepartmentArrCreate', updated_by='$ses_nama', updated_date=now() WHERE menu_id = '$CodeId'";
         $myQry = mysqli_query($koneksidb, $mySql) or die("RENTAS ERP ERROR :  " . mysqli_error($koneksidb));
         if ($myQry) {
            echo "<meta http-equiv='refresh' content='0; url=?page=Role-Permission&msg=edit'>";
         }
         exit;
      }
   } // Penutup Tombol Submit


   $mySql    = "SELECT * FROM master_menu WHERE menu_id='$CodeId'";
   $myQry    = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
   $myData = mysqli_fetch_array($myQry);

   # MASUKKAN DATA KE VARIABEL
   $CodeName    = isset($_GET['id2']) ?  $_GET['id2'] : $myData['menu_title'];
   $dataArraCreate        = explode(',', $myData['user_group']);

   $dataArrayDepartmentCreate        = explode(',', $myData['user_department']);
   ?>
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
               <div class="col-12">
                  <h2 class="content-header-title float-start mb-0">User Management</h2>
                  <div class="breadcrumb-wrapper">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Roles Permission</a>
                        </li>
                        <li class="breadcrumb-item"><a>Roles Permission Edit</a>
                        </li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
         <div class="content-body">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header border-bottom">
                        <div class="content-header-left col-12">
                           <h4 class="card-title">Edit Roles</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="row mt-1">
                           <div class="col-md-3 col-12 pe-25">
                              <div class="mb-1">
                                 <label class="form-label" for="modalRoleName">Menu Name</label>
                                 <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" readonly value="<?= $CodeName ?>" placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                              </div>
                           </div>
                           <div class="col-12">
                              <h4 class="mt-2 pt-50">Role Permissions [User Group]</h4>
                              <!-- Permission table -->
                              <div class="table-responsive">
                                 <table class="table table-flush-spacing">
                                    <tbody>
                                       <?php
                                       // var_dump($dataArraRead);
                                       $myQry = mysqli_query($koneksidb, "SELECT user_group FROM master_user GROUP BY user_group ORDER BY user_group ASC");
                                       while ($myData = mysqli_fetch_array($myQry)) {
                                          if (in_array($myData['id'], $dataArraCreate)) $cekCreate = " checked";
                                          else $cekCreate = "";

                                          if (in_array($myData['id'], $dataArraRead)) $cekRead = " checked";
                                          else $cekRead = "";

                                          if (in_array($myData['id'], $dataArraUpdate)) $cekUpdate = " checked";
                                          else $cekUpdate = "";

                                          if (in_array($myData['id'], $dataArraDelete)) $cekDelete = " checked";
                                          else $cekDelete = "";
                                          // echo $cekRead;
                                       ?>
                                          <tr>
                                             <td class="text-nowrap fw-bolder"><?= $myData['user_group']; ?></td>
                                             <td>
                                                <div class="d-flex">
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekCreate ?> type="checkbox" id="CreateId[<?= $myData['id']; ?>]" name="txtCreate[<?= $myData['id']; ?>]" value="<?= $myData['id']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['user_group']; ?>"> Created </label>
                                                   </div>
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekRead ?> type="checkbox" id="ReadId[<?= $myData['id']; ?>]" name="txtRead[<?= $myData['id']; ?>]" value="<?= $myData['id']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['user_group']; ?>"> Read </label>
                                                   </div>
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekUpdate ?> type="checkbox" id="UpdateId[<?= $myData['id']; ?>]" name="txtUpdate[<?= $myData['id']; ?>]" value="<?= $myData['id']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['user_group']; ?>"> Update </label>
                                                   </div>
                                                   <div class="form-check">
                                                      <input class="form-check-input" <?= $cekDelete ?> type="checkbox" id="DeletedId[<?= $myData['id']; ?>]" name="txtDelete[<?= $myData['id']; ?>]" value="<?= $myData['id']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['user_group']; ?>"> Deleted </label>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                              <!-- Permission table -->
                           </div>

                           <div class="col-12">
                              <h4 class="mt-2 pt-50">Role Permissions [Departement]</h4>
                              <!-- Permission table -->
                              <div class="table-responsive">
                                 <table class="table table-flush-spacing">
                                    <tbody>
                                       <?php
                                       // var_dump($dataArraRead);
                                       $myQry = mysqli_query($koneksidb, "SELECT * FROM master_status where status_group='Department_Code' ORDER BY status_name ASC");
                                       while ($myData = mysqli_fetch_array($myQry)) {
                                          if (in_array($myData['status_code'], $dataArrayDepartmentCreate)) $cekCreate = " checked";
                                          else $cekCreate = "";

                                          if (in_array($myData['status_code'], $dataArrayDepartmentRead)) $cekRead = " checked";
                                          else $cekRead = "";

                                          if (in_array($myData['status_code'], $dataArrayDepartmentUpdate)) $cekUpdate = " checked";
                                          else $cekUpdate = "";

                                          if (in_array($myData['status_code'], $dataArrayDepartmentDelete)) $cekDelete = " checked";
                                          else $cekDelete = "";
                                          // echo $cekRead;
                                       ?>
                                          <tr>
                                             <td class="text-nowrap fw-bolder"><?= $myData['status_name']; ?></td>
                                             <td>
                                                <div class="d-flex">
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekCreate ?> type="checkbox" id="CreateId[<?= $myData['status_code']; ?>]" name="txtDepartmentCreate[<?= $myData['status_code']; ?>]" value="<?= $myData['status_code']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['status_name']; ?>"> Created </label>
                                                   </div>
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekRead ?> type="checkbox" id="ReadId[<?= $myData['status_code']; ?>]" name="txtDepartmentRead[<?= $myData['status_code']; ?>]" value="<?= $myData['status_code']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['status_name']; ?>"> Read </label>
                                                   </div>
                                                   <div class="form-check me-3 me-lg-5">
                                                      <input class="form-check-input" <?= $cekUpdate ?> type="checkbox" id="UpdateId[<?= $myData['status_code']; ?>]" name="txtDepartmentUpdate[<?= $myData['status_code']; ?>]" value="<?= $myData['status_code']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['status_name']; ?>"> Update </label>
                                                   </div>
                                                   <div class="form-check">
                                                      <input class="form-check-input" <?= $cekDelete ?> type="checkbox" id="DeletedId[<?= $myData['status_code']; ?>]" name="txtDepartmentDelete[<?= $myData['status_code']; ?>]" value="<?= $myData['status_code']; ?>" />
                                                      <label class=" form-check-label" for="<?= $myData['status_name']; ?>"> Deleted </label>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                              <!-- Permission table -->
                           </div>
                           <div class="col-12 text-center mt-2">
                              <button type="submit" name="btnSubmit" class="btn btn-primary me-1">Submit</button>
                              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                 Discard
                              </button>
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
<!-- END: Content-->
<?php
include "footer_difan.php";
?>