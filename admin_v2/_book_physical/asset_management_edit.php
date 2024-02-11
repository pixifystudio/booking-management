<?php
$_SESSION['SES_TITLE'] = "Management ";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Management-";

$info = "";
$Code = @$_GET['id'];
$info = @$_GET['info'];
if ($info != "")
  $pesanError[] = $info;

$getID  = isset($_GET['id']) ?  $_GET['id'] : '';
$getVersion  = isset($_GET['v']) ?  $_GET['v'] : '1';
?>
<div class="app-content content ">
  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Asset-Management-Digital'>";
  }
  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {

    function autofalse()
    {
      global $koneksidb;
      mysqli_autocommit($koneksidb, FALSE);
    }
    function commit()
    {
      global $koneksidb;
      mysqli_commit($koneksidb);
    }
    function rollback()
    {
      global $koneksidb;
      mysqli_rollback($koneksidb);
    }

    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    if (trim($_POST['txtCategory']) == "") {
      $pesanError[] = "<b>Category</b> data can not be empty !";
    }


    # BACA DATA DALAM FORM, masukkan datake variabel
    $dataCode  = $_POST['txtCode'];

    $dataVersion  = $_POST['txtVersion'];
    $dataYear  = $_POST['txtYear'];
    $dataAuthor  = $_POST['txtAuthor'];
    $dataPublisher  = $_POST['txtPublisher'];
    $dataCategory  = $_POST['txtCategory'];
    $dataDate    = $_POST['txtDate'];
    $dataKeyword  = $_POST['txtKeyword'];
    $dataTitleID  = $_POST['txtTitleID'];
    $dataRacking  = $_POST['txtRacking'];
    $dataTitleEN  = $_POST['txtTitleEN'];
    $dataDescID    = $_POST['txtDescriptionID'];
    $dataDescEN    = $_POST['txtDescriptionEN'];
    $dataStatus    = 'Updated'; //$_POST['txtStatus'];
    $dataStatusOld  = $_POST['txtStatus'];
    $dataCoverOld  = $_POST['txtFileCoverOld'];
    $dataChange    = $_POST['txtChange'];
    if ($_POST['txtExpired'] == "") {
      $dataExpireDate = date('Y-m-d', strtotime('+1 year', strtotime($dataDate)));
    } else {
      $dataExpireDate = $_POST['txtExpired'];
    }

    $file_cover = "photo.png";
    $wmax = 300;
    $hmax = 300;

    if ($_FILES['txtFileCover']['name'] != "") {

      $file_size2   = $_FILES['txtFileCover']['size'];
      $file_tmp2   = $_FILES['txtFileCover']['tmp_name'];
      $file_type2  = $_FILES['txtFileCover']['type'];
      $tmp2 = explode('.', $_FILES['txtFileCover']['name']);
      $file_ext2 = end($tmp2);



      // Valid extension
      $valid_ext = array('png', 'jpeg', 'jpg');
      $file_name   = $dataCode . '.' . $file_ext2;
      // Location
      $location = "../uploads/cover/" . $file_name;
      move_uploaded_file($_FILES["txtFileCover"]["tmp_name"], $location);
      // file extension
      $file_extension = pathinfo($location, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      // Check extension
      if (in_array($file_extension, $valid_ext)) {

        $file_cover = $file_name;
      } else {
        $pesanError[] = "Invalid file type.";
      }
    } else {
      $file_cover = $dataCoverOld;
    }



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
      try {
        autofalse();
        # SIMPAN DATA KE DATABASE. 
        // Jika tidak menemukan error, simpan data ke database

        // echo $file_cover;
        // exit;


        $ses_nama  = $_SESSION['SES_NAMA'];

        if ($dataStatusOld  == "Created" || $dataStatusOld  == "Updated" || $dataStatusOld  == "Revised") {

          $mySql    = "UPDATE document  SET category_id='$dataCategory',racking_id='$dataRacking',document_version='$dataVersion',document_title_id='$dataTitleID',
						document_description_id='$dataDescID',document_title_en='$dataTitleEN', document_description_en='$dataDescEN', document_year='$dataYear',
						document_keyword='$dataKeyword', document_status='$dataStatus', document_date='$dataDate', document_cover='$file_cover',
						document_expire_date='$dataExpireDate', document_change_history='$dataChange', updated_by='$ses_nama', document_publisher='$dataPublisher',
						document_author='$dataAuthor',updated_date=now()
						WHERE document_id='$getID' and document_version='$getVersion'";
          $myQry = mysqli_query($koneksidb, $mySql);
          if (!$myQry)
            throw new Exception("Form gagal diinput. code:d1. " . mysqli_error($koneksidb));
        } else {

          $mySql    = "INSERT INTO document_archive (select * from document where document_id='$getID' and document_version='$getVersion')";
          $myQry = mysqli_query($koneksidb, $mySql);
          if (!$myQry)
            throw new Exception("Form gagal diinput. code:d2. " . mysqli_error($koneksidb));

          $mySql    = "INSERT INTO document (racking_id, document_year, document_publisher, document_author, document_cover, 
          document_id, category_id, document_version, document_title_id, document_description_id, document_title_en, 
          document_description_en, document_keyword, document_status, document_date, document_expire_date, 
          document_change_history, updated_by, updated_date)
						VALUES ('$dataRacking','$dataYear','$dataPublisher','$dataAuthor','$file_cover',
            '$dataCode','$dataCategory','$dataVersion','$dataTitleID','$dataDescID','$dataTitleEN',
            '$dataDescEN','$dataKeyword', '$dataStatus','$dataDate','$dataExpireDate','$dataChange','$ses_nama',now())";
          $myQry = mysqli_query($koneksidb, $mySql);
          if (!$myQry)
            throw new Exception("Form gagal diinput. code:d3. " . mysqli_error($koneksidb));
        }


        $mySql    = "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','Updated','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql);
        if (!$myQry)
          throw new Exception("Form gagal diinput. code:d6. " . mysqli_error($koneksidb));
        commit();
        // echo 'ok';
        echo "<meta http-equiv='refresh' content='0; url=?page=Asset-Management-Physical&msg=edit'>";
        exit;
      } catch (Exception $e) {
        rollback();
        // echo "<meta http-equiv='refresh' content='0; url=?page=Asset-Management-Digital-Edit&id=$Code&info=" . $e->getMessage() . "'>";
        echo $e->getMessage();
      }
    }
  }


  $mySql   = "SELECT * FROM document where document_id='$getID' and document_version='$getVersion'";
  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
  $myData = mysqli_fetch_array($myQry);
  $Code = $myData['document_id'];

  $tgl = date('Y-m-d');
  $dataCode    = $myData['document_id'];
  $dataStatus    = $myData['document_status'];
  $dataDate    = $myData['document_date'];
  $dataCover   = $myData['document_cover'];
  if ($dataStatus  == "Created" || $dataStatus  == "Updated" || $dataStatus  == "Revised") {
    $dataVersion    = $myData['document_version'];
  } else {
    $dataVersion    = $myData['document_version'] + 1;
  }
  $dataRacking       = isset($_POST['txtRacking']) ? $_POST['txtRacking'] : $myData['racking_id'];
  $dataYear       = isset($_POST['txtYear']) ? $_POST['txtYear'] : $myData['document_year'];
  $dataAuthor     = isset($_POST['txtAuthor']) ? $_POST['txtAuthor'] : $myData['document_author'];
  $dataPublisher  = isset($_POST['txtPublisher']) ? $_POST['txtPublisher'] : $myData['document_publisher'];
  $dataCategory   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : $myData['category_id'];
  $dataExpireDate       = isset($_POST['txtExpired']) ? $_POST['txtExpired'] : $myData['document_expire_date'];
  $dataKeyword    = isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $myData['document_keyword'];
  $dataTitleID    = isset($_POST['txtTitleID']) ? $_POST['txtTitleID'] : $myData['document_title_id'];
  $dataTitleEN    = isset($_POST['txtTitleEN']) ? $_POST['txtTitleEN'] : $myData['document_title_en'];
  $dataDescID     = isset($_POST['txtDescriptionID']) ? $_POST['txtDescriptionID'] : $myData['document_description_id'];
  $dataDescEN     = isset($_POST['txtDescriptionEN']) ? $_POST['txtDescriptionEN'] : $myData['document_description_en'];
  $dataNote     = isset($_POST['txtNote']) ? $_POST['txtNote'] : $myData['document_note'];
  $dataChange     = isset($_POST['txtChange']) ? $_POST['txtChange'] : $myData['document_change_history'];
  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Edit Book</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">User Management</a>
                </li>
                <li class="breadcrumb-item"><a href="?page=Asset-Management-Digital">Digital Book</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Edit Book</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header border-bottom">
              <div class="content-header-right text-md-end col-md-12 col-12 d-md-block d-none">
                <div class="row">
                  <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="Admin ID">Book ID</label>
                            <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
                            <input class="form-control" name="txtStatus" type="hidden" value="<?php echo $dataStatus; ?>" readonly="readonly" />
                            <input class="form-control" name="txtDate" type="hidden" value="<?php echo $dataDate; ?>" readonly="readonly" />
                            <input class="form-control" name="txtFileCoverOld" type="hidden" value="<?php echo $dataCover; ?>" readonly="readonly" />
                          </div>
                        </div>
                        <div class="col-md-1 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="phone">Ver</label>
                            <input type="number" id="number" value="<?php echo $dataVersion; ?>" readonly class="form-control" name="txtVersion" placeholder="Ver" />
                          </div>
                        </div>
                        <div class="col-md-1 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Year</label>
                            <input class="form-control" name="txtYear" autocomplete="off" placeholder="Year Book" type="number" value="<?php echo $dataYear; ?>" min="0" max="<?php echo date('Y') + 1; ?>" required />
                          </div>
                        </div>
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="">Categories</label>
                            <select name="txtCategory" class="select2 form-control" required>
                              <?php
                              $mySql = "SELECT * FROM master_category WHERE category_level_1='PHYSICAL' ";
                              $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                              echo '<option value="">Select Category</option>';
                              while ($dataRow = mysqli_fetch_array($dataQry)) {
                                if ($dataRow['category_level_2'] != '') {
                                  $dataCategory2 =  $dataRow['category_level_2'];
                                } else {
                                  $dataCategory2 = '';
                                };
                                if ($dataRow['category_level_3'] != '') {
                                  $dataCategory3 = '| ' . $dataRow['category_level_3'];
                                } else {
                                  $dataCategory3 = '';
                                };
                                if ($dataRow['category_level_4'] != '') {
                                  $dataCategory4 = '| ' . $dataRow['category_level_4'];
                                } else {
                                  $dataCategory4 = '';
                                };
                                if ($dataRow['category_level_5'] != '') {
                                  $dataCategory5 = '| ' . $dataRow['category_level_5'];
                                } else {
                                  $dataCategory5 = '';
                                };
                                if ($dataRow['category_level_6'] != '') {
                                  $dataCategory6 = '| ' . $dataRow['category_level_6'];
                                } else {
                                  $dataCategory6 = '';
                                };
                                if ($dataRow['category_id'] == $dataCategory) {
                                  $cek = " selected";
                                } else {
                                  $cek = "";
                                }
                                echo "<option value='$dataRow[category_id]' $cek> $dataCategory2 $dataCategory3 $dataCategory4 $dataCategory5 $dataCategory6</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2 col-12">
                          <label class="form-label" for="basicSelect">Author</label>
                          <input type="text" id="author" class="form-control" autocomplete="off" value="<?php echo $dataAuthor; ?>" name="txtAuthor" placeholder="Author" />
                        </div>
                        <div class="col-md-2 col-12">
                          <label class="form-label" for="basicSelect">Publisher</label>
                          <input type="text" id="publisher" class="form-control" autocomplete="off" value="<?php echo $dataPublisher; ?>" name="txtPublisher" placeholder="Publisher" />
                        </div>
                        <div class="col-md-2 col-12">
                          <!-- <label class="form-label" for="basicSelect">Expired Date</label> -->
                          <input hidden id="tanggal" autocomplete="off" class="dapick form-control" placeholder="YYYY-MM-DD" name="txtExpired" type="text" value="<?php echo $dataExpireDate; ?>" maxlength="20" required="required" autocomplete="off" />
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="code">Title (Bahasa)</label>
                            <input class="form-control" placeholder="Title (Bahasa)" autocomplete="off" name="txtTitleID" type="text" value="<?php echo $dataTitleID; ?>" maxlength="255" required="required" />
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="username">Title (English)</label>
                            <input class="form-control" placeholder="Title (English)" autocomplete="off" name="txtTitleEN" type="text" value="<?php echo $dataTitleID; ?>" maxlength="255" required="required" />
                          </div>
                        </div>

                        <!-- <div class="col-md-4 col-12">
                          <label class="form-label" for="basicSelect">Expire Date</label>
                          <input type="date" id="publisher" class="form-control" name="Title" placeholder="Date" />
                        </div> -->
                        <div class="col-md-4 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Keyword</label>
                            <input type="text" id="status" class="form-control" name="txtKeyword" value="<?php echo $dataKeyword; ?>" autocomplete="off" placeholder="Keyword" />
                          </div>
                        </div>
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="">Racking Number</label>
                            <select name="txtRacking" class="select2 form-control" required>
                              <?php
                              $mySql = "SELECT * FROM master_racking  ";
                              $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                              echo '<option value="">Select racking</option>';
                              while ($dataRow = mysqli_fetch_array($dataQry)) {

                                if ($dataRow['racking_id'] == $dataRacking) {
                                  $cek = " selected";
                                } else {
                                  $cek = "";
                                }
                                echo "<option value='$dataRow[racking_id]' $cek> $dataRow[racking_number] </option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="status">Cover</label>
                            <input type="file" id="status" class="form-control" name="txtFileCover" placeholder="Cover" />
                          </div>
                        </div>
                        <div class="col-md-5 col-12">
                          <label class="form-label" for="basicSelect">Description (Bahasa)</label>
                          <textarea name="txtDescriptionID" class="form-select" id="" cols="30" rows="5"><?php echo $dataDescID; ?></textarea>
                        </div>
                        <div class="col-md-5 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="admin">Description (English)</label>
                            <textarea name="txtDescriptionEN" class="form-select" id="" cols="30" rows="5"><?php echo $dataDescEN; ?></textarea>
                          </div>
                        </div>
                        <?php if ($dataStatus != 'Approved' && $dataStatus != 'Created') {
                        ?>
                          <div class="col-md-12 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="admin">Approval Note</label>
                              <textarea name="txtNote" class="form-select" readonly id="" cols="30" rows="2"><?php echo $dataNote; ?></textarea>
                            </div>
                          </div>
                        <?php } else {
                          echo '<textarea hidden name="txtNote" class="form-select" id="" cols="30" rows="2"></textarea>';
                        } ?>
                        <div class="col-md-12 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="admin">Change Note</label>
                            <textarea name="txtChange" class="form-select" id="" cols="30" rows="2">Update : </textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-7 my-5">
                        <button type="reset" href="?page=Management-Category" class="btn btn-outline-dark me-2">Discard</button>
                        <button type="submit" name="btnSubmit" class="btn btn-primary me-3">Save</button>
                      </div>
                  </div>
                </div>
                </form>
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
<script src="js_new/footer_default.js"></script>