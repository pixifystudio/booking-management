<?php
$_SESSION['SES_TITLE'] = "History";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-History";
$ses_group = $_SESSION['SES_GROUP'];

# untuk validasi
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$DataPaket = isset($_GET['p']) ? $_GET['p'] : '';
$DataBackground = isset($_GET['b']) ? $_GET['b'] : '';
#

function hari_ini($tanggal)
{
    $tanggal =
        $hari = date("D", strtotime($tanggal));

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return "<b>" . $hari_ini . "</b>";
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
                        <h2 class="content-header-title float-start mb-0">Booking</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>History</a>
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
                if ($status == 'success') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Re-Schedule<br>";
                    echo "</div>";
                }
                // jika s = deleted
                else 
                 if ($status == 'deleted') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Hapus<br>";
                    echo "</div>";
                }
                // jika s = deleted
                else 
                 if ($status == 'confirmation') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Konfirmasi<br>";
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
                                                    <label>Dari</label>
                                                    <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtFrom' value='<?php echo $from ?>' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Sampai</label>
                                                    <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtTo' value='<?php echo $to ?>' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">

                                                    <label>Paket</label>
                                                    <select class="form-select" id="paketfoto" name="txtPaket" aria-label="Default select example" autocomplete="off">
                                                        <option selected value="">Semua</option>
                                                        <?php
                                                        // panggil database
                                                        $mySql  = "SELECT * from master_jenis group by paket order by paket asc";
                                                        $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                                                        while ($myData = mysqli_fetch_array($myQry)) {
                                                            if ($myData['paket'] == $DataPaket) {
                                                                $cek = 'Selected';
                                                            } else {
                                                                $cek = '';
                                                            }
                                                            echo "<option value='$myData[paket]' $cek> $myData[paket] </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2 col-12">

                                                    <label>Background</label>
                                                    <select class="form-select" id="background" name="txtBackground" aria-label="Default select example" autocomplete="off">
                                                        <option selected value="">Semua</option>
                                                        <?php
                                                        // panggil database
                                                        $mySql  = "SELECT * from master_background order by id asc";
                                                        $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                                                        while ($myData = mysqli_fetch_array($myQry)) {
                                                            if ($myData['background'] == $DataBackground) {
                                                                $cek = 'Selected';
                                                            } else {
                                                                $cek = '';
                                                            }
                                                            echo "<option value='$myData[background]' $cek> $myData[background] </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <br>
                                                    <button type="submit" name="btnHistory" style="width: 100%;" class="btn btn-success">Filter</button>
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
                                        <th>Nama</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>No WA</th>
                                        <th>Instagram</th>
                                        <th>Paket</th>
                                        <th>Background</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>Reschedule</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                  

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