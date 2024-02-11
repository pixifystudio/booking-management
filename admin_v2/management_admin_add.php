<?php
$_SESSION['SES_TITLE'] = "Management ";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Management-";
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
            <h2 class="content-header-title float-start mb-0">Add New Admin</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">User Management</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Management Admin</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Management Admin Add</a>
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
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="Admin ID">Admin ID</label>
                            <input type="text" id="id" class="form-control" placeholder="1234567" name="admin" readonly />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="code">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Name" name="name" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Username" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="number" id="number" class="form-control" name="number" placeholder="Phone" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Institution</label>
                          <select class="form-select" id="basicSelect">
                            <option>Select Institution</option>
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Unit</label>
                          <select class="form-select" id="basicSelect">
                            <option>Select Unit</option>
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Status</label>
                            <input type="text" id="status" class="form-control" name="status" placeholder="Status" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Division</label>
                          <select class="form-select" id="basicSelect">
                            <option>Select Division</option>
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Position</label>
                          <select class="form-select" id="basicSelect">
                            <option>Select Position</option>
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Photo</label>
                            <input type="photo" id="status" class="form-control" name="photo" placeholder="Photo" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Prodi</label>
                          <select class="form-select" id="basicSelect">
                            <option>Select Prodi</option>
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="admin">Access Group</label>
                            <input type="text" id="admin" class="form-control" name="admin" placeholder="Admin" readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Management-Category" class="btn btn-outline-dark me-2">Discard</button>
                        <button type="reset" class="btn btn-warning me-3">Save</button>
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