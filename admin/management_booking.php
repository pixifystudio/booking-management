<?php
$_SESSION['SES_TITLE'] = "Booking";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-Booking";
$tanggal_hari_ini = date('Y-m-d', strtotime('-1 day'));


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
                                <li class="breadcrumb-item"><a>Booking</a>
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
                            <div class="content-header-right text-md-end col-md-8 col-12 d-md-block d-none">
                                <form role="form" action="?page=Management-Admin-Add" method="POST" name="form1" target="_self" id="form1">
                                    <div class="row">
                                        <div class="col-md-5 col-12 px-25">
                                        </div>
                                        <div class="col-md-3 col-12 px-25">
                                        </div>
                                        <div class="col-md-4 col-12 ps-25">
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

                                    <?php
                                    $mySql   = "SELECT * FROM booking where status ='Dibuat' order by tanggal asc, jam asc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['id'];
                                        $Jam = $myData['jam'];

                                        // ganti format jam
                                        $Jam = $Jam;
                                        $Jam = date("G:i", strtotime($Jam));
                                        // set hari
                                        $tanggal = $myData['tanggal'];
                                        $hari = hari_ini($tanggal);
                                        $no_wa = $myData['no_wa'];
                                        $instagram = $myData['instagram'];
                                        $no_wa_baru = "62" . substr($no_wa, 1);

                                    ?>

                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['nama']; ?></td>
                                            <td><?php echo $hari; ?></td>
                                            <td><?php echo $myData['tanggal']; ?></td>
                                            <td><?php echo $Jam; ?></td>
                                            <td> <a href="https://wa.me/<?= $no_wa_baru ?>" class="btn secondary btn-large block waves-effect" target="_blank"><?= $no_wa ?></a></td>
                                            <td> <a href="https://www.instagram.com/<?= $instagram ?>" class="btn secondary btn-large block waves-effect" target="_blank"><?= $instagram ?></a></td>
                                            <td><?php echo $myData['paket']; ?></td>
                                            <td><?php echo $myData['background']; ?></td>
                                            <td><?php echo $myData['status']; ?></td>
                                            <?php if ($myData['status'] == 'Dibuat') { ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="?page=Management-Booking-Update&id=<?php echo $Code; ?>" onclick="return confirm('INGIN KONFIRMASI DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                    <i data-feather="check" class="me-50"></i>
                                                                    <span>Konfirmasi</span>
                                                            </a>
                                                            <a class="dropdown-item" href="?page=Management-Booking-Rescheduled&id=<?php echo $Code; ?>" onclick="return confirm('INGIN RESCHEDULED?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Re-Schedule</span>
                                                            </a>
                                                            <a class="dropdown-item" href="?page=Management-Booking-Delete&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <span>Hapus</span>
                                                            </a>
                                                            <a class="dropdown-item" href="?page=Management-Booking-Cancel&id=<?php echo $Code; ?>" onclick="return confirm('INGIN CANCEL DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <span>Batalkan</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php } else { ?>
                                                <td></td>
                                            <?php } ?>
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