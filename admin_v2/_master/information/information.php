<?php
$_SESSION['SES_TITLE'] = "Information";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Information";

$msg = @$_GET['msg'];

?>
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Information, News & Article</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a>Home</a>
                </li>
                <li class="breadcrumb-item active"><a>Master Data</a>
                </li>
                <li class="breadcrumb-item active">Information, News & Article
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="col-md-12 col-12 ps-25">
          <div class="mb-1">
            <a href='?page=Information-Add' type="submit" class="btn btn-warning w-100" name=""><i data-feather='plus'></i> Upload</a>
          </div>
        </div>
      </div>
    </div>

    <?php if ($msg != "") { ?>
      <div class="alert alert-primary" role="alert">
        <h4 class="alert-heading">Sukses!</h4>
        <div class="alert-body">
          <?php if ($msg == "add") echo "<p>Tambah data berhasil</p>";
          elseif ($msg == "edit") echo "<p>Edit data berhasil</p>";
          elseif ($msg == "Delete") echo "<p>Delete data berhasil</p>"; ?>
        </div>
      </div>
    <?php }

    $dateMin1 = new DateTime(date('Y-m-d'));
    $dateMin1F = $dateMin1->format('Y-m-01');
    $dataMonth = isset($_GET['month']) ? $_GET['month'] : $dateMin1F;

    $datePlus1 = new DateTime(date('Y-m-d'));
    $datePlus1F = $datePlus1->format('Y-m-d');
    $dataYear = isset($_GET['year']) ? $_GET['year'] : $datePlus1F;
    ?>

    <div class="content-body">
      <!-- <h2 class="mt-3 mb-2" style="color:brown">Continue</h2> -->

      <!-- <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="card h-100">
            <img class="card-img-top" src="../uploads/cover_information/pers1.jpeg" alt="Card image cap" />
            <div class="card-body">
              <h4 class="card-title h-50">Keluarga Bantah WNI Ngamuk di Turkish Airlines Mabuk</h4>
              <p class="card-text">
                . - Draft
              </p>
            </div>
          </div>
        </div> -->

      <!-- <div class="col-md-6 col-lg-4">
          <div class="card h-100">
            <img class="card-img-top" src="../uploads/cover_information/pers2.jpg" alt="Card image cap" />
            <div class="card-body">
              <h4 class="card-title h-50">Terkendala Hujan, Pencarian Siswa SMP Hanyut di Curug Kembar Dilanjut Besok</h4>
              <p class="card-text">
                News - Draft
              </p>
            </div>
          </div>
        </div> -->
    </div>

    <h2 class="mt-3 mb-2" style="color:brown">List Uploads</h2>

    <div class="row row-cols-1 row-cols-md-3 mb-2">

      <?php
      $mySql  = "select * from information order by updated_date desc";
      $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
      while ($myData = mysqli_fetch_array($myQry)) {
        $myData['file'];
      ?>

        <div class="col mb-2">
          <div class="card h-100">
            <img class="card-img-top" src="../uploads/cover_information/<?php echo $myData['file'] ?>" alt="Card image cap" />
            <div class="card-body">
              <h4 class="card-title h-50"> <a href="?page=Information-Read-Admin&id=<?php echo $myData['id'] ?>"><?php echo $myData['title_en'] ?></a></h4>
              <p class="card-text">
                <?php echo $myData['type'] ?> - <?php echo $myData['updated_date'] ?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted"> <?php echo $myData['updated_date'] ?></small>
            </div>
          </div>
        </div>
      <?php }
      ?>
    </div>

  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_difan.php";
?>