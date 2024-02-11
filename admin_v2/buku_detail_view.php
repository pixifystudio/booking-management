<?php
include_once "library/inc.seslogin.php";
include "header_user.php";


$getID  = isset($_GET['id']) ?  $_GET['id'] : '';
$getVersion  = isset($_GET['v']) ?  $_GET['v'] : '1';
$_SESSION['SES_PAGE'] = "?page=Buku-Detail-View&id=" . $getID;
$User = $_SESSION['SES_USERID'];
$mySql   = "SELECT * FROM view_document where document_id='$getID' ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);
$Code = $myData['document_id'];
$racking_id = $myData['racking_id'];


$mySql2   = "SELECT *, sum(qty) as sum_qty FROM view_stock where product_id='$getID' ";
$myQry2   = mysqli_query($koneksidb, $mySql2)  or die("Error query " . mysqli_error($koneksidb));
$myData2 = mysqli_fetch_array($myQry2);

$jumlahbuku = $myData2['sum_qty'];


// racking
$mySql3   = "SELECT * FROM master_racking where racking_id='$racking_id' ";
$myQry3   = mysqli_query($koneksidb, $mySql3)  or die("Error query " . mysqli_error($koneksidb));
$myData3 = mysqli_fetch_array($myQry3);



$racking_number = $myData3['racking_number'];

$tgl = date('Y-m-d');
$dataCode    = $myData['document_id'];
$dataStatus    = $myData['document_status'];
$dataDate    = $myData['document_date'];
echo $dataCover   = $myData['document_cover'];
if ($dataStatus  == "Created" || $dataStatus  == "Updated" || $dataStatus  == "Revised") {
  $dataVersion    = $myData['document_version'];
} else {
  $dataVersion    = $myData['document_version'] + 1;
}
$dataYear       = isset($_POST['txtYear']) ? $_POST['txtYear'] : $myData['document_year'];
$dataAuthor     = isset($_POST['txtAuthor']) ? $_POST['txtAuthor'] : $myData['document_author'];
$dataPublisher  = isset($_POST['txtPublisher']) ? $_POST['txtPublisher'] : $myData['document_publisher'];
$dataCategory   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : $myData['category_level_2'];
$dataCategory3   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : $myData['category_level_3'];
$dataCategory4   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : $myData['category_level_4'];

$dataExpireDate       = isset($_POST['txtExpired']) ? $_POST['txtExpired'] : $myData['document_expire_date'];
$dataKeyword    = isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $myData['document_keyword'];
$dataTitleID    = isset($_POST['txtTitleID']) ? $_POST['txtTitleID'] : $myData['document_title_' . $lang];
$dataTitleEN    = isset($_POST['txtTitleEN']) ? $_POST['txtTitleEN'] : $myData['document_title_en'];
$dataDescID     = isset($_POST['txtDescriptionID']) ? $_POST['txtDescriptionID'] : $myData['document_description_' . $lang];
$dataDescEN     = isset($_POST['txtDescriptionEN']) ? $_POST['txtDescriptionEN'] : $myData['document_description_en'];


# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();




  # BACA DATA DALAM FORM, masukkan datake variabel
  $txtReview = $_POST['txtReview'];
  $txtRating = $_POST['txtRating'];



  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError) >= 1) {
    echo "&nbsp;<div class='alert alert-warning'>";
    $noPesan = 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div>";
  } else {
    # SIMPAN DATA KE DATABASE. 

    $ses_nama  = $_SESSION['SES_NAMA'];
    $ses_id = $_SESSION['SES_USERID'];
    $mySql    = "INSERT INTO document_review ( document_id, user_id, rating, description , review_date, updated_by, updated_date)
						VALUES ('$getID','$ses_id','$txtRating','$txtReview',now(), '$ses_nama',now())";
    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Buku-Digital-Detail-View&id=$getID'>";
    }
    exit;
  }
} // Penutup Tombol Submit

?>
<style>
  .txt-center {
    text-align: center;
  }

  .hide {
    display: none;
  }

  .clear {
    float: none;
    clear: both;
  }

  .rating {
    width: 75%;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
    color: #000;
  }

  .rating>label {
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
  }

  .rating>label:hover,
  .rating>label:hover~label,
  .rating>input.radio-btn:checked~label {
    color: transparent;
  }

  .rating>label:hover:before,
  .rating>label:hover~label:before,
  .rating>input.radio-btn:checked~label:before,
  .rating>input.radio-btn:checked~label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
  }
