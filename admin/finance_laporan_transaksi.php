<?php
$_SESSION['SES_TITLE'] = "Product";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Product";

// filter

$month = isset($_GET['m']) ? $_GET['m'] : '';
$year = isset($_GET['y']) ? $_GET['y'] : '';
$metode = isset($_GET['mtd']) ? $_GET['mtd'] : '';


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
                        <h2 class="content-header-title float-start mb-0">Finance</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>Laporan Transaksi</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- set notifikasi -->
            <?php
            $status = isset($_GET['s']) ? $_GET['s'] : '';
            if ($status != '') {
                // jika s = success
                if ($status == 'ok') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Update<br>";
                    echo "</div>";
                }
                // jika s = deleted
                else 
                 if ($status == 'tambah') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Tambahkan<br>";
                    echo "</div>";
                }
                // jika s = deleted
                else 
                 if ($status == 'deleted') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Hapus<br>";
                    echo "</div>";
                }
                if ($status == 'edited') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Edit<br>";
                    echo "</div>";
                }
            }
            ?>

        </div>



        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="content-header-left col-md-4 col-12">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="content-header-right text-md-end col-md-12 col-12 d-md-block d-none">
                                <form role="form" action="?page=Master-Product-Add" method="POST" name="form1" target="_self" id="form1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 col-12">
                                                    <label>Bulan</label>
                                                    <input type="month" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtMonth' value="<?= $month ?>" aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Year</label>
                                                    <input type="year" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtYear' value="<?= $year ?>" aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Metode</label>
                                                    <select class="form-select" name="txtMetode" aria-label="Default select example" autocomplete="off" required>
                                                        <option selected value="">Pilih</option>
                                                        <?php
                                                        // panggil database
                                                        $mySql  = "SELECT * from master_status where status_name = 'metode' group by status_sub_name order by status_sub_name asc";
                                                        $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                                                        while ($myData = mysqli_fetch_array($myQry)) {
                                                            if ($myData['status_sub_name'] == $metode) {
                                                                $cek = 'selected';
                                                            } else {
                                                                $cek = '';
                                                            }
                                                        ?>

                                                            <option value="<?php echo $myData['status_sub_name']  ?>" <?= $cek ?>><?php echo $myData['status_sub_name'] ?></option>;
                                                        <?php
                                                        };
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <br>
                                                    <button type="submit" name="btnLaporanTransaksi" style="width: 100%;" class="btn btn-info">Filter</button>
                                                </div>
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
                                        <th>Nama Produk</th>
                                        <th>Nominal</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM `transaction` order by `updated_date` asc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;

                                        $Code =  $myData['id'];


                                    ?>

                                        <tr>

                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['keterangan']; ?></td>
                                            <td><?php echo $myData['nominal']; ?></td>
                                            <td><?php echo $myData['metode']; ?></td>
                                            <td><?php echo $myData['status']; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>
                                        

                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
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
include "footer_v2.php";
?>