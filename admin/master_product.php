<?php
$_SESSION['SES_TITLE'] = "Jadwal";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Jadwal";

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
                        <h2 class="content-header-title float-start mb-0">Booking Management</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>Master Product</a>
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
                                                    <label>Nama Produk</label>
                                                    <input type="time" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtProduk' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-2">
                                                    <br>
                                                    <button type="submit" name="btnProduk" style="width: 100%;" class="btn btn-success">Tambah Produk</button>
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
                                        <th>Jam</th>
                                        <th>Status</th>
                                        <th>Ketersediaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM jadwal order by jam asc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['id'];

                                        // ganti format jam
                                        $Jam = $myData['jam'];
                                        $Jam = date("G:i", strtotime($Jam));

                                        // validasi status
                                        if ($myData['status'] == 1) {
                                            $status = "<span class='badge rounded-pill badge-glow bg-success'>Aktif</span>";
                                        } else {
                                            $status = "<span class='badge rounded-pill badge-glow bg-danger'>Tidak Aktif</span>";
                                        }

                                        // validasi ketersediaan
                                        if ($myData['availability'] == 0) {
                                            $availability = "<span class='badge rounded-pill badge-glow bg-success'>Tersedia</span>";
                                        } else {
                                            $availability = "<span class='badge rounded-pill badge-glow bg-danger'>Tidak Tersedia</span>";
                                        }

                                    ?>

                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $Jam; ?></td>
                                            <td>
                                                <a href="?page=Master-Jadwal-Update-Status&id=<?php echo $Code; ?>" onclick="return confirm('INGIN UPDATE STATUS?')"><?= $status ?></a>
                                            </td>
                                            <td><?php echo $availability; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="?page=Master-Jadwal-Edit&id=<?php echo $Code; ?>" role="button"><i class="fa fa-pencil fa-fw">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="?page=Master-Jadwal-Delete&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                <i data-feather="trash" class="me-50"></i>
                                                                <span>Hapus</span>
                                                        </a>
                                                    </div>
                                                </div>
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