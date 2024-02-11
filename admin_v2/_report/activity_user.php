<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";

$branch = isset($_GET['branch']) ? $_GET['branch'] : '';
$division = isset($_GET['division']) ? $_GET['division'] : '';
$department = isset($_GET['department']) ? $_GET['department'] : '';
$unit = isset($_GET['unit']) ? $_GET['unit'] : '';
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
                <li class="breadcrumb-item active"><a>Activity User</a>
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
              <div class="content-header-left col-md-2 col-12">
                <h4 class="card-title"></h4>
                <div class="mb-1">
                  <h3>Activity User</h3>
                </div>
              </div>
              <div class="content-header-right text-md-end col-md-10 col-12 d-md-block d-none">
                <!-- <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1"> -->
                <div class="row">
                  <div class="col-12">
                    <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">
                      <div class="row">
                        <div class="col-md-2 col-12">
                          <label>From</label>
                          <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtDate' value='<?php echo $date ?>' aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-2 col-12">
                          <label>To</label>
                          <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtDate2' value='<?php echo $date2 ?>' aria-describedby="basic-addon-name" required />
                        </div>
                        <div class="col-md-2 col-12">

                          <label>Institution</label>
                          <select name="txtBranch" class="form-control select2">
                            <option value="">Pilih Institution</option>
                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_organization  group by branch asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['branch'] == $branch) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[branch]' $cek> $dataRow[branch] </option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-2 col-12">

                          <label>Division</label>
                          <select name="txtDivision" class="form-control select2">
                            <option value="">Pilih Division</option>

                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_organization  group by division asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['division'] == $division) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[division]' $cek> $dataRow[division] </option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-2 col-12">

                          <label>Unit</label>
                          <select name="txtDepartment" class="form-control select2">
                            <option value="">Pilih Unit</option>

                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_organization  group by department asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['department'] == $unit) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[department]' $cek> $dataRow[department] </option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-2 col-12">

                          <label>Major</label>
                          <select name="txtUnit" class="form-control select2">
                            <option value="">Pilih Major</option>

                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_organization  group by unit asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['unit'] == $major) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[unit]' $cek> $dataRow[unit] </option>";
                            }
                            ?>
                          </select>
                        </div>


                      </div>

                  </div>
                  <div class="col-11">

                  </div>
                  <div class="col-1">
                    <br>
                    <button type="submit" name="btnActivityUser" class="btn btn-primary">Filter</button>
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
                    <th>NIK</th>
                    <th>User</th>
                    <th>Judul</th>
                    <th>Reading Date</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $mySql        = "SELECT * FROM view_log_document_doc dd join view_document vd on dd.document_id = vd.document_id join master_user mu on dd.user_id = mu.user_id WHERE dd.user_id !=''";
                  if ($date != '') {
                    $mySql .= " AND reading_date >= '$date' and reading_date <= '$date2'";
                  }
                  if ($branch != '') {
                    $mySql .= " AND branch = '$branch'";
                  }
                  if ($division != '') {
                    $mySql .= " AND division = '$division'";
                  }
                  if ($department != '') {
                    $mySql .= " AND department = '$department'";
                  }
                  if ($unit != '') {
                    $mySql .= " AND unit = '$unit'";
                  }
                  $mySql .= " order by dd.user_fullname";
                  // $mySql        = "select u.user_id, u.user_fullname from master_user u  where u.user_id not in (select user_id from view_log_document_doc where document_id='$id') order by user_fullname";
                  $myQryDtl        = mysqli_query($koneksidb, $mySql)  or die(" BIBLIOTECA ERROR : " . mysqli_error($koneksidb));
                  $nomor        = 0;
                  while ($myDataDtl = mysqli_fetch_array($myQryDtl)) {
                    $nomor++;
                    $reading_date        = date_format(new DateTime($myDataDtl['reading_date']), "d F Y H:i:s");
                    $title        = $myDataDtl['document_title_en'];

                  ?>
                    <tr>
                      <td><?php echo $nomor ?></td>
                      <td><?php echo $myDataDtl['user_id'] ?></td>
                      <td><?php echo $myDataDtl['user_fullname'] ?></td>
                      <td><?php echo $title ?></td>
                      <td><?php echo $reading_date ?></td>
                      <!-- <td>A</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                            <i data-feather="more-vertical"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">
                              <i data-feather="edit-2" class="me-50"></i>
                              <span>Edit</span>
                            </a>
                            <a class="dropdown-item" href="#">
                              <i data-feather="trash" class="me-50"></i>
                              <span>Delete</span>
                            </a>
                          </div>
                        </div>
                      </td> -->
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