<?php
if (empty($_SESSION['failed_login'])) {
} elseif ($_SESSION['failed_login'] > 2) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Login-Failed'>";
};
include_once "library/inc.connection.php";
$mySql   = "SELECT v.* FROM information v where `status`='Active'  order  by v.updated_date desc ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
$nomor  = 0;
while ($myData = mysqli_fetch_array($myQry)) {
  $nomor++;
  $dataarr['type'] = $myData['type'];
  $dataarr['writer'] = $myData['writer'];
  $dataarr['title_in'] = $myData['title_in'];
  $dataarr['title_en'] = $myData['title_en'];
  $dataarr['description_in'] = $myData['description_in'];
  $dataarr['description_en'] = $myData['description_en'];
  $dataarr['source'] = $myData['source'];
  $dataarr['file'] = $myData['file'];
  $dataarr['status'] = $myData['status'];
  $dataarr['headline'] = $myData['headline'];
  $dataarr['updated_date'] = $myData['updated_date'];
  $dataarr['updated_by'] = $myData['updated_by'];

  $dataSumArr[] = $dataarr;
}
// var_dump($dataSumArr);
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>Login Page - Libra</title>
  <link rel="apple-touch-icon" href="../base-app-assets/images/logo/libra2.png">
  <link rel="shortcut icon" type="image/x-icon" href="../base-app-assets/images/logo/libra3.png">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="../base-app-assets/vendors/css/vendors.min.css">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/colors.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/themes/dark-layout.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/themes/bordered-layout.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/themes/semi-dark-layout.css">

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/plugins/forms/form-validation.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/pages/authentication.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/vendors/css/extensions/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="../base-app-assets/css/plugins/extensions/ext-component-swiper.css">


  <!-- END: Page CSS-->

  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../build/css/style.css">
  <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="login vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <div class="auth-wrapper auth-cover">
          <div class="auth-inner row m-0">

            <!-- /Brand logo-->
            <!-- Left Text News-->
            <div class="col-8">
              <div class=" d-lg-flex align-items-center p-5">

                <div class="row match-height">
                  <img style='width:20%' src="../base-app-assets/images/logo/libra1.png">
                  <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="../base-app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>

                </div>
              </div>
            </div>
            <!-- /Left Text-->
            <!-- Login-->

            <div class="col-lg-4 align-items-center  px-5 p-lg-5 ">
              <!-- User Card -->
              <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded mt-3 mb-2" src="../base-app-assets/images/logo/libra2.png" height="150" width="150" alt="User avatar" />
              </div>

              <br>
              <div class="login-card card pt-75">
                <div class="card-body">
                  <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                      <div class="user-info text-center">
                        <h4 style="color:white">Login</h4>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-around my-2 pt-26">
                    <form class="form-signin" role="form" action="?page=Login-Validasi" method="POST" name="form1" target="_self" id="form1">
                      <div class="mb-1">
                        <label class="form-label" for="login-email" style="color:white">Username</label>
                        <input class="form-control" id="txtUser" style="width:100%; " name="txtUser" type="text" placeholder="Username" required />

                      </div>
                      <div class="mb-1">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" style="color:white" for="login-password">Password</label><a href="auth-forgot-password-cover.html"></a>
                        </div>

                        <div class="input-group input-group-merge form-password-toggle">
                          <input type="password" class="form-control form-control-merge" id="login-password" name="txtPassword" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                        </div>
                      </div>
                      <span> <a href="" data-bs-toggle="modal" style="color:white" data-bs-target="#exampleModalCenter"> Register / Lupa Password</a></span>
                      <!-- <br> <a href="../uploads/biblioteca%204-01.apk"> Apps</a></br> -->

                      <div class="mb-1">

                      </div>
                      <button class="btn btn-secondary w-100" style="color:white" name="btnLogin" tabindex="4">Login</button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /User Card -->
            </div>
            <!-- /Login-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Content-->

  <div class="vertical-modal-ex">
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Notification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Untuk pendaftaraan atau lupa password silahkan hubungi pustakawan, Terima kasih.</p>
            <i>For registration or forget password please contact Librarian, Thank you.</i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- BEGIN: Vendor JS-->
  <script src="../base-app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <script src="../base-app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="../base-app-assets/js/core/app-menu.js"></script>
  <script src="../base-app-assets/js/core/app.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  <script src="../base-app-assets/js/scripts/pages/auth-login.js"></script>
  <script src="../base-app-assets/js/scripts/extensions/swiper.js"></script>
  <script src="../base-app-assets/vendors/js/extensions/swiper.min.js"></script>


  <!-- END: Page JS-->

  <!-- swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      centeredSlides: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>

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

</html>