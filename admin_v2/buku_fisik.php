<?php
include_once "library/inc.seslogin.php";
include "header_user.php";

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
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <!-- <div class="col-12">
            <h3 class="content-header-title float-start mb-0">Kategori Buku Fisik</h3>
          </div> -->
        </div>
      </div>
    </div>


    <div class='row'>
      <div class='col-11'>
        <h2 class="mt-3 mb-2"><?php echo _NEWBOOK ?><small style="color:brown"> <?php echo _PHYSICAL ?></small></h2>
      </div>
      <div class='col-1'>
        <a href="?page=Buku-Detail" type="reset" class="mt-3"><?php echo _MORE ?> </a>
      </div>
    </div>



    <div class="row">
      <div class="card-body">
        <div class="swiper-multiple swiper-container ml-10">
          <div class="swiper-wrapper swiper-slide m-lg-0">
            <?php
            $mySql = "SELECT  * FROM view_document where category_level_1 = 'PHYSICAL' group by document_id order by document_id asc limit 5";
            $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
            while ($myData = mysqli_fetch_array($myQry)) {
              $title = $myData['document_title_' . $lang];
              $category = $myData['category_level_3'];
              $publisher = $myData['document_publisher'];
              $cover = $myData['document_cover'];
              $id = $myData['document_id'];

              // Isi
              $num_char = 10;
              $textjudul = $myData['document_title_' . $lang];
              $textjudul = substr($textjudul, 0, $num_char) . '...';


            ?>
              <div class="swiper-slide">
                <a href="?page=Buku-Detail-View&id=<?php echo $id ?>">

                  <div class="col-md-12">
                    <div class="card" style=' width: 70%'>
                      <img class="card-img-top" src="../uploads/cover/<?php echo $cover ?>" style='height:400px' alt="Card image cap" />
                      <div class="card-body">
                        <h4 class=""><a href="?page=Buku-Detail-View&id=<?php echo $id ?>"><?php echo $textjudul ?></a></h4>
                        <h5 style='color:brown' class=""></h5>
                        <p class="card-text">
                          <?php echo $category ?> | <?php echo _BY ?> <?php echo $publisher ?>
                        </p>
                        <p class="card-text">
                          <i class="me-50" data-feather="eye"></i>- <?php echo _BORROW ?> - <i class="mr-5" data-feather="star"></i>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>

      <div class='row'>
        <div class='col-11'>
          <h2 class="mt-3 mb-2"><?php echo _POPULARBOOK ?><small style="color:brown"> <?php echo _PHYSICAL ?></small></h2>
        </div>
        <div class='col-1'>
          <a href="?page=Buku-Detail" type="reset" class="mt-3"><?php echo _MORE ?></a>
        </div>
      </div>



      <div class="row">
        <div class="card-body">
          <div class="swiper-multiple swiper-container ml-10">
            <div class="swiper-wrapper swiper-slide m-lg-0">
              <?php
              $mySql = "SELECT  * FROM view_document where category_level_1 = 'PHYSICAL' group by document_id order by document_id asc limit 5";
              $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
              while ($myData = mysqli_fetch_array($myQry)) {
                $title = $myData['document_title_' . $lang];
                $category = $myData['category_level_3'];
                $publisher = $myData['document_publisher'];
                $cover = $myData['document_cover'];
                $id = $myData['document_id'];


              ?>
                <div class="swiper-slide">
                  <a href="?page=Buku-Detail-View&id=<?php echo $id ?>">
                    <div class="col-md-12">
                      <div class="card" style=' width: 70%'>
                        <img class="card-img-top" src="../uploads/cover/<?php echo $cover ?>" style='height:400px' alt="Card image cap" />
                        <div class="card-body">
                          <h4 class=""><a href="?page=Buku-Detail-View&id=<?php echo $id ?>"><?php echo $title ?></a></h4>
                          <h5 style='color:brown' class=""></h5>
                          <p class="card-text">
                            <?php echo $category ?> | <?php echo _BY ?> <?php echo $publisher ?>
                          </p>
                          <p class="card-text">
                            <i class="me-50" data-feather="eye"></i>-<?php echo _BORROW ?> - <i class="mr-5" data-feather="star"></i>
                          </p>
                        </div>
                      </div>
                  </a>
                </div>
            </div>
          <?php
              }
          ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>



    </div>

  </div>
  </form>
</div>
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