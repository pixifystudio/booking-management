<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$date2 = isset($_GET['date2']) ? $_GET['date2'] : '';


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
            <h2 class="content-header-title float-start mb-0">Report</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Content History</a>
                </li>
                <li class="breadcrumb-item"><a>Report</a>
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
              <div class="content-header-left col-md-4 col-12">
                <h4 class="card-title"></h4>
                <div class="mb-1">
                  <h3>Content History List</h3>
                </div>
              </div>
              <div class="content-header-right text-md-end col-md-8 col-12 d-md-block d-none">
                <div class="row">
                  <div class="col-md-2 col-12 px-25">
                    <!-- <div class="mb-1">
                        <select id="code" class="form-select select2" tabindex="-1" name="txtCode">
                          <option value='' selected>[ Semua Kategori ]</option>
                        </select>
                      </div> -->
                  </div>
                  <div class="col-10">
                    <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">
                      <div class="row">
                        <div class="col-md-3 col-12">
                          <label>From</label>
                          <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtDate' value='<?php echo $date ?>' aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-3 col-12">
                          <label>To</label>
                          <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtDate2' value='<?php echo $date2 ?>' aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-3 col-12">

                          <label>Category</label>
                          <select name="txtCategory" class="form-control select2">
                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_category  where category_level_1='DIGITAL'   order by category_level_2 asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['category_level_3'] == $cat) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[category_level_3]' $cek>$dataRow[category_level_2] -  $dataRow[category_level_3] </option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-1 col-12">
                          <br>
                          <button type="submit" name="btnBookHistory" class="btn btn-primary">Filter</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="card-datatable">
              <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Date / Time</th>
                    <th>ID</th>
                    <th>Ver</th>
                    <th>Title</th>
                    <!-- <th>Files</th> -->
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Prodi</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 0;
                  $mySql    = "SELECT * FROM view_log_document";
                  if ($date != '') {
                    $date = $date . ' 00:00:00';
                    $date2 = $date2 . ' 00:00:00';
                    $mySql .= " WHERE log_date >= '$date' and log_date <= '$date2'";
                  }
                  if ($cat != '') {
                    $mySql .= " AND category_level_3 ='$cat'";
                  }
                  $mySql   .= " ORDER BY log_date ";
                  $myQry    = mysqli_query($koneksidb, $mySql);
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                  ?>
                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $myData['log_date']; ?></td>

                      <td><?php echo $myData['document_id']; ?></td>
                      <td><?php echo $myData['document_version']; ?></td>
                      <td><?php echo $myData['document_title_id']; ?></td>
                      <!-- <td><?php echo $myData['document_file_title']; ?></td> -->
                      <td><?php echo $myData['user_id']; ?></td>
                      <td><?php echo $myData['user_fullname']; ?></td>
                      <?php
                      echo "<td>" . $myData['division'] . "</td>";
                      ?>
                      <?php
                      echo "<td>" . $myData['department'] . "</td>";
                      ?>

                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
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