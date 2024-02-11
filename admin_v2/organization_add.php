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
            <h2 class="content-header-title float-start mb-0">Add Organization</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Organization</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Organization Add</a>
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
                            <label class="form-label" for="institution-column">Institution</label>
                            <input type="text" id="institution-column" class="form-control" placeholder="Institution" name="fname-column" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="unit-column">Unit</label>
                            <input type="text" id="unit-column" class="form-control" placeholder="Unit" name="lname-column" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="division">Division</label>
                            <input type="text" id="division" class="form-control" name="division" placeholder="Division" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="prodi-column">Prodi</label>
                            <input type="email" id="prodi-column" class="form-control" name="prodi-column" placeholder="Prodi" />
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Organization" class="btn btn-outline-dark me-2">Discard</button>
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