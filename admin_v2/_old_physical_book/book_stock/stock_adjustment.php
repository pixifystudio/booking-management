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
                        <h2 class="content-header-title float-start mb-0">Physical Book</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a>Book Stock Management</a>
                                </li>
                                <li class="breadcrumb-item active"><a>List Stock</a>
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
                                <h4 class="card-title">List Digital Book</h4>
                            </div>
                            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                                <div class="mb-1 breadcrumb-right">
                                    <div class="dropdown">
                                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="?page=Book-Management-Physical-Stock-OUT">
                                                <i class="me-1" data-feather="plus-square"></i><span class="align-middle">Adjust OUT</span>
                                            </a>
                                            <a class="dropdown-item" href="?page=Book-Management-Physical-Stock-IN">
                                                <i class="me-1" data-feather="plus-square"></i><span class="align-middle">Adjust IN</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="card-datatable">
                            <table id="datatable-responsive" class="table datatables-basic table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Rack</th>
                                        <th>IN/OUT</th>
                                        <th>Date</th>
                                        <th>Qty</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mySql     = "SELECT * FROM view_stock s  order by s.updated_date desc";
                                    $myQry     = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR :  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['racking_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['product_id'] . " : " . $myData['product_name']; ?></td>
                                            <td><?php echo $myData['racking_number']; ?></td>
                                            <td><?php echo $myData['stock_status']; ?></td>
                                            <td><?php echo $myData['stock_date']; ?></td>
                                            <td><?php echo abs($myData['qty']); ?></td>
                                            <td><?php echo $myData['stock_note']; ?></td>
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