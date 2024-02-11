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
                        <h2 class="content-header-title float-start mb-0">Content Expiration</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item "><a>List Content Expiration</a>
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
                            <div class="content-header-left col-md-11">
                                <h4 class="card-title">List Content Expiration</h4>
                            </div>
                            <div class="content-header-rigth col-md-1">
                                <!-- <a href='?page=<?= $link; ?>-Add' type="submit" class="btn btn-danger" name=""><i data-feather='plus'></i> Add</a> -->
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
                                        <th>ID</th>
                                        <th>Ver.</th>
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Categories</th>
                                        <th>Change History</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $id  = isset($_GET['id']) ?  $_GET['id'] : '%';
                                    $st  = isset($_GET['st']) ?  $_GET['st'] : '%';
                                    $mySql   = "SELECT v.* FROM view_document v WHERE DATEDIFF(document_expire_date,NOW()) < 30 AND category_level_1='DIGITAL' order  by v.updated_date desc ";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['document_id'];
                                        $Version = $myData['document_version'];
                                        $dataCategory1 = $myData['category_level_1'];
                                        if ($dataCategory1 == 'PHYSICAL') {
                                            $link = 'Book-Management-Physical';
                                        } else {
                                            $link = 'Content-Management-Digital';
                                        }
                                        if ($myData['category_level_2'] != '') {
                                            $dataCategory2 = ' | ' . $myData['category_level_2'];
                                        } else {
                                            $dataCategory2 = '';
                                        };
                                        if ($myData['category_level_3'] != '') {
                                            $dataCategory3 = ' | ' . $myData['category_level_3'];
                                        } else {
                                            $dataCategory3 = '';
                                        };
                                        if ($myData['category_level_4'] != '') {
                                            $dataCategory4 = ' | ' . $myData['category_level_4'];
                                        } else {
                                            $dataCategory4 = '';
                                        };
                                        if ($myData['category_level_5'] != '') {
                                            $dataCategory5 = ' | ' . $myData['category_level_5'];
                                        } else {
                                            $dataCategory5 = '';
                                        };
                                        if ($myData['category_level_6'] != '') {
                                            $dataCategory6 = ' | ' . $myData['category_level_6'];
                                        } else {
                                            $dataCategory6 = '';
                                        };
                                        $Category = $dataCategory1 . $dataCategory2 . $dataCategory3 . $dataCategory4 . $dataCategory5 . $dataCategory6;
                                    ?>

                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><a href="?page=<?= $link; ?>-View&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" alt="View Data"><u><?php echo $myData['document_id']; ?></u></a></td>
                                            <td><a href="?page=<?= $link; ?>-Version&id=<?php echo $Code;  ?>" alt="View Data"><u><?php echo $myData['document_version']; ?></u></a></td>

                                            <td><?php echo $myData['document_date']; ?></td>
                                            <td><?php echo $myData['document_expire_date']; ?></td>
                                            <td><?php echo $myData['document_title_id']; ?></td>
                                            <td><a href="?page=<?= $link; ?>-Status&id=<?php echo $Code;  ?>" alt="View Data"><u><?php echo $myData['document_status']; ?></u></a></td>
                                            <td><?php echo $Category; ?></td>
                                            <td><?php echo $myData['document_change_history']; ?></td>
                                            <td>
                                                <?php if ($myData['document_status'] != 'Reviewed' && $myData['document_status'] != 'Request Delete') { ?>
                                                    <a href="?page=<?= $link; ?>-Edit&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Edit Data"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                <?php } ?>
                                                <span>|</span>
                                                <?php if ($myData['document_status'] != 'Reviewed' && $myData['document_status'] != 'Request Delete') { ?>
                                                    <a href="?page=<?= $link; ?>-Delete&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA?')"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                                <?php } ?>
                                            </td>
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