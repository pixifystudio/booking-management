<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";

?>
<div class="app-content content ">

  <?php
  $dataReff = isset($_GET['id']) ? $_GET['id'] : '';


  if (isset($_POST['btnSelect'])) {
    $dataReff = $_POST['txtCode'];
    echo "<meta http-equiv='refresh' content='0; url=?page=Content-Management-Grant-Access&id=" . $dataReff . "'>";
    exit;
  }


  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();

    # BACA DATA DALAM FORM, masukkan datake variabel
    $dataReff           = $_POST['txtCode'];
    $dataReffArray           = explode('|', $dataReff);
    $dataCode = $dataReffArray[0];
    $dataFiles = $dataReffArray[1];
    $dataVersion           = 1;
    if ($_POST['txtDivision'] == "") {
      $dataDivision = '{null}';
    } else {
      $dataDivision = $_POST['txtDivision'];
    }
    if ($_POST['txtDepartment'] == "") {
      $dataDepartment = '{null}';
    } else {
      $dataDepartment = $_POST['txtDepartment'];
    }
    if ($_POST['txtUnit'] == "") {
      $dataUnit = '{null}';
    } else {
      $dataUnit = $_POST['txtUnit'];
    }
    if ($_POST['txtEmployee'] == "") {
      $dataEmployee = '{null}';
    } else {
      $dataEmployee = $_POST['txtEmployee'];
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
      # SIMPAN DATA KE DATABASE. 
      // Jika tidak menemukan error, simpan data ke database
      $_SESSION['SES_KODE'] = $dataCode;
      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "INSERT INTO document_privileges (document_id, document_version, division, department, unit, user_id, updated_by, updated_date)
        VALUES ('$dataCode','$dataVersion','$dataDivision','$dataDepartment','$dataUnit','$dataEmployee', '$ses_nama',now())";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Content-Management-Grant-Access&id=" . $dataReff . "'>";
      }
      exit;
    }
  }
  // Penutup Tombol Submit Files



  ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0">Privileges</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a>Add Access</a>
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
                <div class="content-header-right  col-md-12 col-12 d-md-block d-none">
                  <div class="row">
                    <div class="card-body">
                      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
                        <div class="row">
                          <?php if ($dataReff == '') {
                          ?> <div class="col-md-6 col-12">
                              <div class="mb-1">
                                <label>Content ID</label><br />
                                <select name="txtCode" class="select2 form-control" required>
                                  <?php
                                  $mySql = "SELECT * FROM view_document where category_level_1='DIGITAL' ";
                                  $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                  echo '<option value=""> SelectSelect Category</option>';
                                  while ($dataRow = mysqli_fetch_array($dataQry)) {
                                    // if ($dataRow['document_id'] == $dataUser) {
                                    //   $cek = " selected";
                                    // } else {
                                    $cek = "";
                                    // }
                                    echo "<option value='$dataRow[document_id]|$dataRow[document_title_id]' $cek> [$dataRow[document_id]] $dataRow[document_title_id]</option>";
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary btn-sm" name="btnSelect" style="width:100%"><i class="fa fa-plus-square fa-fw"></i> Select</button>
                              </div>
                            </div>
                          <?php } else {
                            $dataCode = explode('|', $dataReff);
                          ?>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label>Content ID</label><br />
                                <input type="text" readonly class="form-control" value="<?php echo '[' . $dataCode[0] . '] ' . $dataCode[1]; ?>">
                                <input type="hidden" name="txtCode" class="form-control" value="<?= $dataReff ?>">
                              </div>
                            </div>

                            <div class="col-xs-12">
                              <br>
                              <h4><b>Privileges</b></h4>
                              <div class="row">
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Division *</label>
                                    <select name="txtDivision" class="select2  form-control" tabindex="-1">
                                      <?php
                                      echo '<option value=""> Select</option>';
                                      $mySql = "SELECT division FROM master_organization where division !=''  group by division order by division ";
                                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                                        // if ($dataRow['division'] == $datadivision) {
                                        //   $cek = " selected";
                                        // } else {
                                        $cek = "";
                                        // }
                                        echo "<option value='$dataRow[division]' $cek>$dataRow[division]</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Unit *</label>
                                    <select name="txtDepartment" class="select2  form-control" tabindex="-1">
                                      <?php
                                      echo '<option value=""> Select</option>';
                                      $mySql = "SELECT department FROM master_organization where department!=''  group by department order by department ";
                                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                                        // if ($dataRow['department'] == $datadepartment) {
                                        //   $cek = " selected";
                                        // } else {
                                        $cek = "";
                                        // }
                                        echo "<option value='$dataRow[department]' $cek>$dataRow[department]</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Major *</label>
                                    <select name="txtUnit" class="select2  form-control" tabindex="-1">
                                      <?php
                                      echo '<option value=""> Select</option>';
                                      $mySql = "SELECT unit FROM master_organization where unit!='' group by unit order by unit ";
                                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                                        // if ($dataRow['unit'] == $dataunit) {
                                        //   $cek = " selected";
                                        // } else {
                                        $cek = "";
                                        // }
                                        echo "<option value='$dataRow[unit]' $cek>$dataRow[unit]</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Employee *</label>
                                    <select name="txtEmployee" class="select2  form-control" tabindex="-1">
                                      <?php
                                      echo '<option value=""> Select</option>';
                                      $mySql = "SELECT `user_id`, user_fullname FROM master_user where user_status='Active' order by `user_id` ";
                                      $dataQry = mysqli_query($koneksidb, $mySql) or die("Eror Query" . mysqli_error($koneksidb));
                                      while ($dataRow = mysqli_fetch_array($dataQry)) {
                                        // if ($dataRow['unit'] == $dataunit) {
                                        //   $cek = " selected";
                                        // } else {
                                        $cek = "";
                                        // }
                                        echo "<option value='$dataRow[user_id]' $cek>$dataRow[user_fullname]</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>&nbsp;</label><br />
                                    <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit" style="width:100%"><i class="fa fa-plus-square fa-fw"></i> Add</button>
                                  </div>
                                </div>
                                <div class="col-12">

                                  <div class="divider divider-primary">
                                    <div class="divider-text">List Privileges</div>
                                  </div>
                                  <div class="x_content col-xs-12">
                                    <table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Division</th>
                                          <th>Unit</th>
                                          <th>Major</th>
                                          <th>Employee</th>
                                          <th>Updated By</th>
                                          <th>Updated Date</th>
                                          <th>Delete</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php
                                        $mySql   = "SELECT * FROM document_privileges WHERE document_id='" . $dataCode[0] . "'  ORDER BY id";
                                        $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                                        $nomor  = 0;
                                        while ($myData = mysqli_fetch_array($myQry)) {
                                          $nomor++;
                                          $ID = $myData['id'];
                                        ?>

                                          <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['division']; ?></td>
                                            <td><?php echo $myData['department']; ?></td>
                                            <td><?php echo $myData['unit']; ?></td>
                                            <td><?php echo $myData['user_id']; ?></td>
                                            <td><?php echo $myData['updated_by']; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>
                                            <td><a href="?page=Content-Management-Grant-Access-Delete&id=<?php echo $dataReff; ?>&id2=<?php echo $ID; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              <?php   } ?>
                              </div>

                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /x_content -->
        </div><!-- /x_panel -->
      </div>
    </div><!-- /row -->
</div>
<!-- /page content -->
</form>
<?php
include "footer_difan.php";
?>
<script src="js_new/footer_default.js"></script>