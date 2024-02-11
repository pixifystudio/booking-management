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
            <h2 class="content-header-title float-start mb-0">Grant Access</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Digital Book Access</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Grant Access</a>
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
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="Admin ID">Book ID</label>
                            <input type="text" id="id" class="form-control" placeholder="1234567" name="admin" readonly />
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="email">Division</label>
                            <select class="form-select" id="basicSelect">
                              <option>Select Division</option>
                              <option>A</option>
                              <option>B</option>
                            </select>
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="email">Unit</label>
                            <select class="form-select" id="basicSelect">
                              <option>Select Unit</option>
                              <option>A</option>
                              <option>B</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="code">Title</label>
                            <input type="text" id="name" class="form-control" placeholder="Title" name="name" readonly />
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="email">Department</label>
                            <select class="form-select" id="basicSelect">
                              <option>Select Department</option>
                              <option>A</option>
                              <option>B</option>
                            </select>
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="email">Employee</label>
                            <select class="form-select" id="basicSelect">
                              <option>Select Employee</option>
                              <option>A</option>
                              <option>B</option>
                            </select>
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