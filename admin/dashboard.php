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
                        <div class="col-xl-3 col-md-6 col-lg-3  col-6">
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
                                         $mySql2   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode='QRIS'";
                                                $mySql2 .= " UNION ALL SELECT dd.qty as qty ,dd.nominal as nominal,'IN' as `status`  FROM `data_qr_detail` dd LEFT JOIN data_qr d ON (dd.transaction_id = d.transaction_id) WHERE item !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode_pembayaran='QRIS' ";
                                                
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
                                        <?php 

                                                $mySql3   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode='Cash'";
                                                $mySql3 .= " UNION ALL SELECT dd.qty as qty ,dd.nominal as nominal,'IN' as `status`  FROM `data_qr_detail` dd LEFT JOIN data_qr d ON (dd.transaction_id = d.transaction_id) WHERE item !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode_pembayaran='Cash' ";
                                                
                                                $myQry3 = mysqli_query($koneksidb, $mySql3);
                                                $sum_total3 = 0;
                                                $sum_total_out3 = 0;

                                                while ($myData3 = mysqli_fetch_array($myQry3)) {
                                                    $status3 =  $myData3['status'];
                                                    if ($status3 =="IN") {
                                                    $qty3 = $myData3['qty'];
                                                    $nominal3 = $myData3['nominal'];

                                                    $total3 = $nominal3 * $qty3;
                                                    $sum_total3 += $total3;
                                                    } else {
                                                    $qty3 = $myData3['qty'];
                                                    $nominal3 = $myData3['nominal'];

                                                    $total3 = $nominal3 * $qty3;
                                                    $sum_total_out3 += $total3;  
                                                    }
                                                }
                                                $sum_total3 = $sum_total3 - $sum_total_out3;

                                        ?>
                                        <div class="col-xl-12 col-sm-12 col-12 mb-2 mb-xl-2">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0"> <?=  'Rp' . number_format($sum_total3, 0, ',', '.')?></h4>
                                                    <p class="card-text font-small-3 mb-0">Dana</p>
                                                </div>
                                            </div>
                                        </div>
                                          <?php 

                                                $mySql4   = "SELECT qty,nominal,`status`  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode='Transfer Bank'";
                                                $mySql4 .= " UNION ALL SELECT dd.qty as qty ,dd.nominal as nominal,'IN' as `status`  FROM `data_qr_detail` dd LEFT JOIN data_qr d ON (dd.transaction_id = d.transaction_id) WHERE item !='DP' AND updated_date >='2025-02-16 00:00:00'  AND metode_pembayaran='Transfer Bank' ";
                                                
                                                $myQry4 = mysqli_query($koneksidb, $mySql4);
                                                $sum_total4 = 0;
                                                $sum_total_out4 = 0;

                                                while ($myData4 = mysqli_fetch_array($myQry4)) {
                                                    $status4 =  $myData4['status'];
                                                    if ($status4 =="IN") {
                                                    $qty4 = $myData4['qty'];
                                                    $nominal4 = $myData4['nominal'];

                                                    $total4 = $nominal4 * $qty4;
                                                    $sum_total4 += $total4;
                                                    } else {
                                                    $qty4 = $myData4['qty'];
                                                    $nominal4 = $myData4['nominal'];

                                                    $total4 = $nominal4 * $qty4;
                                                    $sum_total_out4 += $total4;  
                                                    }
                                                }
                                                $sum_total4 = $sum_total4 - $sum_total_out4;

                                        ?>
                                        <div class="col-xl-12 col-sm-12 col-12 mb-2 mb-sm-2">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                              <h4 class="fw-bolder mb-0"><?=  'Rp' . number_format($sum_total4, 0, ',', '.')?></h4>
                                                    <p class="card-text font-small-3 mb-0">Transfer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-xl-9 col-md-6 col-lg-9 col-12">
                            <div class="card card-revenue-budget">
                                <div class="row mx-0">
                                    <div class="col-md-12 col-12 revenue-report-wrapper">
                                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title mb-50 mb-sm-0">Total Transaksi</h4>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center me-2">
                                                    <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                                    <span>Booking</span>
                                                </div>
                                                <div class="d-flex align-items-center ms-75">
                                                    <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                                    <span>Inventory</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="revenue-report-chart"></div>
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
                                    
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-primary rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title">[Nama Pelanggan]</h6>
                                                <small>No Wa</small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-danger"> 10 Booking</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h4 class="card-title">Top Visitor (All Time)</h4>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-primary rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title">[Nama Pelanggan]</h6>
                                                <small>No Wa</small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-danger"> 10 Booking</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row match-height">
                 <div class="col-lg-4 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats">
                                        <div class="card-body pb-50">
                                            <h6>Profit</h6>
                                            <h2 class="fw-bolder mb-1">6,24k</h2>
                                            <div id="statistics-profit-chart"></div>
                                        </div>
                                    </div>
                                </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-browser-states">
                                <div class="card-header">
                                    <div>
                                        <h4 class="card-title">Top 3 Booking Type</h4>
                                        <p class="card-text font-small-2">February 2025</p>
                                    </div>
                                    <div class="dropdown chart-dropdown">
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="browser-states">
                                        <div class="d-flex">
                                            <img src="/app-assets/images/icons/google-chrome.png" class="rounded me-1" height="30" alt="Google Chrome" />
                                            <h6 class="align-self-center mb-0">Google Chrome</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold text-body-heading me-1">54.4%</div>
                                            <div id="browser-state-chart-primary"></div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-browser-states">
                                <div class="card-header">
                                    <div>
                                        <h4 class="card-title">Top 3 Inventory Sales</h4>
                                        <p class="card-text font-small-2">February 2025</p>
                                    </div>
                                    <div class="dropdown chart-dropdown">
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="browser-states">
                                        <div class="d-flex">
                                            <img src="/app-assets/images/icons/google-chrome.png" class="rounded me-1" height="30" alt="Google Chrome" />
                                            <h6 class="align-self-center mb-0">Google Chrome</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold text-body-heading me-1">54.4%</div>
                                            <div id="browser-state-chart-primary"></div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <!--/ Developer Meetup Card -->

                      
                        <!--/ Goal Overview Card -->

                     
                    </div>
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

