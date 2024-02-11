<?php
include_once "library/inc.seslogin.php";
include "header_user.php";
$_SESSION['SES_PAGE'] = "?page=Information-User";

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
  $dataarr['id'] = $myData['id'];

  $dataSumArr[] = $dataarr;
}
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
            <h2 class="content-header-title float-start mb-0"> <?php echo _INFORMATION ?></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a> <?php echo _INFORMATION ?></a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-12">
      <!-- <div class="divider divider-primary">
        <div class="divider-text text-white">News</div>
      </div> -->
      <div class='row'>
        <div class='col-10'>
          <h2 class="mt-3 mb-2"><?php echo _NEWS ?><small style="color:brown"></small></h2>
        </div>
        <div class='col-2'>
          <a href="?page=Information-User-Detail&type=News" type="reset" class="mt-3"><?php echo _MORE ?> </a>
        </div>
      </div>
      <div class=" d-lg-flex align-items-center p-5">

        <div class="row match-height">
          <?php foreach ($dataSumArr as $key => $value) {
            if ($value['headline'] == 1 && $value['type'] == 'News') {

              // Isi
              $num_char = 30;
              $textjudul = $value['title_in'];
              // Isi
              $num_char = 50;
              $text = $value['description_in'];


          ?>
              <div class="col-md-6 col-lg-12">
                <div class="card">
                  <div class="row">
                    <div class='col-lg-6'>
                      <img class="card-img-top" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" style='max-width:50%' />
                    </div>
                    <div class='col-lg-6'>
                      <div class="card-body">
                        <h4 class="card-title h-50"> <a href="?page=Information-Read&id=<?php echo $value['id'] ?>"><?php echo $textjudul ?></a></h4>

                        <p class="card-text">
                          <?= $text ?>
                        </p>
                        <p class="card-text">
                          <?= $value['type'] ?> - <?= $value['updated_date'] ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php }
          } ?>
          <div class="swiper-multiple swiper-container">
            <div class="swiper-wrapper swiper-slide m-lg-0">
              <?php foreach ($dataSumArr as $key => $value) {
                if ($value['type'] == 'News') {

                  // Isi
                  $num_char = 30;
                  $textjudul = $value['title_in'];
                  $textjudul = substr($textjudul, 0, $num_char) . '...';
                  // Isi
                  $num_char = 40;
                  $text = $value['description_in'];
                  $text = substr($text, 0, $num_char) . '...';
              ?>
                  <a href="?page=Information-Read&id=<?php echo $value['id'] ?>">
                    <div class="col-md-6 col-lg-3">
                      <div class="card" style=' width: 95%'>
                        <div class="card-body">
                          <h4 class="card-title h-50"> <a href="?page=Information-Read&id=<?php echo $value['id'] ?>"><?php echo $textjudul ?></a></h4>
                          <h6 class="card-subtitle text-muted"><?= $text ?></h6>
                        </div>
                        <img class="img-fluid" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" />
                        <div class="card-body">
                          <p class="card-text"> <?= $value['type'] ?> - <?= $value['updated_date'] ?> </p>
                        </div>
                      </div>
                    </div>
                  </a>
              <?php }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Left Text-->
    <!-- Left Text Informasi-->
    <div class="col-12">
      <!-- <div class="divider divider-primary">
        <div class="divider-text text-white">Information</div>
      </div> -->
      <div class='row'>
        <div class='col-10'>
          <h2 class="mt-3 mb-2"><?php echo _INFORMATION2 ?><small style="color:brown"></small></h2>
        </div>
        <div class='col-2'>
          <a href="?page=Information-User-Detail&type=Information" type="reset" class="mt-3"><?php echo _MORE ?> </a>
        </div>
      </div>
      <div class=" d-lg-flex align-items-center p-5">
        <div class="row match-height">

          <?php foreach ($dataSumArr as $key => $value) {
            if ($value['headline'] == 1 && $value['type'] == 'Information') {
              // Isi
              $num_char = 30;
              $textjudul = $value['title_in'];
              $textjudul = substr($textjudul, 0, $num_char) . '...';
              // Isi
              $num_char = 40;
              $text = $value['description_in'];
              $text = substr($text, 0, $num_char) . '...';
          ?>
              <div class="col-md-6 col-lg-12">
                <div class="card">
                  <div class="row">
                    <div class='col-lg-6'>
                      <img class="card-img-top" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" style='max-width:50%' />
                    </div>
                    <div class='col-lg-6'>
                      <div class="card-body">
                        <h4 class="card-title"><?= $textjudul ?> </h4>
                        <p class="card-text">
                          <?= $text ?>
                        </p>
                        <p class="card-text">
                          <?= $value['type'] ?> - <?= $value['updated_date'] ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
          <div class="swiper-multiple swiper-container">
            <div class="swiper-wrapper swiper-slide m-lg-0">
              <?php foreach ($dataSumArr as $key => $value) {
                if ($value['type'] == 'Information') {
                  $num_char = 30;
                  $textjudul = $value['title_in'];
                  $textjudul = substr($textjudul, 0, $num_char) . '...';
                  // Isi
                  $num_char = 40;
                  $text = $value['description_in'];
                  $text = substr($text, 0, $num_char) . '...';

              ?>
                  <div class="col-md-6 col-lg-3">
                    <div class="card" style=' width: 95%'>
                      <div class="card-body">
                        <h4 class="card-title h-50"> <a href="?page=Information-Read&id=<?php echo $value['id'] ?>"><?php echo $textjudul ?></a></h4>
                        <h6 class="card-subtitle text-muted"><?= $text ?></h6>
                      </div>
                      <img class="img-fluid" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" />
                      <div class="card-body">
                        <p class="card-text"> <?= $value['type'] ?> - <?= $value['updated_date'] ?> </p>
                      </div>
                    </div>
                  </div>

              <?php }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Left Text-->
    <!-- Left Text Artikel-->
    <div class="col-12">
      <!-- <div class="divider divider-primary">
        <div class="divider-text text-white">Information</div>
      </div> -->
      <div class='row'>
        <div class='col-10'>
          <h2 class="mt-3 mb-2"><?php echo _ARTICLE ?><small style="color:brown"></small></h2>
        </div>
        <div class='col-2'>
          <a href="?page=Information-User-Detail&type=Information" type="reset" class="mt-3"><?php echo _MORE ?> </a>
        </div>
      </div>
      <div class=" d-lg-flex align-items-center p-5">
        <div class="row match-height">

          <?php foreach ($dataSumArr as $key => $value) {
            if ($value['headline'] == 1 && $value['type'] == 'Article') {
              // Isi
              $num_char = 30;
              $textjudul = $value['title_in'];
              $textjudul = substr($textjudul, 0, $num_char) . '...';
              // Isi
              $num_char = 40;
              $text = $value['description_in'];
              $text = substr($text, 0, $num_char) . '...';
          ?>
              <div class="col-md-6 col-lg-12">
                <div class="card">
                  <div class="row">
                    <div class='col-lg-6'>
                      <img class="card-img-top" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" style='max-width:50%' />
                    </div>
                    <div class='col-lg-6'>
                      <div class="card-body">
                        <h4 class="card-title"><?= $textjudul ?> </h4>
                        <p class="card-text">
                          <?= $text ?>
                        </p>
                        <p class="card-text">
                          <?= $value['type'] ?> - <?= $value['updated_date'] ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
          <div class="swiper-multiple swiper-container">
            <div class="swiper-wrapper swiper-slide m-lg-0">
              <?php foreach ($dataSumArr as $key => $value) {
                if ($value['type'] == 'Information') {
                  $num_char = 30;
                  $textjudul = $value['title_in'];
                  $textjudul = substr($textjudul, 0, $num_char) . '...';
                  // Isi
                  $num_char = 40;
                  $text = $value['description_in'];
                  $text = substr($text, 0, $num_char) . '...';

              ?>
                  <div class="col-md-6 col-lg-3">
                    <div class="card" style=' width: 95%'>
                      <div class="card-body">
                        <h4 class="card-title h-50"> <a href="?page=Information-Read&id=<?php echo $value['id'] ?>"><?php echo $textjudul ?></a></h4>
                        <h6 class="card-subtitle text-muted"><?= $text ?></h6>
                      </div>
                      <img class="img-fluid" src="../uploads/cover_information/<?= $value['file'] ?>" alt="Card image cap" />
                      <div class="card-body">
                        <p class="card-text"> <?= $value['type'] ?> - <?= $value['updated_date'] ?> </p>
                      </div>
                    </div>
                  </div>

              <?php }
              } ?>
            </div>
          </div>
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