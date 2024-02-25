<?php
$_SESSION['SES_TITLE'] = "Re-Schedule Booking";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-Booking-Rescheduled";
$id = $_GET['id'];

?>
<div class="app-content content ">
  <?php

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    $dataCode  = $_POST['txtCode'];
    $dataTanggal  = $_POST['txtTanggal'];
    $dataJam  = $_POST['txtJam'];

    # VALIDASI JAM 
    # CEK APAKAH JAM TERSEBUT SUDAH DIGUNAKAN DI HARI YANG DIPILIH
    $mySqlCek  = "SELECT tanggal, jam FROM booking WHERE tanggal='$dataTanggal' and jam ='$dataJam'";
    $myQryCek  = mysqli_query($koneksidb, $mySqlCek)  or die("Query ambil data salah : " . mysqli_error());
    $JumlahDataCek = mysqli_num_rows($myQryCek);

    if ($JumlahDataCek >= 1) {
      $pesanError[] = "Jam tersebut tidak tersedia untuk tanggal yang dipilih";
    }
    #VALIDASI JAM SELESAI


    # JIKA ADA PESAN ERROR DARI VALIDASI
    if (count($pesanError) >= 1) {
      echo "&nbsp;<div class='alert alert-warning'>";
      $noPesan = 0;
      foreach ($pesanError as $indeks => $pesan_tampil) {
        $noPesan++;
        echo "&nbsp;&nbsp; $pesan_tampil<br>";
      }
      echo "</div>";
    } else {
      # SIMPAN DATA KE DATABASE. 
      // Jika tidak menemukan error, simpan data ke database

      $ses_nama  = $_SESSION['SES_NAMA'];
      $mySql    = "UPDATE booking set tanggal ='$dataTanggal', jam ='$dataJam' where id='$dataCode'";
      $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
      if ($myQry) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking&s=success'>";
      }
      exit;
    }
  } // Penutup Tombol Submit

  # MASUKKAN DATA KE VARIABEL
  # TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
  $Code  = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtCode'];
  $mySql  = "SELECT * FROM booking WHERE id='$Code'";
  $myQry  = mysqli_query($koneksidb, $mySql)  or die("Query ambil data salah : " . mysqli_error());
  $myData = mysqli_fetch_array($myQry);
  # MASUKKAN DATA KE VARIABEL
  $dataCode    = $myData['id'];
  $dataNama    = $myData['nama'];
  $dataEmail    = $myData['email'];
  $dataWA    = $myData['no_wa'];
  $dataTanggal    = $myData['tanggal'];
  $dataJam    = $myData['jam'];
  ?>
  <!-- BEGIN: Content-->
  <div class="content-overlay">
  </div>
  <div class="header-navbar-shadow">
  </div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Booking</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Re-Schedule</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class="row">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-bottom">
                <div class="content-header-right col-md-12 col-12 d-md-block d-none">

                  <div class="row">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3 col-12">
                          <div class="mb-1">
                            <label class="form-label" for="User ID">Booking ID</label>
                            <input class="form-control" name="txtCode" type="text" value="<?php echo $dataCode; ?>" maxlength="20" required readonly />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Nama <span class="required">*</span></label>
                            <input class="form-control" placeholder="Name" name="txtNama" type="text" value="<?php echo $dataNama; ?>" maxlength="100" required readonly />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>No Whatsapp <span class="required">*</span></label>
                            <input class="form-control" placeholder="Phone" name="txtWA" type="text" value="<?php echo $dataWA; ?>" maxlength="100" required readonly />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <input class="form-control" placeholder="Email" name="txtEmail" type="text" value="<?php echo $dataEmail; ?>" maxlength="100" required readonly />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Tanggal Booking </label>
                            <input class="form-control" placeholder="YYYY-MM-DD" name="txtTanggal" type="date" value="<?php echo $dataTanggal; ?>" autocomplete="off" required />
                          </div>
                        </div>
                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Jam Booking*</label>
                            <select class="form-select" id="waktu" name="txtJam" aria-label="Default select example" autocomplete="off" required>
                              <?php
                              $mySql  = "SELECT * from jadwal j where j.status ='1' and j.availability ='0'  order by j.jam asc;";

                              $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                              while ($myData = mysqli_fetch_array($myQry)) {
                                // set tanggal hari ini
                                $hariini = date('Y-m-d');
                                // jadwal jam yang tersedia
                                $jam = date("H:i", strtotime($myData['jam']));
                                $dataJam = date("H:i", strtotime($dataJam));
                                #jam sesuaikan dengan jam yang diset sebelumnya
                                if ($jam == $dataJam) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                              ?>
                                <option <?= $selected ?> value="<?php echo $jam  ?>"><?php echo $jam ?></option>;
                              <?php
                                // jika tanggal yang dipilih bukan hari ini maka tampilkan semua 

                              }


                              ?>
                            </select>
                          </div>
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
                              <th>Paket</th>
                              <th>Background</th>
                              <th>Status</th>
                              <th>Action</th>
                              <!-- <th>Reschedule</th> -->
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $mySql   = "SELECT * FROM booking where status ='Dikonfirmasi' and tanggal >= '$tanggal_hari_ini' order by tanggal desc";
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

                            ?>

                              <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $myData['nama']; ?></td>
                                <td><?php echo $hari; ?></td>
                                <td><?php echo $myData['tanggal']; ?></td>
                                <td><?php echo $Jam; ?></td>
                                <td><?php echo $myData['no_wa']; ?></td>
                                <td><?php echo $myData['paket']; ?></td>
                                <td><?php echo $myData['background']; ?></td>
                                <td><?php echo $myData['status']; ?></td>
                                <?php if ($myData['status'] == 'Dikonfirmasi') { ?>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="?page=Management-Booking-Process-Detail&id=<?php echo $Code; ?>" onclick="return confirm('INGIN KONFIRMASI DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                                            <i data-feather="check" class="me-50"></i>
                                            <span>Selesai</span>
                                        </a>
                                        <a class="dropdown-item" href="?page=Management-Booking-Rescheduled&id=<?php echo $Code; ?>" onclick="return confirm('INGIN RESCHEDULED?')" role="button"><i class="fa fa-pencil fa-fw">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Re-Schedule</span>
                                        </a>
                                        <a class="dropdown-item" href="?page=Management-Booking-Cancel&id=<?php echo $Code; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
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
                    <div class="col-7 my-5">
                      <a type="button" href="?page=Management-Booking" class="btn btn-warning me-2">Kembali</a>
                      <button type="submit" name="btnSubmit" class="btn btn-success me-3">Re-Schedule</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
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
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_v2.php";
?>