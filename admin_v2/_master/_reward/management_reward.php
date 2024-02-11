<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
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
            <h2 class="content-header-title float-start mb-0">User Management</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Reward & Badges Management</a>
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
                <form role="form" action="?page=Management-Reward-Add" method="POST" name="form1" target="_self" id="form1">
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
                        <a href='?page=Management-Reward-Add' type="submit" class="btn btn-secondary w-100" name=""><i data-feather='plus'></i> Add Data</a>
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
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT * FROM master_reward order by id asc";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['id'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><img src=<?php echo "../uploads/user/" . $myData['icon']; ?> alt="..." class="img-circle" width="30px" height="30px"></td>
                      <td><?php echo $myData['nama']; ?></td>
                      <td><?php echo $myData['value']; ?></td>
                      <td><?php echo $myData['status']; ?></td>
                      <td><a href="?page=Management-Reward-Edit&id=<?php echo $Code; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a></td>
                      <td><a href="?page=Management-Reward-Delete&id=<?php echo $Code; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>

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