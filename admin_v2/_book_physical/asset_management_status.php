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
            <h2 class="content-header-title float-start mb-0">Book Management</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="?page=Asset-Management-Physical">Physical Book</a>
                </li>
                <li class="breadcrumb-item active"><a>Book Management</a>
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
          elseif ($msg == "cancel") echo "<p>Cancel data berhasil</p>"; ?>
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
                <h4 class="card-title">Data Status History</h4>
              </div>

            </div>
            <div class="card-datatable">
              <table id="datatable-responsive" class="table datatables-basic table-striped" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Doc ID.</th>
                    <th>Ver.</th>
                    <th>Status</th>
                    <th>Updated By</th>
                    <th>Updated Date</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $mySql   = "SELECT * FROM document_status
									WHERE document_id='" . $_GET['id'] . "' ORDER BY updated_date";

                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['document_id'];
                    $Version = $myData['document_version'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $myData['document_id']; ?></td>
                      <td><?php echo $myData['document_version']; ?></td>
                      <td><?php echo $myData['document_status']; ?></td>
                      <td><?php echo $myData['updated_by']; ?></td>
                      <td><?php echo $myData['updated_date']; ?></td>

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