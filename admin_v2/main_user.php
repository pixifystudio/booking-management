<?php
include_once "library/inc.seslogin.php";
$halaman = "main_user";
include "header_user.php";
$_SESSION['SES_PAGE'] = "?page=Main-User";
?>

<style>

</style>
<div class="app-content content ">
  <?php
  // $tgl             = date('Y-m-d H:i:s');
  $ses_nama = $_SESSION['SES_NAMA'];

  // echo  $dataCode        = buatNomor("stock_order", "", $tgl, 'OUT');

  // $mySql     = "SELECT ppd.*,pd.item,pp.pembiayaan_produksi_date,pp.pp_id FROM pembiayaan_produksi pp join pembiayaan_produksi_detail ppd 
  // join produksi_detail pd WHERE pp.pembiayaan_produksi_id=ppd.pembiayaan_produksi_id and ppd.product_detail_id=pd.pp_detail_id order by pp.pembiayaan_produksi_date";
  // $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
  // while ($myData = mysqli_fetch_array($myQry)) {
  //}
  //     $item =  $myData['item'];
  //     $qty =  $myData['qty'];
  //     $pembiayaan_produksi_id =  $myData['pembiayaan_produksi_id'];
  //     $pembiayaan_produksi_date =  $myData['pembiayaan_produksi_date'];
  //     $persentase =  $myData['persentase'];
  //     $pp_id =  $myData['pp_id'];
  //     $dataTotal = 0;


  //     $stmt = $koneksidb->prepare('SET @pp := ?');
  //     $stmt->bind_param('s', $pp_id);
  //     $stmt->execute();

  //     $stmt = $koneksidb->prepare('SET @date := ?');
  //     $stmt->bind_param('s', $pembiayaan_produksi_date);
  //     $stmt->execute();

  //     $dataQry = mysqli_query($koneksidb, "call fn_produksi_bb_detail(@pp,@date)");
  //     $dataRow = mysqli_fetch_array($dataQry);
  //     $dataTotalHPP = isset($dataRow['total']) ? $dataRow['total'] : 0;
  //     mysqli_free_result($dataQry);
  //     mysqli_next_result($koneksidb);

  //     $dataTotal      = $dataTotalHPP * ($persentase / 100);
  //     // echo  $dataCode        = buatNomor("stock_order", "", $tgl, 'OUT');
  //     // echo "<br>";
  //     $mySql1 = "INSERT INTO product_hpp (nama_modul, id_modul, hpp_date, product_id, qty, total, updated_by, updated_date)
  //                     VALUES ('Pembiayaan','$pembiayaan_produksi_id','$pembiayaan_produksi_date','$item','$qty','$dataTotal','$ses_nama', now())";
  //     $myQry1 = mysqli_query($koneksidb, $mySql1);
  // }

  // $myQry = mysqli_query($koneksidb, "call fn_billing_payment_detail_ots()");
  // while ($myData = mysqli_fetch_array($myQry)) {
  //     $billing = isset($myData['billing_id']) ? $myData['billing_id'] : '';

  //     // echo  $dataCode        = buatNomor("stock_order", "", $tgl, 'OUT');
  //     // echo "<br>";
  //     $mySql1 = "UPDATE billing SET `billing_paid`='1'
  //     WHERE billing_id = '$billing' ";
  //     $myQry1 = mysqli_query($koneksidb, $mySql1);
  // }
  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper ">

    <div class="container-fluid flex-grow-1 container-p-y">
      <!-- Hour chart  -->
      <div class="card bg-transparent shadow-none my-4 border-0">
        <div class="card-body row p-0 pb-3">
          <div class="col-12 col-md-8 card-separator">
            <h3>Welcome back, Felecia 👋🏻</h3>
            <div class="col-12 col-lg-7">
              <p>Your progress this week is Awesome. let's keep it up and get a lot of points reward !</p>
            </div>
            <!-- <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
              <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                <span class="bg-label-primary p-2 rounded">
                  <i class="ti ti-device-laptop ti-xl"></i>
                </span>
                <div class="content-right">
                  <p class="mb-0">Hours Spent</p>
                  <h4 class="text-primary mb-0">34h</h4>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <span class="bg-label-info p-2 rounded">
                  <i class="ti ti-bulb ti-xl"></i>
                </span>
                <div class="content-right">
                  <p class="mb-0">Test Results</p>
                  <h4 class="text-info mb-0">82%</h4>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <span class="bg-label-warning p-2 rounded">
                  <i class="ti ti-discount-check ti-xl"></i>
                </span>
                <div class="content-right">
                  <p class="mb-0">Course Completed</p>
                  <h4 class="text-warning mb-0">14</h4>
                </div>
              </div>
            </div> -->
          </div>
          <div class="col-12 col-md-4 ps-md-3 ps-lg-4 pt-3 pt-md-0">
            <!-- <div class="d-flex justify-content-between align-items-center">
              <div>
                <div>
                  <h5 class="mb-2">Time Spendings</h5>
                  <p class="mb-5">Weekly report</p>
                </div>
                <div class="time-spending-chart">
                  <h3 class="mb-2">231<span class="text-muted">h</span> 14<span class="text-muted">m</span></h3>
                  <span class="badge bg-label-success">+18.4%</span>
                </div>
              </div>
              <div id="leadsReportChart"></div>
            </div> -->
          </div>
        </div>
      </div>
      <!-- Hour chart End  -->

      <!-- Topic and Instructors -->
      <div class="row mb-4 g-4">
        <div class="col-12 col-xl-8">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Topic you are interested in</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="topic" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                  <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                  <a class="dropdown-item" href="javascript:void(0);">See All</a>
                </div>
              </div>
            </div>
            <div class="card-body row g-3">
              <div class="col-md-6">
                <div id="horizontalBarChart"></div>
              </div>
              <div class="col-md-6 d-flex justify-content-around align-items-center">
                <div>
                  <div class="d-flex align-items-baseline">
                    <span class="text-primary me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">UI Design</p>
                      <h5>35%</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-baseline my-3">
                    <span class="text-success me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">Music</p>
                      <h5>14%</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-baseline">
                    <span class="text-danger me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">React</p>
                      <h5>10%</h5>
                    </div>
                  </div>
                </div>

                <div>
                  <div class="d-flex align-items-baseline">
                    <span class="text-info me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">UX Design</p>
                      <h5>20%</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-baseline my-3">
                    <span class="text-secondary me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">Animation</p>
                      <h5>12%</h5>
                    </div>
                  </div>
                  <div class="d-flex align-items-baseline">
                    <span class="text-warning me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">SEO</p>
                      <h5>9%</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Popular Instructors</h5>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                  <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-borderless border-top">
                <thead class="border-bottom">
                  <tr>
                    <th>Instructors</th>
                    <th class="text-end">courses</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pt-2">
                      <div class="d-flex justify-content-start align-items-center mt-lg-4">
                        <div class="avatar me-3 avatar-sm">
                          <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">Maven Analytics</h6>
                          <small class="text-truncate text-muted">Business Intelligence</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-end pt-2">
                      <div class="user-progress mt-lg-4">
                        <p class="mb-0 fw-medium">33</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-start align-items-center">
                        <div class="avatar me-3 avatar-sm">
                          <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">Zsazsa McCleverty</h6>
                          <small class="text-truncate text-muted">Digital Marketing</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-end">
                      <div class="user-progress">
                        <p class="mb-0 fw-medium">52</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-start align-items-center">
                        <div class="avatar me-3 avatar-sm">
                          <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">Nathan Wagner</h6>
                          <small class="text-truncate text-muted">UI/UX Design</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-end">
                      <div class="user-progress">
                        <p class="mb-0 fw-medium">12</p>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex justify-content-start align-items-center">
                        <div class="avatar me-3 avatar-sm">
                          <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">Emma Bowen</h6>
                          <small class="text-truncate text-muted">React Native</small>
                        </div>
                      </div>
                    </td>
                    <td class="text-end">
                      <div class="user-progress">
                        <p class="mb-0 fw-medium">8</p>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Top Contents</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="topCourses" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topCourses">
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Download</a>
                  <a class="dropdown-item" href="javascript:void(0);">View All</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled mb-0">
                <li class="d-flex mb-4 pb-1 align-items-center">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-video ti-md"></i></span>
                  </div>
                  <div class="row w-100 align-items-center">
                    <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                      <p class="mb-0 fw-medium">Videography Basic Design Content</p>
                    </div>
                    <div class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                      <div class="badge bg-label-secondary">1.2k Views</div>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1 align-items-center">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-info"><i class="ti ti-code ti-md"></i></span>
                  </div>
                  <div class="row w-100 align-items-center">
                    <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                      <p class="mb-0 fw-medium">Basic Front-end Development Content</p>
                    </div>
                    <div class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                      <div class="badge bg-label-secondary">834 Views</div>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1 align-items-center">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success"><i class="ti ti-camera ti-md"></i></span>
                  </div>
                  <div class="row w-100 align-items-center">
                    <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                      <p class="mb-0 fw-medium">Basic Fundamentals of Photography</p>
                    </div>
                    <div class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                      <div class="badge bg-label-secondary">3.7k Views</div>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-4 pb-1 align-items-center">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-brand-dribbble ti-md"></i></span>
                  </div>
                  <div class="row w-100 align-items-center">
                    <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                      <p class="mb-0 fw-medium">Advance Dribble Base Visual Design</p>
                    </div>
                    <div class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                      <div class="badge bg-label-secondary">2.5k Views</div>
                    </div>
                  </div>
                </li>
                <li class="d-flex align-items-center">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-microphone-2 ti-md"></i></span>
                  </div>
                  <div class="row w-100 align-items-center">
                    <div class="col-sm-8 col-lg-12 col-xxl-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                      <p class="mb-0 fw-medium">Your First Singing Lesson</p>
                    </div>
                    <div class="col-sm-4 col-lg-12 col-xxl-4 d-flex justify-content-sm-end justify-content-md-start justify-content-xxl-end">
                      <div class="badge bg-label-secondary">948 Views</div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
          <div class="card h-100">
            <div class="card-body">
              <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                <img class="img-fluid" src="../assets/img/illustrations/girl-with-laptop.png" alt="Card girl image" width="140" />
              </div>
              <h4 class="mb-2 pb-1">New Content</h4>
              <p class="small">
                Next Generation Frontend Architecture Using Layout Engine And React Native Web.
              </p>
              <div class="row mb-3 g-3">
                <div class="col-6">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-calendar-event ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                      <small>Date</small>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">32 minutes</h6>
                      <small>Duration</small>
                    </div>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0);" class="btn btn-primary w-100">Join the event</a>
            </div>
          </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Content Categories</h5>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                <li class="d-flex mb-3 pb-1">
                  <div class="chart-progress me-3" data-color="primary" data-series="72" data-progress_variant="true"></div>
                  <div class="row w-100 align-items-center">
                    <div class="col-9">
                      <div class="me-2">
                        <h6 class="mb-2">User experience Design</h6>
                        <small>120 Content</small>
                      </div>
                    </div>
                    <div class="col-3 text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                        <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-3 pb-1">
                  <div class="chart-progress me-3" data-color="success" data-series="48" data-progress_variant="true"></div>
                  <div class="row w-100 align-items-center">
                    <div class="col-9">
                      <div class="me-2">
                        <h6 class="mb-2">Basic fundamentals</h6>
                        <small>32 Content</small>
                      </div>
                    </div>
                    <div class="col-3 text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                        <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="d-flex mb-3 pb-1">
                  <div class="chart-progress me-3" data-color="danger" data-series="15" data-progress_variant="true"></div>
                  <div class="row w-100 align-items-center">
                    <div class="col-9">
                      <div class="me-2">
                        <h6 class="mb-2">React native components</h6>
                        <small>182 Content</small>
                      </div>
                    </div>
                    <div class="col-3 text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                        <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="d-flex">
                  <div class="chart-progress me-3" data-color="info" data-series="24" data-progress_variant="true"></div>
                  <div class="row w-100 align-items-center">
                    <div class="col-9">
                      <div class="me-2">
                        <h6 class="mb-2">Basic of music theory</h6>
                        <small>56 Content</small>
                      </div>
                    </div>
                    <div class="col-3 text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                        <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                      </button>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--  Topic and Instructors  End-->

      <!-- Content datatable -->
      <!-- <div class="card mb-4">
        <div class="table-responsive mb-3">
          <table class="table datatables-academy-course">
            <thead class="border-top">
              <tr>
                <th></th>
                <th></th>
                <th>Course Name</th>
                <th>Time</th>
                <th class="w-25">Progress</th>
                <th class="w-25">Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div> -->

      <!-- Content datatable End -->
    </div>

    <!-- END: Content-->
    <?php include "footer_user.php"; ?>

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
      $(document).ready(function() {

      });

      var options = {
        series: [{
          name: '',
          data: [44, 55, 57, 56, 61, 58, 63],
          style: {
            colors: ['#F4CF0D', '#E2C219']
          }
        }, {
          name: '',
          data: [76, 85, 101, 98, 87, 105, 91],
          style: {
            colors: ['#F4CF0D', '#E2C219']
          }

        }, ],
        chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'

          },
        },
        dataLabels: {
          enabled: false,
          style: {
            colors: ['#F4CF0D', '#E2C219']
          }
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        },
        yaxis: {
          title: {
            text: ''
          }
        },
        fill: {
          opacity: 1,
          colors: ['#F4CF0D', '#E2C219'],
        },
        tooltip: {
          y: {
            formatter: function(val) {
              return "" + val + " Books"
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();




      // Line



      var options = {
        series: [{
          name: "Visitors",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
        chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight',
          colors: ['#8f1313'], // takes an array which will be repeated on columns
        },
        title: {
          text: '',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart-line"), options);
      chart.render();
    </script>
    </body>

    </html>