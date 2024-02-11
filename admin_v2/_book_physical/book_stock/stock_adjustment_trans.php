<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
$msg = @$_GET['msg'];
$cat = $_GET['cat'];
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
                        <h2 class="content-header-title float-start mb-0">Education Asset History</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>History</a>
                                </li>
                                <li class="breadcrumb-item"><a>List of Asset</a>
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
                            <div class="content-header-left col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">List of Asset</h4>

                                    </div>
                                    <div class="col-6">
                                        <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">
                                            <div class="row">
                                                <div class="col-md-6 col-12">

                                                    <label>Category</label>
                                                    <select name="txtCategory" class="form-control select2">
                                                        <?php
                                                        $dataQry = mysqli_query($koneksidb, "SELECT * from master_category where category_level_1='PHYSICAL'  order by category_level_2 asc");
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

                                                <div class="col-md-6 col-12">
                                                    <br>
                                                    <button type="submit" name="btnBookBorrow" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
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
                                        <th>ID</th>
                                        <th>Asset</th>
                                        <th>Location</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // SET TODAY
                                    $today = date('Y-m-d');
                                    $mySql     = "SELECT
                                    s1.stock_order_id,
                                    u.user_id,
                                    u.user_fullname,
                                    s2.stock_order_reference_id ,
                                    s1.stock_order_status,
                                    s1.stock_order_date,
                                    d.document_id,
                                    d.document_title_id,
                                    r.racking_number,
                                    category_level_3,
                                    IFNULL( s2.stock_order_id, 'Belum dikembalikan' ) as retur, 
                                    s1.date_in as date_in, 
                                    s2.date_in as retur_in
                                FROM
                                    `stock_order` s1
                                    JOIN view_document d on d.document_id=s1.stock_order_for
                                    JOIN master_racking r on r.racking_id=d.racking_id
                                    JOIN master_user u on u.user_id=s1.stock_order_reference_id
                                    LEFT JOIN stock_order s2 ON s1.stock_order_id = s2.stock_order_reference_id 
                                    AND s2.stock_order_reference != 'BORROWING' 
                                WHERE
                                    s1.stock_order_reference = 'BORROWING' ";
                                    if ($cat != '') {
                                        $mySql .= " and category_level_3 = '$cat'";
                                    }
                                    $mySql   .= " order by s1.updated_date desc";
                                    $myQry     = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $retur = $myData['retur'];

                                        // jika tanggal hari ini lebih dari tanggal kembali, maka kasih flag merah
                                        $bg = '';
                                        if (($retur == 'Belum dikembalikan') && ($myData['date_in'] < date('Y-m-d'))) {
                                            $bg = '<span class="badge rounded-pill badge-light-danger me-1">' . $myData['retur'] . '</span>';
                                        } elseif (($retur == 'Belum dikembalikan')) {
                                            $bg = '<span class="badge rounded-pill badge-light-info me-1">' . $myData['retur'] . '</span>';
                                        } else {
                                            $bg = '<span class="badge rounded-pill badge-light-success me-1">' . $myData['retur'] . " | " . $myData['retur_in'] . '</span>';
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['stock_order_id']; ?></td>
                                            <td><?php echo $myData['document_id'] . " | " . $myData['document_title_id']; ?></td>
                                            <td><?php echo $myData['racking_number']; ?></td>
                                            <td><?php echo $myData['user_id'] . " | " . $myData['user_fullname']; ?></td>
                                            <td><?php echo $myData['stock_order_date']; ?></td>
                                            <td><?php echo $bg ?></td>
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
<script src=" js_new/footer_default.js">
</script>