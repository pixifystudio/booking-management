<?php
$_SESSION['SES_TITLE'] = "Book Category";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Book Category";
$getID  = isset($_GET['code']) ?  $_GET['code'] : 'Digital';
if ($getID == 'Digital') {
  // $code = 'E-Document';
} else {
  // $code = 'Physical Document';
}
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
            <h2 class="content-header-title float-start mb-0">Categories Management</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Categories Management</a>
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
                <form role="form" action="?page=Content-Categories-Add" method="POST" name="form1" target="_self" id="form1">
                  <div class="row">
                    <div class="col-md-5 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="code" class="form-select select2" tabindex="-1" name="txtCode">
                          <option value='' selected>[ Semua Kategori ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-3 col-12 ps-25">

                      <div class="mb-1">
                        <a href="?page=Import-Category-Files" class="btn btn-info w-100" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i>Import Category</a>
                      </div>
                    </div>
                    <div class="col-md-4 col-12 ps-25">
                      <div class="mb-1">
                        <button type="submit" class="btn btn-secondary w-100" name=""><i data-feather='plus'></i> Add Categories Management</button>
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
                    <th>No.</th>
                    <th>Category ID</th>
                    <th>Category 1</th>
                    <th>Category 2</th>
                    <th>Category 3</th>
                    <th>Category 4</th>
                    <th>Category 5</th>
                    <th>Category 6</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT * FROM master_category where category_level_1='$getID' order by category_id";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['category_id'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $myData['category_id']; ?></td>
                      <td><?php echo $myData['category_level_1']; ?></td>
                      <td><?php echo $myData['category_level_2']; ?></td>
                      <td><?php echo $myData['category_level_3']; ?></td>
                      <td><?php echo $myData['category_level_4']; ?></td>
                      <td><?php echo $myData['category_level_5']; ?></td>
                      <td><?php echo $myData['category_level_6']; ?></td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="?page=Content-Categories-Edit&id=<?php echo $myData['category_id']; ?>&id2=<?php echo $myData['category_level_1']; ?>">
                              <i data-feather="edit-2" class="me-50"></i>
                              <span>Edit</span>
                            </a>
                            <a class="dropdown-item" href="?page=Content-Categories-Delete&id=<?php echo $myData['category_id']; ?>&id2=<?php echo $myData['category_level_1']; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')">
                              <i data-feather="trash" class="me-50"></i>
                              <span>Delete</span>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                  </tr>
                </tfoot>
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