<?php
include "library/inc.connection.php";
$id = isset($_GET['id']) ? $_GET['id'] : '';

// panggil data dari database
$mySql  = "SELECT * from booking where id ='$id'";
$myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);

// ambil data by id nya

$nama = $myData['nama'];
$email = $myData['email'];
$no_wa = $myData['no_wa'];
$jenis = $myData['jenis'];
$paket = $myData['paket'];
$background = $myData['background'];
$tanggal = $myData['tanggal'];
$jam = $myData['jam'];
$username = isset($myData['username']) ? $myData['username'] : '';


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Pixify Selfstudio - Photo Studio">
  <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no"><!-- Favicon-->
  <link rel="shortcut icon" href="./assets/favicons/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="./assets/favicons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./assets/favicons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./assets/favicons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/favicons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./assets/favicons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./assets/favicons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./assets/favicons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./assets/favicons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-icon-180x180.png">
  <link rel="icon" type="assets/images/pixify1.png" sizes="192x192" href="./assets/favicons/android-icon-192x192.png">
  <link rel="icon" type="assets/images/pixify1.png" sizes="32x32" href="./assets/favicons/favicon-32x32.png">
  <link rel="icon" type="assets/images/pixify1.png" sizes="96x96" href="./assets/favicons/favicon-96x96.png">
  <link rel="icon" type="assets/images/pixify1.png" sizes="16x16" href="./assets/favicons/favicon-16x16.png">
  <link rel="manifest" href="./assets/favicons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./assets/favicons/ms-icon-144x144.png"><!-- PWA primary color-->
  <meta name="theme-color" content="#00BCD4">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"><!-- Facebook-->
  <meta property="author" content="luxi">
  <meta property="og:site_name" content="alexstrap.ux-maestro.com">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website"><!-- Twitter-->
  <meta property="twitter:site" content="luxi.ux-maestro.com">
  <meta property="twitter:domain" content="luxi.ux-maestro.com">
  <meta property="twitter:creator" content="luxi">
  <meta property="twitter:card" content="summary">
  <meta property="twitter:image:src" content="./assets/images/pixify1.png">
  <meta property="og:url" content="alexstrap.ux-maestro.com/education">
  <meta property="og:title" content="SELF STUDIO">
  <meta property="og:description" content="SELFSTUDIO - Photo Studio & Event Photobooth">
  <meta name="twitter:site" content="alexstrap.ux-maestro.com/education">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="/images/pixify1.png">
  <meta property="og:image" content="/images/pixify1.png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <title>Pixify Studio - Booking </title><!-- Styles--><!-- Put the 3rd/plugins css here-->
  <link href="./assets/css/vendors/normalize.css" rel="stylesheet">
  <link href="./assets/css/vendors/bootstrap.css" rel="stylesheet">
  <!-- <link href="./assets/css/vendors/materialize.css" rel="stylesheet"> -->
  <link href="./assets/css/vendors/hamburger-menu.css" rel="stylesheet">
  <link href="./assets/css/vendors/animate.css" rel="stylesheet">
  <link href="./assets/css/vendors/animate-extends.css" rel="stylesheet">
  <link href="./assets/css/vendors/slick-carousel/slick.css" rel="stylesheet">
  <link href="./assets/css/vendors/slick-carousel/slick-theme.css" rel="stylesheet">
  <link href="./assets/css/styles_13.css" rel="stylesheet">
  <link href="assets/css/date-picker.css" rel="stylesheet">
  <!-- font-awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- datepicker styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
</head>

