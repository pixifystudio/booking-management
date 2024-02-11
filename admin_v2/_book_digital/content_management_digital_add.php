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
?>
<div class="app-content content ">
  <?php
  # Tombol cancel
  if (isset($_POST['btnCancel'])) {
    echo "<meta http-equiv='refresh' content='0; url=?page=Content-Management-Digital'>";
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
    $mySql  = "SELECT * FROM master_code WHERE code_table='document'";
    $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
    $myData = mysqli_fetch_array($myQry);
    $dataCode  = buatCode($myData['code_table'], $myData['code_name']);

    $dataVersion  = $_POST['txtVersion'];
    $dataYear  = $_POST['txtYear'];
    $dataAuthor  = $_POST['txtAuthor'];
    $dataPublisher  = $_POST['txtPublisher'];
    $dataCategory  = $_POST['txtCategory'];
    $dataDate    = date('Y-m-d');
    $dataKeyword  = $_POST['txtKeyword'];
    $dataTitleID  = $_POST['txtTitleID'];
    $dataTitleEN  = $_POST['txtTitleEN'];
    $dataDescID    = $_POST['txtDescriptionID'];
    $dataDescEN    = $_POST['txtDescriptionEN'];
    $dataStatus    = "Created";
    if ($_POST['txtDate'] == "") {
      $dataExpireDate = date('Y-m-d', strtotime('+1 year', strtotime($dataDate)));
    } else {
      $dataExpireDate = $_POST['txtDate'];
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
        $ses_nama  = $_SESSION['SES_NAMA'];
        $mySql    = "INSERT INTO document (document_year, document_publisher, document_author, document_cover, document_id, category_id, document_version, document_title_id, document_description_id, document_title_en, document_description_en, document_keyword, document_status, document_date, document_expire_date, updated_by, updated_date)
						VALUES ('$dataYear','$dataPublisher','$dataAuthor','$file_cover','$dataCode','$dataCategory','$dataVersion','$dataTitleID','$dataDescID','$dataTitleEN','$dataDescEN','$dataKeyword', '$dataStatus','$dataDate','$dataExpireDate','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql);
        if (!$myQry)
          throw new Exception("Form gagal diinput. code:d1. " . mysqli_error($koneksidb));

        // generate file pdf/video
        if ($_FILES['txtFileBook']['name'] != "") {
          $dataNameMedia = $_FILES['txtFileBook']['name'];
          $cekFile = $_FILES['txtFileBook']['type'];

          // require_once "../vendors/autoload.php";
          error_reporting(E_ERROR | E_PARSE);

          $txtCode = $dataCode;
          $txtVersion = $dataVersion;
          $txtName = $_SESSION['SES_NAMA'];

          function filesize_formatted($path)
          {
            $size = filesize($path);
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $size > 0 ? floor(log($size, 1024)) : 0;
            return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
          }

          // cek for type file pdf or mp4?
          if (strpos($cekFile, 'video/') !== false) {
            $fileTitle = str_replace("&", "And", $dataNameMedia);
            $fileName = str_replace('&', 'And', $dataNameMedia);
          } else {
            $fileTitle = str_replace("&", "And", $dataNameMedia);
            $fileName = str_replace('&', 'And', $dataNameMedia);
          }

          $targetDir = "../document_index/";
          $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

          $targetFile = $targetDir . $fileName;

          if (move_uploaded_file($_FILES['txtFileBook']['tmp_name'], $targetFile)) {
            //insert file information into db table
            $fileSize = filesize_formatted($targetFile);

            $fileTitle = mysqli_real_escape_string($koneksidb, $fileTitle);
            $targetFile1 = mysqli_real_escape_string($koneksidb, $targetFile);

            // insert data to document_files
            $mySql    = "INSERT INTO document_files (document_id, document_version, document_file_name, document_file_title, document_file_ext, document_size, updated_by, updated_date) 
        VALUES('$txtCode','$txtVersion','$targetFile1','$fileTitle','$fileExt','$fileSize','$txtName',NOW())";
            $myQry = mysqli_query($koneksidb, $mySql);
            if (!$myQry)
              throw new Exception("Form gagal diinput. code:f1. " . mysqli_error($koneksidb));

            // If the file is a PDF, extract text and insert into another table
            // if ($fileExt === 'pdf') {
            //   $parser = new \Smalot\PdfParser\Parser();
            //   $pdf = $parser->parseFile($targetFile);
            //   $pages = $pdf->getPages();
            //   $text = "";
            //   $i = 1;

            //   foreach ($pages as $page) {
            //     $text = $page->getText();
            //     $text = mysqli_real_escape_string($koneksidb, $text);

            //     $mySql = "INSERT INTO document_index (document_id, document_version, document_file_title, document_page, document_content, updated_by, updated_date) 
            //             VALUES('$txtCode','$txtVersion','$fileName','$i','$text','$txtName',NOW())";
            //     $myQry = mysqli_query($koneksidb, $mySql);

            //     if (!$myQry) {
            //       throw new Exception("Form gagal diinput. code:f2. " . mysqli_error($koneksidb));
            //     }
            //     $i++;
            //   }
            // }
          }
        }

        $mySql    = "INSERT INTO document_status (document_id, document_version, document_status, updated_by, updated_date)
						VALUES ('$dataCode','$dataVersion','$dataStatus','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql);
        if (!$myQry)
          throw new Exception("Form gagal diinput. code:d2. " . mysqli_error($koneksidb));

        commit();
        echo "<meta http-equiv='refresh' content='0; url=?page=Content-Management-Digital&msg=add'>";
      } catch (Exception $e) {
        rollback();
        // echo "<meta http-equiv='refresh' content='0; url=?page=Content-Management-Digital-Add-Add&&info=" . $e->getMessage() . "'>";
        echo $e->getMessage();
      }
      exit;
    }
  }
  $tgl = date('Y-m-d');
  $dataCode    = buatCode('document', 'DOC-');
  $dataVersion    = isset($_POST['txtVersion']) ? $_POST['txtVersion'] : '1';
  $dataYear       = isset($_POST['txtYear']) ? $_POST['txtYear'] : '';
  $dataAuthor     = isset($_POST['txtAuthor']) ? $_POST['txtAuthor'] : '';
  $dataPublisher  = isset($_POST['txtPublisher']) ? $_POST['txtPublisher'] : '';
  $dataCategory   = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : '';
  $dataDate       = isset($_POST['txtDate']) ? $_POST['txtDate'] : date('Y-m-d', strtotime('+1 year', strtotime($tgl)));
  $dataKeyword    = isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : '';
  $dataTitleID    = isset($_POST['txtTitleID']) ? $_POST['txtTitleID'] : '';
  $dataTitleEN    = isset($_POST['txtTitleEN']) ? $_POST['txtTitleEN'] : '';
  $dataDescID     = isset($_POST['txtDescriptionID']) ? $_POST['txtDescriptionID'] : '';
  $dataDescEN     = isset($_POST['txtDescriptionEN']) ? $_POST['txtDescriptionEN'] : '';
  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Content Digital Management</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="?page=Content-Management-Digital">Content Digital</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Add Content</a>
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
              <div class="content-header-right col-md-12 col-12 d-md-block d-none">
                <div class="row">
                  <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="Admin ID">ID</label>
                            <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="10" readonly="readonly" />
                          </div>
                        </div>
                        <div class="col-md-1 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="phone">Ver</label>
                            <input type="number" id="number" value="1" readonly class="form-control" name="txtVersion" placeholder="Ver" />
                          </div>
                        </div>
                        <div class="col-md-1 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Year</label>
                            <input class="form-control" name="txtYear" autocomplete="off" placeholder="Year" type="number" value="<?php echo $dataYear; ?>" min="0" max="<?php echo date('Y') + 1; ?>" required />
                          </div>
                        </div>
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="">Categories</label>
                            <select name="txtCategory" class="select2 form-control" required>
                              <?php
                              $mySql = "SELECT * FROM master_category where category_level_1='DIGITAL' ";
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
                                if ($dataRow['category_id'] == $dataUser) {
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
                          <label class="form-label" for="basicSelect">Owner</label>
                          <input type="text" id="author" class="form-control" autocomplete="off" name="txtAuthor" placeholder="Owner" />
                        </div>
                        <div class="col-md-2 col-12">
                          <label class="form-label" for="basicSelect">Merk</label>
                          <input type="text" id="publisher" class="form-control" autocomplete="off" name="txtPublisher" placeholder="Merk" />
                        </div>
                        <div class="col-md-2 col-12">
                          <label class="form-label" for="basicSelect">Expired Date</label>
                          <input id="tanggal" autocomplete="off" class="dapick form-control" placeholder="YYYY-MM-DD" name="txtDate" type="text" value="<?php echo $dataDate; ?>" maxlength="20" required="required" autocomplete="off" />
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
                            <input type="text" id="status" class="form-control" name="txtKeyword" autocomplete="off" placeholder="Keyword" />
                          </div>
                        </div>
                        <div class="col-md-2 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="status">Thumbnail</label>
                            <input type="file" id="status" class="form-control" required name="txtFileCover" placeholder="Cover" />
                          </div>
                          <div class="mb-1">
                            <label class="form-label" for="status">Files</label>
                            <input type="file" id="status" class="form-control" required name="txtFileBook" placeholder="File" />
                          </div>
                        </div>
                        <div class="col-md-5 col-12">
                          <label class="form-label" for="basicSelect">Description (Bahasa)</label>
                          <textarea name="txtDescriptionID" class="form-select" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-md-5 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="admin">Description (English)</label>
                            <textarea name="txtDescriptionEN" class="form-select" id="" cols="30" rows="10"></textarea>
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