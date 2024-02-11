<?php
include "header_da.php";

?>

<div class="app-content content ">
  <?php

  // $tgl             = date('Y-m-d H:i:s');
  $ses_nama = $_SESSION['SES_NAMA'];

  // echo  $dataCode        = buatNomor("stock_order", "", $tgl, 'OUT');

  // $mySql     = "SELECT ppd.*,pd.item,pp.pembiayaan_produksi_date,pp.pp_id FROM pembiayaan_produksi pp join pembiayaan_produksi_detail ppd 
  // join produksi_detail pd WHERE pp.pembiayaan_produksi_id=ppd.pembiayaan_produksi_id and ppd.product_detail_id=pd.pp_detail_id order by pp.pembiayaan_produksi_date";
  // $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
  // while ($myData = mysqli_fetch_array($myQry)) {
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
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h3 class="content-header-title float-start mb-0">Digital Signage</h3>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Digital Signage</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <div class="row">
            <!-- users list start -->
            <div class="col-lg-12 col-sm-6">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="card" style="height:150% ;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                      <div>
                        <?php
                        $mySql     = "SELECT * FROM master_user where user_group = 'User' and user_status='Active'";
                        $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
                        $myCountUser = mysqli_num_rows($myQry)
                        ?>
                        <span>Total User</span>
                        <h3 class="fw-bolder mb-75"><?php echo $myCountUser ?></h3>
                      </div>
                      <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                          <i data-feather="users" class="font-medium-4"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="card" style="height:150%">
                    <div class=" card-body d-flex align-items-center justify-content-between">
                      <div>
                        <span>Total Visitor</span>
                        <?php
                        $mySql     = "SELECT * FROM log_user group by user_id";
                        $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
                        $myCountVisitor = mysqli_num_rows($myQry)
                        ?>
                        <h3 class="fw-bolder mb-75"><?php echo $myCountVisitor ?></h3>
                      </div>
                      <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                          <i data-feather="airplay" class="font-medium-4"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12 col-sm-6" style="padding-top:100px">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="card " style='height:150%'>

                    <div class="card-body d-flex align-items-center justify-content-between">
                      <div>
                        <?php
                        $mySql     = "SELECT * FROM view_document where category_level_1 ='DIGITAL'";
                        $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
                        $myCountBookDig = mysqli_num_rows($myQry)
                        ?>
                        <span>Total Physical Book</span>
                        <h3 class="fw-bolder mb-75"><?php echo $myCountBookDig ?></h3>
                      </div>
                      <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                          <i data-feather="book" class="font-medium-4"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6" >
                  <div class="card" style='height:150%'>
                    <div class="card-body d-flex align-items-center justify-content-between">
                      <div>
                        <?php
                        $mySql     = "SELECT * FROM view_document where category_level_1 ='PHYSICAL'";
                        $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
                        $myCountBookPhy = mysqli_num_rows($myQry)
                        ?>
                        <span>Total Digital Book</span>
                        <h3 class="fw-bolder mb-75"><?php echo $myCountBookPhy ?></h3>
                      </div>
                      <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                          <i data-feather="smartphone" class="font-medium-4"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- list and filter start -->

        <!-- Top Chart -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card" style="background-color:lightgoldenrodyellow">
            <div class="card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
              <h4 class="card-title">Total Documents Read</h4>
              <div class="d-flex align-items-center mt-md-0 mt-1">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <div id="chart"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12">
          <div class="card" style="background-color:lightgoldenrodyellow">
            <div class="
            card-header
            d-flex
            flex-md-row flex-column
            justify-content-md-between justify-content-start
            align-items-md-center align-items-start
          ">
              <h4 class="card-title">Total Daily Visitor</h4>
              <div class="d-flex align-items-center mt-md-0 mt-1">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <div id="chart-line"></div>
            </div>
          </div>
        </div>
        <!--/ Top Chart -->

        <!-- PHYSICAL -->
        <!-- Top Chart Reader -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Top 3 Rating Physical Books</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT * FROM view_top10_document_rating where category_level_1 = 'PHYSICAL' group by document_id order by document_rating desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='star'></i> <?php echo round($myDataUser10['document_value']) ?> </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>


        <!--/ Top Chart Reader -->


        <!-- Top Document -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Top 3 Populer Books - Physical</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT *  FROM view_top10_document_favourite  where category_level_1 = 'PHYSICAL'  order by document_count desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='bar-chart-2'></i> <?php echo round($myDataUser10['document_count']) ?> Total Borrowed</div>
                    <div id="browser-state-chart-primary"></div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>


        <!--/ Top Document -->


        <!-- Total Document Starts -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Latest Book - Physical</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT * FROM view_document where category_level_1 = 'PHYSICAL' order by updated_date desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='eye'></i></i></div>
                    <div id="browser-state-chart-primary"></div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- Total Document Ends -->

        <!-- PHYSICAL -->
        <!-- Top Chart Reader -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Top 3 Rating Digital Books</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT * FROM view_top10_document_rating where category_level_1 = 'DIGITAL' group by document_id order by document_rating desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='star'></i> <?php echo round($myDataUser10['document_value'] )?> </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>


        <!--/ Top Chart Reader -->


        <!-- Top Document -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Top 3 Populer Books - Digital</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT *  FROM view_top10_document_favourite  where category_level_1 = 'DIGITAL'  order by document_count desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='bar-chart-2'></i> <?php echo $myDataUser10['document_count'] ?> Total Borrowed</div>
                    <div id="browser-state-chart-primary"></div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>


        <!--/ Top Document -->

        <!-- Digital -->
        <!-- Total Document Starts -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card card-browser-states" style="background-color: #fae0d9; background-image: linear-gradient(#fae0d9, #e08870); height:90%">
            <div class="card-header">
              <div>
                <h4 class="card-title">Latest Book - Digital</h4>
              </div>
              <div class="dropdown chart-dropdown">
                <!-- <i data-feather='calendar'></i> 2022-01-01 to 2022-12-30 -->
              </div>
            </div>
            <div class="card-body">
              <?php
              $mySql     = "SELECT * FROM view_document where category_level_1 = 'DIGITAL' order by updated_date desc limit 3";
              $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));

              while ($myDataUser10 = mysqli_fetch_assoc($myQry)) { ?>
                <div class="browser-states">
                  <div class="d-flex">
                    <h6 class="align-self-center mb-0"><?php echo $myDataUser10['document_title_id'] ?></h6>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fw-bold text-body-heading me-1"><i style='color:darkgoldenrod' data-feather='eye'></i></i></div>
                    <div id="browser-state-chart-primary"></div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- Total Document Ends -->


        <div class="clearfix">&nbsp;</div>

      </div>
    </div>
  </div>
  </form>
</div>
</div>
<!-- END: Content-->
<?php include "footer_difan.php"; ?>
<script>
  $(document).ready(function() {

  });
  <?php
  $databulan2 = array();
  $datatotal2 = array();
  $mySql2   = "select log_date, sum(total) as total from view_log_document_read  group by log_date order by log_date asc limit 3";
  $myQry2   = mysqli_query($koneksidb, $mySql2)  or die("Error query " . mysqli_error($koneksidb));
  while ($myData2 = mysqli_fetch_array($myQry2)) {
    $databulan2[] = $myData2['log_date'];
    $datatotal2[] = $myData2['total'];
  }
  ?>


  var options = {
    series: [{
      name: '',
      data: [<?php foreach ($datatotal2 as $total) {
                echo $total . ',';
              } ?>],
      style: {
        colors: ['#F4CF0D', '#E2C219']
      }
    } ],
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
      categories: [<?php foreach ($databulan2 as $tgl) {
                      echo '"' . $tgl . '",';
                    } ?>],
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

  <?php
  // $databulan3 = array();
  $datatotal3 = array();
  $mySql3   = "select daily, sum(total) as total from view_log_user_daily where  (daily > DATE_SUB(now(), INTERVAL 30 DAY))";
  // if ($tgl1 != $now) {
  // 	$mySql  .=  "and daily >= '$tgl1'";
  // }
  // if ($tgl2 != $now) {
  // 	$mySql  .=  "and daily <= '$tgl2'";
  // }
  $mySql3  .=  "group by daily order by daily limit 10";
  $myQry3   = mysqli_query($koneksidb, $mySql3)  or die("Error query " . mysqli_error($koneksidb));
  while ($myData3 = mysqli_fetch_array($myQry3)) {
    $databulan3[] = date_format(new DateTime($myData3['daily']), "d F");
    $datatotal3[] = floor($myData3['total']);
  }
  ?>

  var options = {
    series: [{
      name: "Visitors",
      data: [<?php foreach ($datatotal3 as $total) {
                echo $total . ',';
              } ?>]
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
      categories: [<?php foreach ($databulan3 as $tgl) {
                      echo '"' . $tgl . '",';
                    } ?>],
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart-line"), options);
  chart.render();
</script>
</body>

</html>