</style>

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">



  <!-- BEGIN: Content-->
  <div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0"><?php echo _BOOKDETAIL ?></h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><?php echo _DIGITAL ?></a>
                  </li>
                  <li class="breadcrumb-item active"><?php echo _BOOKDETAIL ?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
          <div class="mb-1 breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="?page=Buku-Fisik" aria-haspopup="true" aria-expanded="false"><i data-feather="arrow-left"></i></a>
          </div>
        </div>
      </div>
      <div class="content-body">

        <!-- app e-commerce details start -->
        <section class="app-ecommerce-details">
          <div class="">

            <!-- Product Details starts -->
            <div class="card">

              <div class="row my-2  justify-content-center">

                <div class="col-12 col-md-4 d-flex align-items-center  mb-2 mb-md-0">

                  <div class="col-12 col-md-12">
                    <div class="card align-items-center justify-content-center">
                      <img style='width:75%' src="../uploads/cover/<?= $dataCover ?>" class="img-fluid product-img" alt="product image" />
                    </div>
                    <ul class="list-unstyled m-lg-75">
                      <div class="row mt-75 ">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _TITLE ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataTitleID; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _AUTHOR ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataAuthor; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _PUBLISHER ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataPublisher; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _CATEGORY ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataCategory; ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _CATEGORY ?> 2:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataCategory3 ?></span>
                        </div>
                      </div>
                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _CATEGORY ?> 3:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataCategory4 ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _AVAILABLE ?> :</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $jumlahbuku . " Eksemplar " ?></span>
                        </div>
                      </div>

                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _RACK ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $racking_number; ?></span>
                        </div>
                      </div>


                      <div class="row mt-75">
                        <div class='col-6'>
                          <span class="fw-bolder"><?php echo _YEAR ?>:</span>
                        </div>
                        <div class='col-6'>
                          <span><?= $dataYear; ?></span>
                        </div>
                      </div>




                    </ul>
                    <br>

                    <div class="card mt-100">
                      <div class="card-header"></div>
                      <div class="card-body">
                        <h4 class="card-title"><?php echo _ALREADYREAD ?></h4>
                        <p class="card-text">
                          <?php echo _SHARE ?>
                        </p>
                        <a href="#" class="btn btn-outline-primary" style='width:100%' data-bs-toggle="modal" data-bs-target="#inlineForm">Review</a>
                      </div>
                    </div>

                  </div>
                </div>


                <div class="col-12 col-md-7">
                  <div class="mb-1 breadcrumb-right">
                    <?php
                    $mySqlf  = "SELECT id FROM document_favourite WHERE document_id='$getID' and user_id='$User'";
                    $myQryf  = mysqli_query($koneksidb, $mySqlf)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
                    $myDataf = mysqli_fetch_array($myQryf);
                    $mydataid = isset($myDataf['id']) ? $myDataf['id'] : '';
                    $bookmark_add =  _BOOKMARKADD;
                    $bookmark_delete =  _BOOKMARKDELETE;

                    if ($mydataid == "") {
                      echo "<a class='btn-icon btn btn-warning btn-round btn' href='?page=Document-Favourite-Add&id=$getID' aria-haspopup='true' aria-expanded='false'><i data-feather='star'></i> $bookmark_add  </a>";
                    } else {
                      echo "<a class='btn-icon btn btn-danger btn-round btn' href='?page=Document-Favourite-Delete&id=$getID' aria-haspopup='true' aria-expanded='false'><i data-feather='star'></i> $bookmark_delete</a>";
                    }
                    ?>

                  </div>

                  <h2 style='color:brown'><?php echo _DESCRIPTION ?></h2>
                  <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                    <h4 class="item-price me-1"><?= $dataKeyword; ?></h4>

                  </div>
                  <p class="card-text">
                    <?= $dataDescID; ?>
                  </p>
                  <hr />

                  <h4>Review</h4>
                  <?php

                  $batas = 5;
                  $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                  $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                  $previous = $halaman - 1;
                  $next = $halaman + 1;

                  $mySql1 = "SELECT  * FROM document_review where document_id = '$getID' order by updated_date desc limit $halaman_awal, $batas";
                  $myQry1 = mysqli_query($koneksidb, $mySql1) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                  $nomor = $halaman_awal + 1;
                  $jumlah_review = mysqli_num_rows($myQry1);

                  $mySql = "SELECT  * FROM document_review where document_id = '$getID'  order by updated_date desc ";
                  $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                  $jumlah_data = mysqli_num_rows($myQry);
                  $total_halaman = ceil($jumlah_data / $batas);
                  while ($myData1 = mysqli_fetch_array($myQry1)) {
                    $user_id =  $myData1['user_id'];

                    $mySql2 = "SELECT  * FROM master_user where user_id = '$user_id'";
                    $myQry2 = mysqli_query($koneksidb, $mySql2) or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
                    $myData2 = mysqli_fetch_array($myQry2);


                  ?>

                    <div class="">
                      <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                          <!-- avatar -->
                          <div class="avatar me-1">
                            <img src="../uploads/user/<?php echo $myData2['user_photo'] ?>" alt="avatar img" height="50" width="50" />
                          </div>
                          <!--/ avatar -->
                          <div class="profile-user-info">
                            <h6 class="mb-0"><?php echo $myData2['user_fullname'] ?></h6>
                            <?php if ($myData1['rating'] == 5) {
                              echo "<small>⭐️⭐️⭐️⭐️⭐️</small>";
                            } else if ($myData1['rating'] == 4) {
                              echo "<small>⭐️⭐️⭐️⭐️</small>";
                            } else if ($myData1['rating'] == 3) {
                              echo "<small>⭐️⭐️⭐️</small>";
                            } else if ($myData1['rating'] == 2) {
                              echo "<small>⭐️⭐️</small>";
                            } else if ($myData1['rating'] == 1) {
                              echo "<small>⭐️</small>";
                            } ?>
                            <div>
                            </div>
                          </div>
                        </div>
                        <p class="card-text">
                          <?php echo $myData1['description'] ?>
                        </p>
                        <small class="text-muted"><?php echo $myData1['review_date'] ?></small>


                        <!--/ comments -->

                      </div>

                    </div>
                  <?php }
                  ?>

                  <ul class="pagination justify-content-center mt-2">

                    <li class="page-item">
                      <a class="page-link" <?php if ($halaman > 1) {
                                              echo "href='?page=Buku-Digital-Detail-View&id=$getID&halaman=$previous'";
                                            } ?>>
                        < </a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                      if ($halaman == $x) { ?>
                        <li class="page-item active"><a class="page-link" href="?page=Buku-Digital-Detail-View&id=<?php echo $getID ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                      <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="?page=Buku-Digital-Detail-View&id=<?php echo $getID ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php  }
                    }
                    ?>
                    <li class="page-item">
                      <a class="page-link" <?php if ($halaman < $total_halaman) {
                                              echo "href='?page=Buku-Digital-Detail-View&id=$getID&halaman=$next'";
                                            } ?>> > </a>
                    </li>
                  </ul>

                </div>

              </div>
              <!-- Product Details ends -->


            </div>
            <!-- Product Details ends -->


          </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header justify-content-start align-items-center">
            <h4 class="modal-title" id="myModalLabel33">Review</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
            <div class="modal-body ">
              <!-- Basic -->

              <div class="row mt-75">
                <div class='col-4'>

                </div>
                <div class='col-11'>
                  <div class="mb-12">
                    <div class="rating" style=''>
                      <input id="star5" name="txtRating" type="radio" value="5" class="radio-btn hide" />
                      <label for="star5" style='font-size:30px;'>☆</label>
                      <input id="star4" name="txtRating" type="radio" value="4" class="radio-btn hide" />
                      <label for="star4" style='font-size:30px;'>☆</label>
                      <input id="star3" name="txtRating" type="radio" value="3" class="radio-btn hide" />
                      <label for="star3" style='font-size:30px;'>☆</label>
                      <input id="star2" name="txtRating" type="radio" value="2" class="radio-btn hide" />
                      <label for="star2" style='font-size:30px;'>☆</label>
                      <input id="star1" name="txtRating" type="radio" value="1" class="radio-btn hide" />
                      <label for="star1" style='font-size:30px;'>☆</label>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-75">
                <div class='col-12'>
                  <div class="mb-10">
                    <textarea placeholder="<?php echo _THOUGHT ?>" name='txtReview' class="form-control" required></textarea>
                  </div>
                </div>
              </div>
              <!--/ Basic -->

            </div>
            <div class="modal-footer">
              <div class="row mt-75">
                <div class='col-4'>

                </div>
                <div class='col-6'>
                  <div class="mb-10">
                    <button type="submit" name='btnSubmit' class="btn btn-primary"><?php echo _SEND ?></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
    <script src="../app-assets/js/scripts/forms/form-number-input.js"></script>
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
    <script>
      $(document).ready(function() {
        // Check Radio-box
        $(".rating input:radio").attr("checked", false);

        $('.rating input').click(function() {
          $(".rating span").removeClass('checked');
          $(this).parent().addClass('checked');
        });

        $('input:radio').change(
          function() {
            var userRating = this.value;
            alert(userRating);
          });
      });
    </script>

</body>


<!-- END: Body-->
<?php include "footer_user.php"; ?>

</html>