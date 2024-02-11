<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Management Admin";
$position = $_SESSION['SES_POSITION'];

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
            <h2 class="content-header-title float-start mb-0">Admin Management</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Admin</a>
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
              <div class="content-header-left col-md-4 col-12">
                <h4 class="card-title"></h4>
              </div>
              <div class="content-header-right text-md-end col-md-8 col-12 d-md-block d-none">
                <form role="form" action="?page=Management-Admin-Add" method="POST" name="form1" target="_self" id="form1">
                  <div class="row">
                    <div class="col-md-5 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="code" class="form-select select2" tabindex="-1" name="txtCode">
                          <option value='' selected>[ Semua Kategori ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-3 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="subcategory" class="form-select select2" tabindex="-1" name="txtSubCategory">
                          <option value='' selected>[ Semua Pelanggan ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-4 col-12 ps-25">
                      <div class="mb-1">
                        <a href='?page=Management-Admin-Add' type="submit" class="btn btn-secondary w-100" name=""><i data-feather='plus'></i> Add Admin</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-datatable">
              <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <!-- <th>ID Anggota</th> -->
                    <th>Name</th>
                    <th>Username</th>
                    <th>Institution</th>
                    <th>Division</th>
                    <th>Unit</th>
                    <th>Major</th>
                    <th>Position</th>
                    <th>Access Group</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT * FROM master_user where user_group!='USER'";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['user_id'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><img src=<?php echo "../uploads/user/" . $myData['user_photo']; ?> alt="..." class="img-circle" width="30px" height="30px"></td>
                      <!-- <td><?php echo $myData['user_id']; ?></td> -->
                      <td><?php echo $myData['user_fullname']; ?></td>
                      <td><?php echo $myData['username']; ?></td>
                      <td><?php echo $myData['branch']; ?></td>
                      <td><?php echo $myData['division']; ?></td>
                      <td><?php echo $myData['department']; ?></td>
                      <td><?php echo $myData['unit']; ?></td>
                      <td><?php echo $myData['position']; ?></td>
                      <td><?php echo $myData['user_group']; ?></td>
                      <td style="color:<?php if ($myData['user_status'] == "Not Active") {
                                          echo "#FF0000";
                                        } ?>"><?php echo $myData['user_status']; ?></td>

                      <?php if ($myData['position'] == 'Member' && $position == 'Pustakawan') { ?>
                        <td><a href="?pageManagement-Admin-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                        <td><a href="?page=Management-Admin-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                      <?php } elseif ($position == 'Super Admin') { ?>
                        <td><a href="?page=Management-Admin-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                        <td><a href="?page=Management-Admin-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                      <?php  } else { ?>
                        <td></td>
                        <td></td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>

              </table>
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