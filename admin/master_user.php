<?php
$_SESSION['SES_TITLE'] = "Master User";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Master-User";
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
                        <h2 class="content-header-title float-start mb-0">Management User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>User</a>
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
                } else
                    if ($status == 'gagal-user') {
                    echo "&nbsp;<div class='alert alert-warning'>";
                    echo "&nbsp;&nbsp; Username sudah pernah dibuat sebelumnya<br>";
                    echo "</div>";
                } else 
                if ($status == 'edited') {
                    echo "&nbsp;<div class='alert alert-success'>";
                    echo "&nbsp;&nbsp; Berhasil di Edit<br>";
                    echo "</div>";
                } else 
                if ($status == 'password') {
                    echo "&nbsp;<div class='alert alert-warning'>";
                    echo "&nbsp;&nbsp; Password setidaknya minimal 8 karakter, terdapat minimal 1 angka dan 1 huruf besar <br>";
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
                                <form role="form" action="?page=Master-User-Add" method="POST" name="form1" target="_self" id="form1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 col-12">
                                                    <label>User Name</label>
                                                    <input type="text" id="basic-addon-name" readonly onfocus="this.removeAttribute('readonly')" autocomplete="false" class="form-control" placeholder="Username" aria-label="Name" name='txtUsername' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Nama</label>
                                                    <input type="text" id="basic-addon-name" readonly onfocus="this.removeAttribute('readonly')" autocomplete="false" class="form-control" placeholder="Name" aria-label="Name" name='txtName' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Email</label>
                                                    <input type="text" id="basic-addon-name" readonly onfocus="this.removeAttribute('readonly')" autocomplete="false" class="form-control" placeholder="Email" aria-label="Email" name='txtEmail' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Password</label>
                                                    <input type="password" id="basic-addon-name" readonly onfocus="this.removeAttribute('readonly')" autocomplete="false" class="form-control" placeholder="Password" aria-label="Name" name='txtPassword' aria-describedby="basic-addon-name" />
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <label>Role</label>
                                                    <select class="form-select" name="txtRole" aria-label="Default select example" readonly onfocus="this.removeAttribute('readonly')" autocomplete="false" required>
                                                        <option value="">Pilih Role</option>
                                                        <option value="Super Admin">Super Admin</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        <!-- <th>Reschedule</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $mySql   = "SELECT * FROM master_user order by user_id desc";
                                    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                    $nomor  = 0;
                                    while ($myData = mysqli_fetch_array($myQry)) {
                                        $nomor++;
                                        $Code = $myData['user_id'];
                                    ?>

                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['user_fullname']; ?></td>
                                            <td><?php echo $myData['user_name']; ?></td>
                                            <td><?php echo $myData['user_email']; ?></td>
                                            <td><?php echo $myData['user_group']; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="?page=Master-User-Edit&id=<?php echo $Code; ?>" onclick="return confirm('INGIN EDIT DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="?page=Master-User-Delete&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
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