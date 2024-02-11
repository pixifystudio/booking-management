<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
$getID  = isset($_GET['code']) ?  $_GET['code'] : '';
if ($getID == 'Digital') {
  $code = 'E-Document';
} else {
  $code = 'Physical Document';
}

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
            <h2 class="content-header-title float-start mb-0">Approval</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a></a>
                </li>
                <li class="breadcrumb-item"><a> List Approval </a>
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
              </div>
              <div class="content-header-right text-md-end col-md-8 col-12 d-md-block d-none">
                <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1">
                  <div class="row">
                    <div class="col-md-5 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="code" class="form-select select2" tabindex="-1" name="txtCode">
                          <option value='' selected>[ Semua Kategori ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-3 col-12 px-25">
                      <!-- <div class="mb-1">
                        <select id="subcategory" class="form-select select2" tabindex="-1" name="txtSubCategory">
                          <option value='' selected>[ Semua Pelanggan ]</option>
                        </select>
                      </div> -->
                    </div>
                    <div class="col-md-4 col-12 ps-25">
                      <div class="mb-1">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-datatable">
              <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Ver.</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Review</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $ses_nama  = $_SESSION['SES_NAMA'];
                  $position = isset($_SESSION['SES_POSITION']) ? $_SESSION['SES_POSITION'] : 'Super Admin';

                  $mySql   = "SELECT * FROM view_document WHERE category_level_1='$getID' and( document_status='Created' or document_status='Updated' or document_status='Request Delete')
									UNION
									SELECT * FROM view_document WHERE document_status='Reviewed' and category_level_1='$getID' ORDER BY document_date desc ";

                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                    $Code = $myData['document_id'];
                    $Version = $myData['document_version'];
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><a href="?page=Content-Management-Digital-View&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" alt="View Data"><u><?php echo $myData['document_id']; ?></u></a></td>
                      <td><a href="?page=Content-Management-Digital-Version&id=<?php echo $Code;  ?>" alt="View Data"><u><?php echo $myData['document_version']; ?></u></a></td>
                      <td><?php echo $myData['document_date']; ?></td>
                      <td><?php echo $myData['document_title_id']; ?></td>
                      <td><?php echo $myData['document_status']; ?></td>

                      <?php if ($position == 'Super Admin') { ?>
                        <td><a href="?page=Content-Management-Approval-Detail&status=Reviewed&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>&code=<?= $getID; ?>" target='_self' alt='Approved' class="btn btn-primary btn-sm"><i class='fa fa-check fa-fw'></i> Review</a>
                        </td>
                      <?php } else { ?>
                        <td></td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot></tfoot>
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