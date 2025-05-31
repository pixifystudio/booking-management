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
                                <li class="breadcrumb-item"><a>Transaksi Non-Struk</a>
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
                                    <div class="row">

                                       
                                                <div class="col-2">
                                                    <br>
                                                    <a type="button" href="?page=Input-Pengeluaran-Add" name="btnLaporanTransaksi" style="width: 100%;" class="btn btn-danger">Input Pengeluaran</a>
                                                </div>
                                                <div class="col-2">
                                                    <br>
                                                    <a type="button" href="?page=Input-Pemasukkan-Add"ame="btnLaporanTransaksi" style="width: 100%;" class="btn btn-success">Input Pemasukkan</a>
                                                </div>
                                                 <div class="col-2">
                                                    <br>

                                                  <a type="button" href="?page=Pindah-Nominal"ame="btnLaporanTransaksi" style="width: 100%;" class="btn btn-warning">Pindah Nominal</a>
                                                </div>

                        <?php if ($_SESSION['SES_GROUP'] =='Super Admin') { ?>

                                                <?php 
                                                // ambil pendapatan hari ini
                                                $todaystart = date('Y-m-d 00:00:00');
                                                $todayend = date('Y-m-d 23:59:59');

                                                $mySql1   = "SELECT qty,nominal,is_pindah_nominal  FROM `transaction` WHERE transaction_id !='' AND updated_date >='$todaystart' and updated_date <='$todayend' and `status` = 'IN' ";
                                                $myQry1 = mysqli_query($koneksidb, $mySql1);
                                                $sum_total = 0;

                                                while ($myData1 = mysqli_fetch_array($myQry1)) {
                                                    $qty = $myData1['qty'];
                                                    $nominal = $myData1['nominal'];

                                                    $total = $nominal * $nominal;
                                                    $sum_total += $total;

                                                }

                                                 // ambil pendapatan bulanan
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql2   = "SELECT qty,nominal,is_pindah_nominal  FROM `transaction` WHERE transaction_id !='' AND updated_date >='$monthstart' and updated_date <='$monthend' ";
                                                $myQry2 = mysqli_query($koneksidb, $mySql2);
                                                $sum_total2 = 0;

                                                while ($myData2 = mysqli_fetch_array($myQry2)) {
                                                    $qty2 = $myData2['qty'];
                                                    $nominal2 = $myData2['nominal'];

                                                    $total2 = $nominal2 * $qty2;
                                                    $sum_total2 = $sum_total2 + $total2;

                                                }



                                                ?>
                                              
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                        <!-- </div> -->

                     
                        <div class="card-datatable">
                            <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk / Keterangan</th>
                                        <th>Nominal</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Statu</th>
                                        <th>Updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM `transaction` WHERE keterangan !='DP'";
                                    if ($month != '') {
                                        $monthstart = $month . '-01';
                                        $monthend = $month . '-31';
                                        $mySql .= " AND updated_date >='$monthstart' and updated_date <='$monthend'";
                                    }
                                    if ($metode != '') {
                                        $mySql .= " AND metode ='$metode' ";
                                    }
                                    $mySql .= " order by `updated_date` desc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;

                                        $Code =  $myData['transaction_id'];

                                        $status = $myData['is_pindah_nominal'] ? 'Pindah Saldo '.$myData['status'] : $myData['status'];
                                    ?>

                                        <tr>

                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['keterangan']; ?></td>
                                            <td><?php echo 'Rp' . number_format(($myData['nominal'])) ?></td>
                                            <td><?php echo $myData['metode']; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $myData['updated_date']; ?></td>


                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                           <?php } ?>
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