<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Management Admin";
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
            <h2 class="content-header-title float-start mb-0">Management Booking</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a>QR</a>
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
                <form role="form" action="?page=Management-Admin-Add" method="POST" name="form1" target="_self" id="form1">
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
                        <a href='?page=Management-Booking-QR-Add' type="submit" class="btn btn-danger w-100" name=""><i data-feather='plus'></i> Add Transaction</a>
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
                    <th>No.</th>
                    <th>Transaction ID</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $mySql   = "SELECT 
                                    d.transaction_id,
                                    d.updated_date
                                     FROM data_qr d 
                                    -- left join data_qr_detail dd ON (d.transaction_id = dd.transaction_id) 
                                    -- LEFT JOIN master_product mp ON (dd.product_id = mp.id)
                                    order by d.updated_date desc";
                  $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                  $nomor  = 0;
                  while ($myData = mysqli_fetch_array($myQry)) { ?>
                    <tr>
                      <td><?= $myData['transaction_id'] ?></td>
                      <td><?= $myData['updated_date'] ?></td>
                      <td>
                        <?php if ($ses_group == 'Super Admin') { ?>
                          <a class="dropdown-item" href="?page=Struk-Delete&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                              <i data-feather="trash" class="me-50"></i>
                              <span>Hapus</span>
                          </a>
                          <a class="dropdown-item" href="?page=Print-Struk-Non&&id=<?php echo $Code; ?>" target="_blank" role="button"><i class="fa fa-pencil fa-fw">
                              <i data-feather="printer" class="me-50"></i>
                              <span>Cetak Struk</span>
                          </a>

                        <?php } else { ?>
                          <a class="dropdown-item" href="?page=Print-Struk-Non&id=<?php echo $Code; ?>" role="button"><i class="fa fa-pencil fa-fw">
                              <i data-feather="print" class="me-50"></i>
                              <span>Cetak Struk</span>
                          </a>
                        <?php } ?>

                      </td>
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