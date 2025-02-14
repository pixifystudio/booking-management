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
                                <form role="form" action="?page=Validasi" method="POST" name="form1" target="_self" id="form1">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 col-12">
                                                    <label>Bulan Tahun</label>
                                                    <input type="month" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtMonth' value="<?= $month ?>" aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Metode</label>
                                                    <select class="form-select" name="txtMetode" aria-label="Default select example" autocomplete="off">
                                                        <option selected value="">All</option>
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
                                                    <button type="submit" name="btnLaporanTransaksi" style="width: 100%;" class="btn btn-success">Filter</button>
                                                </div>
                                                <?php 
                                                // ambil pendapatan hari ini
                                                $todaystart = date('Y-m-d 00:00:00');
                                                $todayend = date('Y-m-d 23:59:59');

                                                $mySql1   = "SELECT qty,nominal  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='$todaystart' and updated_date <='$todayend' and `status` = 'IN' ";
                                                $myQry1 = mysqli_query($koneksidb, $mySql1);
                                                $sum_total = 0;

                                                while ($myData1 = mysqli_fetch_array($myQry1)) {
                                                    $qty = $myData1['qty'];
                                                    $nominal = $myData1['nominal'];

                                                    $total = $nominal * $qty;
                                                    $sum_total += $total;

                                                }

                                                 // ambil pendapatan bulanan
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql2   = "SELECT qty,nominal  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='$monthstart' and updated_date <='$monthend'";
                                                $myQry2 = mysqli_query($koneksidb, $mySql2);
                                                $sum_total2 = 0;

                                                while ($myData2 = mysqli_fetch_array($myQry2)) {
                                                    
                                                    $qty2 = $myData2['qty'];
                                                    $nominal2 = $myData2['nominal'];

                                                    $total2 = $nominal2 * $qty2;
                                                    $sum_total2 = $sum_total2 + $total2;

                                                }

                                        // ambil pendapatan QRIS
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql3   = "SELECT qty,nominal  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='$monthstart' and updated_date <='$monthend'  AND metode='QRIS'";
                                                $myQry3 = mysqli_query($koneksidb, $mySql3);
                                                $sum_total3 = 0;

                                                while ($myData3 = mysqli_fetch_array($myQry3)) {
                                                    $qty3 = $myData3['qty'];
                                                    $nominal3 = $myData3['nominal'];

                                                    $total3 = $nominal3 * $qty3;
                                                    $sum_total3 = $sum_total3 + $total3;

                                                }

                                        // ambil pendapatan CASH
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql4   = "SELECT qty,nominal  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='$monthstart' and updated_date <='$monthend'  AND metode='Cash'";
                                                $myQry4 = mysqli_query($koneksidb, $mySql4);
                                                $sum_total4 = 0;

                                                while ($myData4 = mysqli_fetch_array($myQry4)) {
                                                    $qty4 = $myData4['qty'];
                                                    $nominal4 = $myData4['nominal'];

                                                    $total4 = $nominal4 * $qty4;
                                                    $sum_total4 = $sum_total4 + $total4;

                                                }


                                        // ambil pendapatan Transfer Bank
                                              
                                                $month1 = isset($_GET['m']) ? $_GET['m'] : date('Y-m');
                                                $year1 = isset($_GET['y']) ? $_GET['y'] : date('y');  
                                                $monthstart = $month1 . '-01';
                                                $monthend = $month1 . '-31';     

                                                $mySql5   = "SELECT qty,nominal  FROM `transaction` WHERE keterangan !='DP' AND updated_date >='$monthstart' and updated_date <='$monthend'  AND metode='Transfer Bank'";
                                                $myQry5 = mysqli_query($koneksidb, $mySql5);
                                                $sum_total5 = 0;

                                                while ($myData5 = mysqli_fetch_array($myQry5)) {
                                                    $qty5 = $myData5['qty'];
                                                    $nominal5 = $myData5['nominal'];

                                                    $total5 = $nominal5 * $qty5;
                                                    $sum_total5 = $sum_total5 + $total5;

                                                }


                                                ?>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <h4 class="card-title mb-1">Pendapatan</h4>
                                                            <span>
                                                                <div class="font-small-2">Hari ini</div>
                                                            <h5 class="mb-1"><?=  'Rp' . number_format($sum_total, 0, ',', '.')?></h5>
                                                            </span>
                                                             <span>
                                                                <div class="font-small-2">Bulan ini</div>
                                                            <h5 class="mb-1"><?=  'Rp' . number_format($sum_total2, 0, ',', '.')?></h5>
                                                            </span>
                                                        
                                                            <p class="card-text text-muted font-small-2">
                                                                <!-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> -->
                                                             </p>
                                                        </div>

                                                    <div class="col-3">
                                                            <h4 class="card-title mb-1">Metode</h4>

                                                            <span>
                                                                <div class="font-small-2">Qris</div>
                                                            <h5 class="mb-1"><?=  'Rp' . number_format($sum_total3, 0, ',', '.')?></h5>
                                                            </span>
                                                             <span>
                                                                <div class="font-small-2">Cash</div>
                                                            <h5 class="mb-1"><?=  'Rp' . number_format($sum_total4, 0, ',', '.')?></h5>
                                                            </span>
                                                            <span>
                                                                <div class="font-small-2">Transfer</div>
                                                            <h5 class="mb-1"><?=  'Rp' . number_format($sum_total5, 0, ',', '.')?></h5>
                                                            </span>
                                                        
                                                            <p class="card-text text-muted font-small-2">
                                                                <!-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> -->
                                                             </p>
                                                        </div>
                                                   <div class="col-2">
                                                  <a type="button" href="?page=Pindah-Nominal"ame="btnLaporanTransaksi" style="width: 100%;" class="btn btn-warning">Pindah Nominal</a>
                                                </div>
                                                    </div>

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
                                        <th>Qty</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Book Detail ID</th>
                                        <th>Status</th>
                                        <th>Updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM `transaction` WHERE keterangan !='DP' ";
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


                                    ?>

                                        <tr>

                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['keterangan']; ?></td>
                                            <td><?php echo 'Rp' . number_format(($myData['nominal'])) ?></td>
                                            <td><?php echo $myData['qty']; ?></td>
                                            <td><?php echo $myData['metode']; ?></td>
                                            <td><?php echo $myData['booking_detail_id']; ?></td>
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