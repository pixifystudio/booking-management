<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_v2.php";

$_SESSION['SES_PAGE'] = "?page=Management Admin";
?>
<!-- BEGIN: Content-->
<div class="content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item active"><a>Kas - Dashboard </a> -->
                <!-- </li> -->
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

 <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                 
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-3 col-md-12 col-lg-3  col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Saldo</h4>
                                    <div class="d-flex align-items-center">
                                        <!-- <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p> -->
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <?php 
                                         $mySql2   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='2025-03-07 00:00:00'  AND metode='Cash'";
                                                $mySql2 .= " UNION ALL SELECT dd.qty as qty ,dd.nominal as nominal,'IN' as `status`  FROM `data_qr_detail` dd LEFT JOIN data_qr d ON (dd.transaction_id = d.transaction_id) WHERE item !='DP' AND updated_date >='2025-03-07 00:00:00'  AND metode_pembayaran='Cash' ";
                                                
                                                $myQry2 = mysqli_query($koneksidb, $mySql2);
                                                $sum_total2 = 0;
                                                $sum_total_out2 = 0;

                                                while ($myData2 = mysqli_fetch_array($myQry2)) {
                                                    $status2 =  $myData2['status'];
                                                    if ($status2 =="IN") {
                                                    $qty2 = $myData2['qty'];
                                                    $nominal2 = $myData2['nominal'];

                                                    $total2 = $nominal2 * $qty2;
                                                    $sum_total2 += $total2;
                                                    } else {
                                                    $qty2 = $myData2['qty'];
                                                    $nominal2 = $myData2['nominal'];

                                                    $total2 = $nominal2 * $qty2;
                                                    $sum_total_out2 += $total2;  
                                                    }
                                                }
                                                $sum_total2 = $sum_total2 - $sum_total_out2;
                                        ?>
                                        <div class="col-xl-12 col-sm-12 col-12 mb-0 mb-xl-2">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0"> <?=  'Rp' . number_format($sum_total2, 0, ',', '.')?></h4>
                                                    <p class="card-text font-small-3 mb-0">Cash</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>

                    <div class="row match-height">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h4 class="card-title">Top Visitor (Bulan Ini)</h4>
                                </div>
                                <div class="card-body">
                                    <?php 
                                     $txtDateFrom  = isset($_GET['from']) ? $_GET['from'] . ' 00:00:00' : date('Y-m-01 00:00:00');
                                     $txtDateUntil  = isset($_GET['until']) ? $_GET['until'] . ' 23:59:59' : date('Y-m-31 23:59:59');  
                                    $mySql = "SELECT nama, no_wa, COUNT(*) AS jumlah_booking
                                    FROM booking
                                    WHERE STATUS = 'Selesai' and no_wa !='-' and updated_date >='$txtDateFrom' and updated_date <='$txtDateUntil'
                                    GROUP BY no_wa
                                    ORDER BY jumlah_booking DESC
                                    LIMIT 10";
                                     $myQry = mysqli_query($koneksidb, $mySql);
                                                $sum_total4 = 0;
                                                $sum_total_out4 = 0;

                                    while ($myData = mysqli_fetch_array($myQry)) {
                                    ?>
                                    
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-primary rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title"> <?= $myData['nama'] ?></h6>
                                                <small> <?= $myData['no_wa'] ?></small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-danger"> <?= $myData['jumlah_booking'] ?> Booking</div>
                                    </div>
                                    <?php } 
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h4 class="card-title">Top Visitor (All Time)</h4>
                                </div>
                                <div class="card-body">
                                    <?php 
                                    $mySql = "SELECT nama, no_wa, COUNT(*) AS jumlah_booking
                                    FROM booking
                                    WHERE STATUS = 'Selesai' and no_wa !='-'
                                    GROUP BY no_wa
                                    ORDER BY jumlah_booking DESC
                                    LIMIT 10";
                                     $myQry = mysqli_query($koneksidb, $mySql);
                                                $sum_total4 = 0;
                                                $sum_total_out4 = 0;

                                    while ($myData = mysqli_fetch_array($myQry)) {
                                    ?>
                                    
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-primary rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title"> <?php echo $myData['nama'] ?></h6>
                                                <small> <?= $myData['no_wa'] ?></small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-danger"> <?= $myData['jumlah_booking'] ?> Booking</div>
                                    </div>
                                    <?php } 
                                    ?>

                                </div>
                            </div>
                        </div>
                        
                    </div>

              

                        
                         
                        <!--/ Developer Meetup Card -->

                      
                        <!--/ Goal Overview Card -->

                     
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <!-- <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p> -->
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>


    <!-- transaksi dan booking -->
    
        <?php
        // $databulan3 = array();


        // $datatotal3 = array();
        // $mySql3   = "SELECT DATE_FORMAT(updated_date, '%Y-%m') AS bulan, 
        //         COUNT(*) AS jumlah_booking
        //     FROM booking
        //     WHERE STATUS = 'Selesai'
        //     GROUP BY bulan
        //     ORDER BY bulan desc;
        //     LIMIT 5";
        
        // $myQry3   = mysqli_query($koneksidb, $mySql3)  or die("Error query " . mysqli_error($koneksidb));
        // while ($myData3 = mysqli_fetch_array($myQry3)) {
        // $databulan3[] = date_format(new DateTime($myData3['bulan']), "d F");
        // $datatotal3[] = ($myData3['jumlah_booking']);
        // }
        ?>
    <!-- END: Page JS-->

   
</body>

  </div>
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_v2.php";

?>

