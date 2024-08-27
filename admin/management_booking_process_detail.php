<?php
$_SESSION['SES_TITLE'] = "Re-Schedule Booking";
include_once "library/inc.seslogin.php";
include "header_v2.php";
$_SESSION['SES_PAGE'] = "?page=Management-Booking-Rescheduled";
$id = $_GET['id'];

?>
<div class="app-content content ">
  <?php

  # Tombol Tambah diklik
  if (isset($_POST['btnTambah'])) {
    $id = $_GET['id'];

    #data post
    $dataProduct  = $_POST['txtProduct'];
    $dataQty  = $_POST['txtQty'];


    $ses_nama = $_SESSION['SES_NAMA'];

    #ambil harga
    $mySqlPrice = "SELECT * FROM `master_product` where id = '$dataProduct' ORDER BY id DESC LIMIT 1";
    $myQryPrice = mysqli_query($koneksidb, $mySqlPrice) or die("Query Insert Salah : " . mysqli_error($koneksidb));
    $DataPrice = mysqli_fetch_array($myQryPrice);

    $dataNominal = $DataPrice['price'];
    $dataItem = $DataPrice['name'];
    $dataType = $DataPrice['type'];

    // jika 
    if ($dataType == 'inventory') {
      $mySql1   = "INSERT INTO `master_product_stock`( `product_id`,`stock`,`updated_date`)
     VALUES ('$dataProduct','-$dataQty',now())";
      $myQry1   = mysqli_query($koneksidb, $mySql1)  or die("ERROR INPUT STOCK:  " . mysqli_error($koneksidb));
      $id_terbaru = mysqli_insert_id($koneksidb);
    }



    #tambah data
    $mySql   = "INSERT INTO `booking_detail`( `booking_id`, `item`,`qty`, `nominal`, `updated_by`, `updated_date`,`stock_order_id`)
     VALUES ('$id','$dataItem','$dataQty','$dataNominal','$ses_nama',now(),'$id_terbaru')";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;
    # Validasi Insert Sukses
    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking-Process-Detail&id=$id'>";
    }
  }

  # Tombol Submit diklik
  if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    # Baca variabel form
    $id   = $_GET['id'];
    $dataGdrive  = $_POST['txtGdrive'];
    $dataDP  = $_POST['txtDP'];

    # UPDATE KE DATABASE BOOKING

    $mySql   = "UPDATE `booking` 
      SET `status`='Selesai',`updated_date`=now(), link_gdrive ='$dataGdrive', dp = '$dataDP' WHERE id='$id'";
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;

    if ($myQry) { ?>

      <script type="text/javascript">
        window.open("?page=?page=Print-Struk&id=$id&s=success", "_blank");
      </script>
  <?php }
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
    <div class="content-header r
    ]/ ? .nw">
      >.
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Booking</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Konfirmasi Selesai</a
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
                      <h3>Detail Booking</h3>

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


                        <hr>
                        <h3>Detail Transaksi</h3>

                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Product</label>
                            <select class="form-select" name="txtProduct" aria-label="Default select example" autocomplete="off" required>
                              <option selected value="">Pilih</option>
                              <?php
                              // deklarasi selected
                              $cek = '';
                              // panggil database
                              $mySql  = "SELECT * from master_product 
                                group by `name` order by `name` asc";
                              $myQry  = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
                              while ($myData = mysqli_fetch_array($myQry)) {

                              ?>


                                <option value="<?php echo $myData['id']  ?>"><?php echo $myData['name'] ?></option>;
                              <?php
                              };
                              ?>
                            </select>
                          </div>
                        </div>


                        <div class="col-md-3 col-12">
                          <div class="form-group">
                            <label>Qty (Kuantiti)<span class="required">*</span></label>
                            <input class="form-control" placeholder="Qty" name="txtQty" type="number" value="" maxlength="100" required />
                          </div>
                        </div>

                        <div class="col-md-3 col-12">
                          <br>
                          <button type=" submit" name="btnTambah" class="btn btn-info me-3">Tambah Item</button>
                        </div>

                      </div>


        </form>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
          <br>
          <div class="card-datatable">
            <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Item</th>
                  <th>Nominal</th>
                  <th>Qty</th>
                  <th>Hapus</th>
                  <!-- <th>Reschedule</th> -->
                </tr>
              </thead>
              <tbody>

                <?php
                $total_pembayaran = 0;
                $mySql   = "SELECT * FROM booking_detail where booking_id='$id'  order by updated_date asc";
                $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                $nomor  = 0;
                while ($myData = mysqli_fetch_array($myQry)) {
                  $nomor++;
                  $Code = $myData['booking_detail_id'];
                  $Code2 = $myData['booking_id'];


                ?>

                  <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $myData['item']; ?></td>
                    <td align="right"><?php echo 'RP. ' . number_format($myData['nominal'], 0); ?></td>
                    <td><?php echo $myData['qty']; ?></td>
                    <td>
                      <a href="?page=Management-Booking-Process-Detail-Delete&id=<?php echo $Code; ?>&id2=<?php echo $Code2; ?>" onclick="return confirm('INGIN HAPUS DATA?')" role="button"><i class="fa fa-pencil fa-fw">
                          <i data-feather="trash" class="me-50"></i>
                          <span></span>
                      </a>
                    </td>
                  </tr>

                <?php
                  // akumulasi total pembayaran
                  $total_pembayaran = $total_pembayaran +  ($myData['nominal'] * $myData['qty']);
                }
                ?>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2" align="right">&nbsp;Total Pembayaran</td>
                  <td align="right"><?php echo  'RP. ' . number_format($total_pembayaran, 0); ?></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <hr>
          <div class="col-md-3 col-12">
            <div class="form-group">
              <label>Link Foto (Gdrive)<span class="required">*</span></label>
              <input class="form-control" placeholder="Link" name="txtGdrive" type="text" value="" maxlength="100" required />
            </div>
          </div>


          <div class="col-md-3 col-12">
            <div class="form-group">
              <label>DP <span class="required">*</span></label>
              <input class="form-control" placeholder="DP" name="txtDP" type="number" value="<?php echo $dataDP; ?>" maxlength="100" required />
            </div>
          </div>

      </div>
      <div class="col-7 my-5">
        <a type="button" href="?page=Management-Booking-Process" class="btn btn-warning me-2">Kembali</a>
        <button type="submit" name="btnSubmit" class="btn btn-success me-3">Submit</button>
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