<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
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
            <h2 class="content-header-title float-start mb-0"> Content Privileges</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a></a>
                </li>
                <li class="breadcrumb-item"><a> List Privileges </a>
                </li>
              </ol>
            </div>
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header border-bottom">
              <div class="content-header-left col-md-6">
                <h4 class="card-title">List Privileges</h4>
              </div>
              <div class="content-header-rigth col-md-1">
                <a href='?page=Content-Management-Grant-Access' type="submit" class="btn btn-secondary" name=""><i data-feather='plus'></i> Add</a>
              </div>
              <!-- <form role="form" action="?page=Sales-Lite-Validasi" method="POST" name="form1" target="_self" id="form1">
                <div class="dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap">
                  <div class="me-1">
                    <div class="dataTables_filter mt-50"><label>Tanggal Pembiayaan :</label></div>
                  </div>
                  <div class="user_role mt-50 width-200 me-1">
                    <input id="tanggal" autocomplete="off" class="dapick form-control" name="txtMonth" type="text" value="<?php echo $dataMonth; ?>" required />
                  </div>
                  <div class="user_role mt-50 width-200 me-1">
                    <input id="tanggal" autocomplete="off" class="dapick form-control" name="txtYear" type="text" value="<?php echo $dataYear; ?>" />
                  </div>
                  <div class="dt-buttons btn-group flex-wrap">
                    <button class="btn add-new btn-primary mt-50" name="btnPembiayaan" type="submit"><span>Filter</span>
                    </button>
                  </div>
                </div>
              </form> -->
            </div>
            <div class="card-datatable">
              <table id="datatable-responsive" class="table datatables-basic table-striped" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Content</th>
                    <th>Division</th>
                    <th>Unit</th>
                    <th>Major</th>
                    <!-- <th>Employee</th> -->
                    <th>Updated By</th>
                    <th>Updated Date</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $mySql   = "SELECT p.*,document_title_id,v.document_version FROM view_document v join document_privileges p on p.document_id=v.document_id where category_level_1!='PHYSICAL'   ORDER BY id";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $ID = $myData['id'];
                    $Code = $myData['document_id'] . ' | ' . $myData['document_title_id'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $myData['document_id'] . ' | ' . $myData['document_title_id']; ?></td>
                      <td><?php echo $myData['division']; ?></td>
                      <td><?php echo $myData['department']; ?></td>
                      <td><?php echo $myData['unit']; ?></td>
                      <!-- <td><?php echo $myData['user_id'] . ' ' . $myData['user_fullname']; ?></td> -->
                      <td><?php echo $myData['updated_by']; ?></td>
                      <td><?php echo $myData['updated_date']; ?></td>
                      <td><a href="?page=Content-Management-Grant-Access-Delete&id=<?php echo $Code; ?>&id2=<?php echo $ID; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- END: Content-->

<?php
include "footer_difan.php";
?>
<script src="js_new/footer_default.js"></script>