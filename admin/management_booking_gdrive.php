<?php
$_SESSION['SES_TITLE'] = "Gdrive";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-History";
$ses_group = $_SESSION['SES_GROUP'];

# untuk validasi
$Date = isset($_GET['date']) ? $_GET['date'] : '';
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
                                <li class="breadcrumb-item"><a>Send Gdrive</a>
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
                                                    <label>Tanggal</label>
                                                    <input type="date" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtDate' value='<?php echo $Date ?>' aria-describedby="basic-addon-name" />
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
                                        <th>No WA</th>
                                        <th>Action</th>
                                        <!-- <th>Reschedule</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM booking WHERE id!='' and status ='Selesai'";
                                    // jika tanggal, tipe dan paket !=''
                                    if ($Date != '') {
                                        $mySql .=  " AND tanggal ='$Date'";
                                    }
                                    if ($DataPaket != '') {
                                        $mySql .=  " AND paket ='$DataPaket'";
                                    }
                                    if ($DataBackground != '') {
                                        $mySql .=  " AND background ='$DataBackground'";
                                    }
                                    $mySql .=  " order by tanggal desc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['id'];
                                        $Jam = $myData['jam'];
                                        // TEST
                                        // ganti format jam
                                        $Jam = $Jam;
                                        $Jam = date("G:i", strtotime($Jam));
                                        // set hari
                                        $tanggal = $myData['tanggal'];
                                        $hari = hari_ini($tanggal);

                                        $link_gdrive = $myData['link_gdrive'];
                                        $no_wa = $myData['no_wa'];
                                        $no_wa_baru = "62" . substr($no_wa, 1);

                                        $encoded = str_rot13($link_gdrive);

                                    ?>

                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['nama']; ?></td>
                                            <td><?php echo $myData['no_wa']; ?></td>
                                            <td>
                                                <a class="dropdown-item" href="<?= $link_gdrive ?>" target="_blank" role="button"><i class="fa fa-check fa-fw">
                                                        <i data-feather="external-link" class="me-50"></i>
                                                        <span>Link Check</span>
                                                </a>
                                                <a class="dropdown-item" href="https://wa.me/<?= $no_wa_baru ?>?text=Hai%20kak%2C%20senang%20banget%20bisa%20foto-foto%20bareng%20kamu%20di%20Pixify%20Studio!%20%F0%9F%93%B8%20gimana%20pengalaman%20fotonya%3F%20Kamu%20bisa%20share%20di%20sini%20yaa%3A%0A%0Ahttps%3A%2F%2Fg.page%2Fr%2FCUl21qMVJcfCEB0%2Freview%0ARating%20dan%20review%20kamu%20sangat%20ngebantu%20banget%20buat%20berkembangnya%20pengalaman%20foto%20kamu%20kedepannya%20%F0%9F%A4%A9%0A%0ADan%20Ini%20nih%20link%20download%20foto-foto%20kamu%20yang%20keren%20abis%3A%0A%0A%5Bhttps%3A%2F%2Fdrive.google.com%2Fdrive%2Ffolders%2F1VYmY4CMwFDapzB5WXGKCahv63Q2gZQ1N%5D%0A*link%20berlaku%207%20hari%20yaa%0A%0A%F0%9F%98%8D%20%F0%9F%98%8D%20%F0%9F%98%8D%0AKapan-kapan%20main%20lagi%20ke%20studio%20kitayaa~%20Jangan%20lupa%20pamer%20foto-foto%20kamu%20di%20sosmed%20ya%2C%20sambil%20tag%20dan%20mention%20%40pxy.studio%20biar%20makin%20kecee%20%F0%9F%99%8C%F0%9F%8F%BB%0Ajgn%20lupa%20juga%20ikutin%20sosial%20media%20kita%20buat%20info%20promo%20menarik%20lainnya%20di%20%40pxy.studio%20%F0%9F%98%89" target="_blank" role="button"><i class="fa fa-pencil fa-fw">
                                                        <i data-feather="send" class="me-50"></i>
                                                        <span>Sent to WA</span>
                                                </a>
                                            </td>
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