<body>
  <div id="preloader" style="position: fixed; z-index: 10000; background: #fafafa; width: 100%; height: 100%"><img style="opacity: 0.5; position: fixed; top: calc(50% - 50px); left: calc(50% - 50px)" src="./assets/images/loading.gif" alt="loading"></div>
  <div class="m-application theme--light transition-page" id="app">
    <div class="loading"></div>
    <div class="m-content smart smart-var" id="main-wrap">
      <div class="form-page">
        <div class="page-wrap">
          <div class="hidden-md-up">
            <div class="logo logo-header">
              <a href="index.html">
                <img src="./assets/images/pixify1-white.png" alt="logo">
              </a>
            </div>
          </div>
          <div class="container max-lg inner-wrap">
            <div class="card form-box fragment-fadeUp">
              <div class="hidden-sm-down">
                <a class="waves-effect btn-icon backtohome" href="index.html">
                  <span><i class="ion-ios-home-outline"></i><i class="ion-ios-arrow-thin-left"></i></span>
                </a>
              </div>
              <div class="auth-frame">
                <div class="row">
                  <div class="col-md-5">
                    <div class="hidden-sm-down">
                      <div class="greeting">
                        <div class="deco">
                          <div class="primary-light"></div>
                          <div class="secondary-main"></div>
                          <div class="secondary-light"></div>
                        </div>

                        <div class="logo">
                          <img src="./assets/images/pixify1.png" alt="logo" />

                          <p class="use-text-subtitle2">Terima kasih sudah booking studio kami :D </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-wrap">
                      <div>
                        <div class="head">
                          <div class="title-main align-left">
                            <h4 class="secondary"><span>BOOKING</span></h4>
                            <p class="desc use-text-subtitle2"></p>
                          </div>
                          <!-- <a class="btn btn-flat waves-effect button-link" href="register.html">
                            <i class="material-icons icon left mr-1">arrow_forward</i>Create new account
                          </a> -->
                        </div>
                        <form id="login_form" method="POST">
                          <div class="row spacing3">
                            <p>Terimakasih <?php echo $nama ?>,
                            </p>
                            <p>
                              Selanjutnya yang harus kamu lakukan:</p>
                            <p>
                              1. Cek email kamu untuk detail pemesanan.</p>
                            <p>
                              2. Melakukan pembayaran DP sebesar Rp20.000 melalui rekening BCA 409101008799535 a.n Dicky Pramana Sukma</p>
                            <p>
                              3. Kirim bukti pembayaran melalui no WhatsApp: 085171212096</p>
                            <p> Sampai berjumpa di Self Studio :)</p>
                          </div>

                          <div class="btn-area mt-10">
                            <a href="https://wa.me/6285171212096?text=Hallo+min%2C+saya+udah+booking+ya+dengan+detail+sebagai+berikut%3A%0D%0ATanggal%3A+<?= $tanggal; ?>%0D%0AWaktu%3A+<?= $jam; ?>%0D%0ANama%3A+<?= $nama; ?>%0D%0AJenis+Foto%3A+<?= $jenis; ?>%0D%0APilihan+Paket%3A+<?= $paket; ?>%0D%0ABackground%3A+<?= $background; ?>%0D%0AEmail%3A+<?= $email; ?>%0D%0ANo+WA%3A+<?= $no_wa; ?>%0D%0AUsername%C2%A0IG%3A%C2%A0<?= $username; ?>" class="btn secondary btn-large block waves-effect">Confirm Melalui WA</a>
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
  </div><!-- Scripts--><!-- Put the 3rd/plugins javascript here-->
  <script src="./assets/js/vendors/jquery.min.js"></script>
  <script src="./assets/js/vendors/bootstrap.min.js"></script>
  <script src="./assets/js/vendors/enquire.min.js"></script>
  <script src="./assets/js/vendors/jquery.enllax.min.js"></script>
  <script src="./assets/js/vendors/jquery.form-validator.min.js"></script>
  <script src="./assets/js/vendors/jquery.touchSwipe.min.js"></script>
  <script src="./assets/js/vendors/pace.min.js"></script>
  <script src="./assets/js/vendors/slick.min.js"></script>
  <script src="./assets/js/vendors/wow.min.js"></script>
  <script src="./assets/js/vendors/jquery.navScroll.min.js"></script>
  <script src="./assets/js/vendors/parallax.min.js"></script><!-- This assets are not avalaible in npm.js or it has been costumized-->
  <script src="./assets/js/vendors/modernizr-2.8.3-respond-1.4.2.min.js"></script>
  <script src="./assets/js/vendors/materialize.js"></script>
  <script src="./assets/js/scripts.js"></script>


  <!-- Datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

<script>
  $(function() {
    $('.datepicker').datepicker({
      language: "es",
      autoclose: true,
      format: "dd/mm/yyyy"
    });
  });
</script>

</html>