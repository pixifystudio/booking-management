<?php
include_once "library/inc.seslogin.php";
include "header_user.php";

$_SESSION['SES_PAGE'] = "?page=Buku-Detail";

$order = isset($_GET['order']) ? $_GET['order'] : '';
$setorder = $order;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$rating = isset($_GET['rating']) ? $_GET['rating'] : '';



if ($order == 'new') {
  $order = 'order by updated_date desc';
} else if ($order == 'old') {
  $order = 'order by updated_date asc';
} else if ($order == 'rating') {
  $order = 'order by document_id asc';
} else {
  $order = 'order by document_id asc';
}

if ($kategori != '') {
  $kategori1 = "and category_level_2 ='" . $kategori . "'";
} else {
  $kategori1 = '';
}

if ($rating != '') {
  $rating1 = "and document_value >=$rating";
} else {
  $rating1 = '';
}



$mySql = "SELECT  * FROM view_document where category_level_1 = 'PHYSICAL' and document_description_en != '' $kategori1 $rating1 group by document_id $order";
$myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
$mysqlNum = mysqli_num_rows($myQry);
?>

<body class="horizontal-layout horizontal-menu content-detached-left-sidebar navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">


  <!-- BEGIN: Content-->
  <div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0"><?php echo _BOOKDETAIL; ?></h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><?php echo _PHYSICAL ?></a>
                  </li>
                  <li class="breadcrumb-item Active"><a href="#"><?php echo _BOOKDETAIL; ?></a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
          <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
              <!-- <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button> -->
              <!-- <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div> -->
            </div>
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col-1'>
          <div class="sidebar-detached">
            <div class="sidebar">
              <!-- Ecommerce Sidebar Starts -->
              <div class="sidebar-shop">
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="filter-heading d-none d-lg-block">Filter</h4>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <!-- Price Filter starts -->
                    <div class="multi-range-price">
                      <h6 class="filter-title mt-0"><?php echo _TYPE ?></h6>
                      <ul class="list-unstyled price-range" id="price-range">
                        <li>
                          <!-- <div class="form-check">
                            <input type="radio" id="priceAll" name="price-range" class="form-check-input" checked />
                            <label class="form-check-label" for="priceAll">All</label>
                          </div> -->
                        </li>
                        <li>
                          <!-- <div class="form-check">
                            <input type="radio" id="priceRange1" name="price-range" class="form-check-input" />
                            <label class="form-check-label" for="priceRange1">Semua Jenis</label>
                          </div> -->
                        </li>
                        <li>
                          <div class="form-check">
                            <input type="radio" id="priceRange2" name="price-range" href='' class="form-check-input" checked />
                            <label class="form-check-label" for="priceRange2"> <a href="?page=Buku-Detail"><?php echo _PHYSICAL ?> </a></label>

                          </div>
                        </li>
                        <li>
                          <div class="form-check">
                            <input type="radio" id="priceARange3" name="price-range" class="form-check-input" />
                            <label class="form-check-label" for="priceARange3"><a href="?page=Buku-Digital-Detail"><?php echo _DIGITAL ?> </a></label>
                          </div>
                        </li>
                        <li>
                        </li>
                      </ul>
                    </div>
                    <!-- Price Filter ends -->


                    <!-- Categories Starts -->
                    <div id="product-categories">
                      <h6 class="filter-title"><?php echo _CATEGORY ?></h6>
                      <ul class="list-unstyled categories-list">
                        <li>
                          <div class="form-check">
                            <input type="radio" id="category1" name="category-filter" class="form-check-input" checked />
                            <label class="form-check-label" for="category1"><a href="?page=Buku-Detail&order=<?php echo $setorder ?>&halaman= <?php echo $halaman ?>&kategori="><?php echo _ALL . ' ' . _CATEGORY ?></a></label>
                          </div>
                        </li>
                        <?php
                        $mySql2 = "SELECT * FROM master_category where category_level_1 = 'PHYSICAL' group by category_level_1, category_level_2 order by category_level_2";
                        $myQry2 = mysqli_query($koneksidb, $mySql2) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                        while ($myData2 = mysqli_fetch_array($myQry2)) {
                          $checked = '';
                          $kategori_level_2 = "$myData2[category_level_2]";
                          $kategori;
                          if ($kategori == $kategori_level_2) {
                            $checked = "checked";
                          }
                        ?>
                          <li>
                            <div class="form-check">
                              <input type="radio" id="category2" name="category-filter" class="form-check-input" <?php echo $checked ?> />
                              <label class="form-check-label" for="category2"><a href="?page=Buku-Detail&order=<?php echo $setorder ?>&halaman= <?php echo $halaman ?>&kategori=<?php echo $myData2['category_level_2'] ?>"><?php echo $myData2['category_level_2'] ?></a></label>
                            </div>
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                    <!-- Categories Ends -->

                    <!-- Rating starts -->

                    <!-- Categories Starts -->
                    <div id="ratings">
                      <h6 class="filter-title">Rating</h6>
                      <ul class="list-unstyled categories-list">

                        <?php
                        $mySql2 = "SELECT * FROM master_status where status_group = 'Rating' order by status_name desc";
                        $myQry2 = mysqli_query($koneksidb, $mySql2) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                        while ($myData2 = mysqli_fetch_array($myQry2)) {
                          $checked = '';
                          $document_value = "$myData2[status_name]";
                          $rating;
                          if ($rating == $document_value) {
                            $checked = "checked";
                          }

                        ?>
                          <li>
                            <div class="form-check">
                              <input type="radio" id="category3" name="rating-filter" class="form-check-input" <?php echo $checked ?> />
                              <label class="form-check-label" for="category3"><a href="?page=Buku-Detail&order=<?php echo $setorder ?>&halaman= <?php echo $halaman ?>&kategori=<?php echo $kategori ?>&rating= <?php echo $document_value ?>">
                                  <i data-feather="star" class="filled-star"></i>
                                  <?php echo $myData2['status_name'] ?> <?php echo _ABOVE ?></a></label>
                            </div>
                          </li>
                        <?php } ?>
                      </ul>
                    </div>





                    <!-- Rating ends -->


                  </div>
                </div>
              </div>
              <!-- Ecommerce Sidebar Ends -->

            </div>
          </div>
        </div>
        <div class='col-11'>
          <div class="content-detached content-right">
            <div class="content-body">
              <!-- E-commerce Content Section Starts -->
              <section id="ecommerce-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="ecommerce-header-items">
                      <div class="result-toggler">
                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                          <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                        </button>
                        <div class="search-results"><?php echo _SHOW ?> <?php echo $mysqlNum ?> <?php echo _BOOK ?></div>
                      </div>
                      <div class="view-options d-flex">
                        <div class="btn-group dropdown-sort">
                          <button type="button" class="btn btn-outline-primary dropdown-toggle me-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="active-sorting"><?php echo _ORDER ?></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="?page=Buku-Detail&order=new"><?php echo _NEW ?></a>
                            <a class="dropdown-item" href="?page=Buku-Detail&order=old"><?php echo _OLD ?></a>
                            <a class="dropdown-item" href="?page=Buku-Detail&order=rating"><?php echo _HIGHEST ?></a>
                          </div>
                        </div>
                        <div class="btn-group" role="group">
                          <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                          <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn" for="radio_option1"><i data-feather="grid" class="font-medium-3"></i></label>
                          <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                          <label class="btn btn-icon btn-outline-primary view-btn list-view-btn" for="radio_option2"><i data-feather="list" class="font-medium-3"></i></label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- E-commerce Content Section Starts -->


              <!-- E-commerce Products Starts -->
              <section id="ecommerce-products" class="grid-view">
                <?php
                $batas = 9;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $mySql = "SELECT  * FROM view_document where category_level_1 = 'PHYSICAL' $kategori1 $rating1  group by document_id $order  limit $halaman_awal, $batas";
                $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                $nomor = $halaman_awal + 1;
                $mySql2 = "SELECT  * FROM view_document where category_level_1 = 'PHYSICAL' $kategori1 $rating1 group by document_id $order limit 100";
                $myQry2 = mysqli_query($koneksidb, $mySql2) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                $jumlah_data = mysqli_num_rows($myQry2);
                $total_halaman = ceil($jumlah_data / $batas);
                while ($myData = mysqli_fetch_array($myQry)) {
                  $document_id = $myData['document_id'];
                  $title = $myData['document_title_' . $lang];
                  $category = $myData['category_level_3'];
                  $publisher = $myData['document_publisher'];
                  $cover = isset($myData['document_cover']) ? $myData['document_cover'] : '';
                  $description = $myData['document_description_' . $lang];


                ?>
                  <div class="card ecommerce-card">
                    <div class="item-img text-center">
                      <a href="#">
                        <img class="img-fluid card-img-top" src="../uploads/cover/<?php echo $cover ?>" alt="img-placeholder" /></a>
                    </div>
                    <div class="card-body">



                      <div class="item-wrapper">
                        <div class="item-rating">
                          <ul class="unstyled-list list-inline">
                            <!-- <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                      <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                      <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                      <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                      <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li> -->
                          </ul>
                        </div>
                        <div>
                          <!-- <h6 class="item-price">$339.99</h6> -->
                        </div>
                      </div>

                      <h5 class="item-name">
                        <a class="text-body" href="#"><?php echo $title ?></a>
                        <span class="card-text item-company"> <?php echo $category ?> | <?php echo _BY ?> <?php echo $publisher ?></span>
                        </h6>
                        <p class="card-text item-description">
                          <i class="me-50" data-feather="eye"></i> - <?php echo _BORROW ?> - <i class="mr-5" data-feather="star"></i>
                        </p>
                        <p class="card-text item-description">
                          <?php echo $description ?>
                        </p>
                    </div>
                    <div class="item-options text-center">
                      <div class="item-wrapper">
                        <div class="item-cost">
                        </div>
                      </div>
                      <a href="?page=Buku-Detail-View&id=<?php echo $document_id ?>" class="btn btn-primary" style="width:100%">
                        <i data-feather="eye"></i>
                        <span class="add-to-cart"><?php echo _DETAIL ?></span>
                      </a>
                    </div>
                  </div>
                <?php
                }
                ?>

              </section>
              <!-- E-commerce Products Ends -->

              <!-- E-commerce Pagination Starts -->
              <section id="ecommerce-pagination">
                <div class="row">
                  <div class="col-sm-12">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center mt-2">

                        <li class="page-item">
                          <a class="page-link" <?php if ($halaman > 1) {

                                                  if ($kategori != '') {
                                                    $kategori = "&kategori= " . $kategori;
                                                  } else {
                                                    $kategori = '';
                                                  }

                                                  if ($rating != '') {
                                                    $rating = "&rating= " . $rating;
                                                  } else {
                                                    $rating = '';
                                                  }

                                                  echo "href='?page=Buku-Detail&order=$setorder&halaman=$previous $kategori $rating'";
                                                } ?> > < </a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $total_halaman; $x++) {
                          if ($halaman == $x) { ?>
                            <li class="page-item active"><a class="page-link" href="?page=Buku-Detail&order=<?php echo $setorder ?>&halaman=<?php echo $x ?> <?php echo $kategori ?> <?php echo $rating ?>"><?php echo $x; ?></a></li>
                          <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="?page=Buku-Detail&order=<?php echo $setorder ?>&halaman=<?php echo $x ?> <?php echo $kategori ?> <?php echo $rating ?>"><?php echo $x; ?></a></li>
                        <?php  }
                        }
                        ?>
                        <li class="page-item">
                          <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                  echo "href='?page=Buku-Detail&order=$setorder&halaman=$next $kategori $rating'";
                                                } ?>> > </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </section>
              <!-- E-commerce Pagination Ends -->

            </div>
          </div>
        </div>
      </div>


    </div>
  </div>


  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>



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


  <!-- </body> -->

  <!-- END: Content-->
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
<?php include "footer_user.php"; ?>