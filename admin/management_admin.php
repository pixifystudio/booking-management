<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Management Admin";
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
            <h2 class="content-header-title float-start mb-0">Management Admin</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a>User Management</a>
                </li>
                <li class="breadcrumb-item active"><a>Management Admin</a>
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
                        <a href='?page=Management-Admin-Add' type="submit" class="btn btn-danger w-100" name=""><i data-feather='plus'></i> Add Admin</a>
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
                    <th>Name</th>
                    <th>Username</th>
                    <th>Institution</th>
                    <th>Division</th>
                    <th>Unit</th>
                    <th>Prodi</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Thomas</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
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
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Rianty</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
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
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Bambang</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
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
                    </td>
                  </tr>
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