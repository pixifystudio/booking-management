<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";


$getID  = isset($_GET['id']) ?  $_GET['id'] : '';
$getVersion  = isset($_GET['v']) ?  $_GET['v'] : '1';
$mySql   = "SELECT d.*,r.racking_number FROM view_document d join master_racking r on r.racking_id=d.racking_id 
where d.document_id='$getID' and d.document_version='$getVersion'";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$Code = $myData['document_id'];

$tgl = date('Y-m-d');
$dataCode    = $myData['document_id'];
$dataStatus    = $myData['document_status'];
$dataDate    = $myData['document_date'];
$dataCover   = $myData['document_cover'];
$dataVersion    = $myData['document_version'];

$dataRack       =  $myData['racking_number'];
$dataYear       = isset($_POST['txtYear']) ? $_POST['txtYear'] : $myData['document_year'];
$dataAuthor     = isset($_POST['txtAuthor']) ? $_POST['txtAuthor'] : $myData['document_author'];
$dataPublisher  = isset($_POST['txtPublisher']) ? $_POST['txtPublisher'] : $myData['document_publisher'];
$dataCategory   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : $myData['category_level_2'];
$dataExpireDate       = isset($_POST['txtExpired']) ? $_POST['txtExpired'] : $myData['document_expire_date'];
$dataKeyword    = isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $myData['document_keyword'];
$dataTitleID    = isset($_POST['txtTitleID']) ? $_POST['txtTitleID'] : $myData['document_title_id'];
$dataTitleEN    = isset($_POST['txtTitleEN']) ? $_POST['txtTitleEN'] : $myData['document_title_en'];
$dataDescID     = isset($_POST['txtDescriptionID']) ? $_POST['txtDescriptionID'] : $myData['document_description_id'];
$dataDescEN     = isset($_POST['txtDescriptionEN']) ? $_POST['txtDescriptionEN'] : $myData['document_description_en'];
?>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">



  <!-- BEGIN: Content-->
  <div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0">Book Management</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="?page=Book-Management-Physical">Physical Book</a>
                  </li>
                  <li class="breadcrumb-item active">Detail Book
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
          <div class="mb-1 breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="?page=Book-Management-Physical" aria-haspopup="true" aria-expanded="false"><i data-feather="arrow-left"></i></a>
          </div>
        </div>
      </div>
      <div class="content-body">

        <!-- app e-commerce details start -->
        <section class="app-ecommerce-details">
          <div class="">
            <!-- Product Details starts -->
            <div class="">
              <div class="row my-2">
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-2 mb-md-0">

                  <div class="col-12 col-md-12">
                    <div class="card align-items-center justify-content-center">
                      <img style='width:75%' src="../uploads/cover/<?= $dataCover ?>" class="img-fluid product-img" alt="product image" />
                    </div>
                    <ul class="list-unstyled m-lg-75">
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Title:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataTitleID; ?></span>
                        </div>
                      </div>


                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Author:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataAuthor; ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Categories:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataCategory; ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Year:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataYear; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Rack:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataRack; ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Rating:</span>
                        </div>
                        <div class='col-6'>
                          <span>⭐️ 3,8</span>
                        </div>
                      </div>
                    </ul>

                  </div>
                </div>


                <div class="col-12 col-md-7">
                  <h2 style='color:brown'>Description</h2>
                  <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                    <h4 class="item-price me-1"><?= $dataKeyword; ?></h4>

                  </div>
                  <p class="card-text">
                    <?= $dataDescID; ?>
                  </p>
                  <hr />

                  <h4>Review Pembaca</h4>

                  <div class="">
                    <div class="card-body">
                      <div class="d-flex justify-content-start align-items-center mb-1">
                        <!-- avatar -->
                        <div class="avatar me-1">
                          <img src="../app-assets/images/portrait/small/avatar-s-18.jpg" alt="avatar img" height="50" width="50" />
                        </div>
                        <!--/ avatar -->
                        <div class="profile-user-info">
                          <h6 class="mb-0">Leeanna Alvord</h6>
                          <small>⭐️⭐️⭐️⭐️⭐️</small>
                          <div>
                          </div>
                        </div>
                      </div>
                      <p class="card-text">
                        Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
                        can make the difference when presenting to clients who are looking for the perfect fit.
                      </p>
                      <small class="text-muted">12 Dec 2018 at 1:16 AM</small>


                      <!--/ comments -->

                    </div>

                  </div>



                </div>
              </div>
            </div>
          </div>
          <!-- Product Details ends -->


      </div>
    </div>
  </div>
  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <!-- Modal -->
  <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-start align-items-center">
          <h4 class="modal-title" id="myModalLabel33">Review</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#">
          <div class="modal-body ">
            <!-- Basic -->

            <div class="row mt-75">
              <div class='col-4'>

              </div>
              <div class='col-6'>
                <div class="mb-10">
                  <div class="basic-ratings"></div>
                </div>
              </div>
            </div>

            <div class="row mt-75">
              <div class='col-12'>
                <div class="mb-10">
                  <textarea placeholder="Bagikan Pendapatmu" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <!--/ Basic -->

          </div>
          <div class="modal-footer">
            <div class="row mt-75">
              <div class='col-4'>

              </div>
              <div class='col-6'>
                <div class="mb-10">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kirim</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!-- BEGIN: Page JS-->
  <script src="../app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
  <script src="../app-assets/js/scripts/forms/form-number-input.js"></script>
  <!-- END: Page JS-->

  <script>
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })
  </script>
</body>


<!-- END: Body-->
<?php include "footer_user.php"; ?>

</html>