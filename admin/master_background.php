<?php
$_SESSION['SES_TITLE'] = "Master Background";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-Background";
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
                                <li class="breadcrumb-item"><a>Background</a>
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
                            <div class="content-header-left text-md-end col-md-12 col-12 d-md-block d-none">
                                <form role="form" action="?page=Master-Background-Add" method="POST" name="form1" target="_self" id="form1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 col-12">
                                                    <label>Paket</label>
                                                    <select class="form-select select2" name="txtJenis[]" aria-label="Default select example" autocomplete="off" multiple required placeholder="Pilih Paket">
                                                        <?php
                                                        // panggil database
                                                        $mySql  = "SELECT * from master_jenis group by paket order by paket asc";
                                                        $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                                                        while ($myData = mysqli_fetch_array($myQry)) {
                                                            if ($myData['paket'] == $dataPaket) {
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
                                                    <input type="text" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" name='txtBackground' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-2">
                                                    <br>
                                                    <button type="submit" style="width: 100%;" class="btn btn-success">Tambah</button>
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
                                        <th>Nama Background</th>
                                        <th>Nama Paket</th>
                                        <th>Action</th>
                                        <!-- <th>Reschedule</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT background, JSON_ARRAYAGG(
                                                            JSON_OBJECT(
                                                                'jenis', jenis,
                                                                'id', id
                                                            )
                                                        ) AS paket from master_background mb 
                                                group by background  order by background asc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code =  str_replace([' '], '_', strtolower($myData['background']));//Use Background name as id edit
                                        // $Code =  $myData['id'];//Old

                                    ?>
                                        <?php $paketNames = array_map(function($arr) {
                                            return $arr->jenis; //return only name of paket without id
                                        }, json_decode($myData['paket']) ?? []) ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['background']; ?></td>
                                            <td><?php echo implode(', ', $paketNames); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="?page=Master-Background-Edit&id=<?php echo $Code; ?>" onclick="return confirm('INGIN EDIT DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="?page=Master-Background-Delete&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
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