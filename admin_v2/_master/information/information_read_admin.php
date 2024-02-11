<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
$id = $_GET['id'];

$mySql  = "select * from information where id='$id'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);

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
              <h2 class="content-header-title float-start mb-0">Informasi, Berita & Artikel</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a>Informasi, Berita & Artikel</a>
                  </li>
                  <li class="breadcrumb-item active"><a>Informasi</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
          <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
            </div>
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

                <div class="card align-items-center  mb-75" style="background-color:navajowhite">
                  <img style="" src="../uploads/cover_information/<?php echo $myData['file'] ?>" class="img-fluid product-img" alt="product image" />
                </div>
                <br>




                <div class="card">

                  <p class="item-price me-1"> <?php echo $myData['type'] ?> <b> <i> - <?php echo $myData['writer'] ?></i></b>- <?php echo $myData['updated_date'] ?></p>
                  <p class="card-text mt-1">
                    <?php echo $myData['description_en'] ?>

                  </p>
                  <hr />





                </div>


                <div class="col-6">
                  <a href="?page=Information-Edit&id=<?php echo $id; ?>" class="btn btn-warning" style='width:100%'><b>Edit</b> </a>

                </div>
                <div class="col-6">
                  <a href="?page=Information-Delete&id=<?php echo $id; ?>" class="btn btn-primary" style='width:100%'><b>Delete</b> </a>

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
<?php include "footer_difan.php"; ?>

</html>