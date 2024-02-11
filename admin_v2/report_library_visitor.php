<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
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
            <h2 class="content-header-title float-start mb-0">Report</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a>Library Visitors</a>
                </li>
                <li class="breadcrumb-item active"><a>Report</a>
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
                <div class="mb-1">
                  <h3>Library Visitors List</h3>
                </div>
              </div>
              <div class="content-header-right text-md-end col-md-8 col-12 d-md-block d-none">
                <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1">
                  <div class="row">
                    <div class="col-md-5 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="code" class="form-select select2" tabindex="-1" name="txtCode">
                          <option value='' selected>[ Semua Kategori ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-3 col-12 px-25">

                    </div>
                    <div class="col-md-4 col-12 ps-25">
                      <div class="mb-1">
                        <!-- <i data-feather='calendar'></i>2019-05-01 to 2019-05-10 -->
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
                    <th>Date / Time</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 0;
                  $mySql    = "SELECT * from check_in ci join master_user mu on (ci.user_id = mu.user_id)  order by ci.updated_date desc";
                  $myQry    = mysqli_query($koneksidb, $mySql);
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                  ?>
                    <tr>
                      <td><?php echo $nomor ?></td>
                      <td><?php echo $myData['date_in'] ?></td>
                      <td><?php echo $myData['user_fullname'] ?></td>
                      <td><?php echo $myData['unit'] ?></td>
                      <!-- <td>A</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">
                              <i data-feather="edit-2" class="me-50"></i>
                              <span>Edit</span>
                            </a>
                            <a class="dropdown-item" href="#">
                              <i data-feather="trash" class="me-50"></i>
                              <span>Delete</span>
                            </a>
                          </div>
                        </div>
                      </td> -->
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