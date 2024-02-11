<?php
include_once "library/inc.seslogin.php";
include "header_user.php";
$type = $_GET['type'];

$_SESSION['SES_PAGE'] = "?page=Information-User-Detail&type=$type";

?>

<style>

</style>
<div class="app-content content ">
  <?php
  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper ">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0"><?php echo _INFORMATION ?></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a><?php echo _INFORMATION ?></a>
                </li>
                <li class="breadcrumb-item"><a><?php echo _INFORMATION2 ?></a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class='row'>
    </div>


    <div class='card' style="background-color:ghostwhite">
      <div class="d-lg-flex col-lg-12 align-items-center p-5">
        <div class="row match-height">
          <?php
          $batas = 5;
          $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
          $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

          $previous = $halaman - 1;
          $next = $halaman + 1;

          $mySql1 = "select * from information where type='$type' order by updated_date desc limit $halaman_awal, $batas";
          $myQry1 = mysqli_query($koneksidb, $mySql1) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
          $nomor = $halaman_awal + 1;
          $jumlah_review = mysqli_num_rows($myQry1);

          $mySql = "select * from information where type='$type' order by updated_date desc ";
          $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
          $jumlah_data = mysqli_num_rows($myQry);
          $total_halaman = ceil($jumlah_data / $batas);
          while ($myData1 = mysqli_fetch_array($myQry1)) {

            $myData1['file'];
            $id = $myData1['id'];
            if ($lang =='id') {
             $lang = 'in';
            }
            $num_char = 30;
            $textjudul = $myData1['title_' . $lang];
            $textjudul = substr($textjudul, 0, $num_char) . '...';
            // Isi
            $num_char = 40;
            $text = $myData1['description_' . $lang];
            $text = substr($text, 0, $num_char) . '...';
          ?>
            <div class="col-md-6 col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-50"> <a href="?page=Information-Read&id=<?php echo $id ?>"><?php echo $textjudul ?></a></h4>

                  <h6 class="card-subtitle text-muted"><?php echo $text ?></h6>
                </div>
                <img class="img-fluid" src="../uploads/cover_information/<?php echo $myData1['file'] ?>" alt="Card image cap" />
                <div class="card-body">
                  <p class="card-text">
                    <?php echo $myData1['type'] ?> - <?php echo $myData1['updated_date'] ?>
                  </p>
                </div>
              </div>
            </div>
          <?php } ?>


        </div>
      </div>




      <!-- E-commerce Pagination Starts -->
      <section id="ecommerce-pagination">
        <div class="row">
          <div class="col-sm-12">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center mt-2">

                <li class="page-item">
                  <a class="page-link" <?php if ($halaman > 1) {
                                          echo "href='?page=Information-User-Detail&type=$type &halaman=$previous'";
                                        } ?>> < </a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                  if ($halaman == $x) { ?>
                    <li class="page-item"><a class="page-link" href="?page=Information-User-Detail&type=<?php echo $type  ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="?page=Information-User-Detail&type=<?php echo $type  ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php  }
                }
                ?>
                <li class="page-item">
                  <a class="page-link" <?php if ($halaman < $total_halaman) {
                                          echo "href='?page=Information-User-Detail&type=$type &halaman=$next'";
                                        } ?>> > </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>
    </div>
    <!-- E-commerce Pagination Ends -->



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