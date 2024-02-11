<?php
$_SESSION['SES_TITLE'] = "Book Category";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Book-Category";
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
            <h2 class="content-header-title float-start mb-0">Add Category</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Book Category</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Category Add</a>
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
                            <label class="form-label" for="No">No</label>
                            <input type="text" id="no" class="form-control" placeholder="No" name="no" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="code">Code</label>
                            <input type="text" id="code" class="form-control" placeholder="Code" name="code" readonly />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category1">Category 1</label>
                            <input type="email" id="category1" class="form-control" name="category1" placeholder="Category 1" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category2">Category 2</label>
                            <input type="email" id="category2" class="form-control" name="category2" placeholder="Category 2" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category3">Category 3</label>
                            <input type="email" id="category3" class="form-control" name="category3" placeholder="Category 3" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category4">Category 4</label>
                            <input type="email" id="category4" class="form-control" name="category4" placeholder="Category 4" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category5">Category 5</label>
                            <input type="email" id="category5" class="form-control" name="category5" placeholder="Category 5" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="category6">Category 6</label>
                            <input type="email" id="category6" class="form-control" name="category6" placeholder="Category 6" />
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Book-Category" class="btn btn-outline-dark me-2">Discard</button>
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