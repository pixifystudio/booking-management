<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";


$getID  = isset($_GET['id']) ?  $_GET['id'] : '';
$getVersion  = isset($_GET['v']) ?  $_GET['v'] : '1';
$ses_nama    = $_SESSION['SES_NAMA'];
?>
<div class="app-content content ecommerce-application">
  <?php


  if (isset($_POST['btnReject'])) {
    $Status = "Rejected";
    $dataNote = isset($_POST['txtReject']) ? $_POST['txtReject'] : '';

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote',updated_by='$ses_nama'   , updated_date=now() 
      WHERE document_id = '$getID' and document_version='$getVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
      VALUES  ('$getVersion','$getID','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Digital-Approval'>";
    }
    exit;
  }

  if (isset($_POST['btnDelete'])) {
    $Status = "Deleted";
    $dataNote = isset($_POST['txtNote']) ? $_POST['txtNote'] : '';

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote',updated_by='$ses_nama'   , updated_date=now() 
      WHERE document_id = '$getID' and document_version='$getVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
      VALUES  ('$getVersion','$getID','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Digital-Approval'>";
    }
    exit;
  }

  if (isset($_POST['btnRevisied'])) {
    $dataNote = isset($_POST['txtRevisied']) ? $_POST['txtRevisied'] : '';
    $Status = "Revised";

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote', updated_by='$ses_nama'   , updated_date=now() 
      WHERE document_id = '$getID' and document_version='$getVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
      VALUES  ('$getVersion','$getID','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Digital-Approval'>";
    }
    exit;
  }
  if (isset($_POST['btnApprove'])) {
    $Status = "Approved";
    $dataNote = isset($_POST['txtNote']) ? $_POST['txtNote'] : '';

    // $mySql    = "UPDATE document SET document_status='Deleted', updated_by='$ses_nama'   , updated_date=now() 
    //   WHERE document_id = '$getID' and document_version < '$getVersion'";
    // $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    $mySql    = "UPDATE document SET document_status='$Status', document_note='$dataNote', updated_by='$ses_nama'   , updated_date=now() 
      WHERE document_id = '$getID' and document_version='$getVersion'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    $mySql    = "INSERT INTO document_status (document_version, document_id, document_status, updated_by, updated_date) 
      VALUES  ('$getVersion','$getID','$Status','$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Digital-Approval'>";
    }
    exit;
  }

  $mySql   = "SELECT * FROM view_document where document_id='$getID' and document_version='$getVersion'";
  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $Code = $myData['document_id'];

  $tgl = date('Y-m-d');
  $dataCode    = $myData['document_id'];
  $dataStatus    = $myData['document_status'];
  $dataDate    = $myData['document_date'];
  $dataCover   = $myData['document_cover'];
  if ($dataStatus  == "Created" || $dataStatus  == "Updated" || $dataStatus  == "Revised") {
    $dataVersion    = $myData['document_version'];
  } else {
    $dataVersion    = $myData['document_version'] + 1;
  }
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
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0">Detail Buku</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="?page=Book-Management-Digital">Buku Digital Approval</a>
                  </li>
                  <li class="breadcrumb-item active">Detail Buku
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
          <div class="mb-1 breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="?page=Book-Management-Digital" aria-haspopup="true" aria-expanded="false"><i data-feather="arrow-left"></i></a>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- app e-commerce details start -->
        <section class="app-ecommerce-details">
          <div class="">
            <!-- Product Details starts -->
            <div class="card">
              <div class="row my-2 align-items-center justify-content-center">
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-2 mb-md-0">

                  <div class="col-12 col-md-12">
                    <div class="card align-items-center justify-content-center">
                      <img style='width:75%' src="../uploads/cover/DOC-000009.png" class="img-fluid product-img" alt="product image" />
                    </div>
                    <ul class="list-unstyled m-lg-75">
                      <div class="row mt-75 ">
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
                          <span class="fw-bolder">Publisher:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataPublisher; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Kategori:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataCategory; ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder">Tahun Penerbit:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataYear; ?></span>
                        </div>
                      </div>




                    </ul>
                    <br>
                    <a href="#" class="btn btn-outline-primary" style='width:100%'><b>Read the book </b> </a>

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

                  <div class='row'>
                    <div class='col-md-3'>

                    </div>

                    <div class='col-md-6'>
                      <div class="demo-inline-spacing budget-wrapper">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalReject" class="btn btn-danger">Reject</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalRevisied" class="btn btn-warning">Revise</button>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                          <button type="submit" name="btnApprove" class="btn btn-success">Approve</button>
                        </form>
                      </div>
                    </div>
                    <!-- Modal -->

                    <div class="modal fade text-start" id="modalRevisied" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header justify-content-start align-items-center">
                            <h4 class="modal-title" id="myModalLabel33">Revisied</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self">
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
                                    <textarea placeholder="Revisied Note " name="txtRevisied" class="form-control" required></textarea>
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
                                    <button type="submit" name="btnRevisied" class="btn btn-warning">Revisied</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade text-start" id="modalReject" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header justify-content-start align-items-center">
                            <h4 class="modal-title" id="myModalLabel33">Reject</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form3" target="_self">
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
                                    <textarea placeholder="Reject Note" name="txtReject" class="form-control" required></textarea>
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
                                    <button type="submit" name="btnReject" class="btn btn-danger">Reject</button>
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
              <!-- Product Details ends -->


            </div>
          </div>
      </div>
      <!-- END: Content-->

      <div class="sidenav-overlay"></div>
      <div class="drag-target"></div>





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
  <?php include "footer_difan.php"; ?>

  </html>