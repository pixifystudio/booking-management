<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_v2.php";

$_SESSION['SES_PAGE'] = "?page=Management Admin";

// ambil data 
$id = isset($_GET['id']) ? $_GET['id'] : '';


 $mySql   = "SELECT dd.*, d.updated_date as tanggal_transaksi FROM data_qr_detail dd left join data_qr d on (d.transaction_id = dd.transaction_id) where dd.transaction_id='$id'  order by dd.id asc";
                $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                $nomor  = 0;
             $myData = mysqli_fetch_array($myQry);


 if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    # Baca variabel form
    $id   = $_GET['id'];

    $txtMetode   = $_POST['txtMetodePembayaran'];
    $txtID   = $_POST['txtID'];


    # UPDATE KE DATABASE BOOKING

    $mySql   = "UPDATE `data_qr_detail` 
      SET `metode_pembayaran`='$txtMetode',`updated_date`=now() WHERE transaction_id='$txtID'";
      echo $mySql;
      exit;
    $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
    $nomor  = 0;

    if ($myQry) {
      echo "<meta http-equiv='refresh' content='0; url=?page=Print-Struk-Non&id=$id'>";
    }
  } // Penutup Tombol Submit

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
            <h2 class="content-header-title float-start mb-0">Detail Struk</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a></a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

      <div class="content-body">
                <section class="invoice-preview-wrapper">
                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding pb-0">
                                    <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                            <a href="?page=Login" class="brand-logo">
                                           <img src="../app-assets/images/logo/pixify-letter.png" alt="" height="30">
                                            </a>
                                            </div>
                                               
                                        </div>
                                        <div class="mt-md-0 mt-2">
                                            <p class="invoice-date-title">Tanggal Transaksi:</p>
                                                <p class="invoice-date"><?= $myData['tanggal_transaksi'] ?></p>
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                      
                                        <!-- <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Payment Details:</h6>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="pe-1">Total Due:</td>
                                                        <td><span class="fw-bold">$12,110.55</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">Bank name:</td>
                                                        <td>American Bank</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">Country:</td>
                                                        <td>United States</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">IBAN:</td>
                                                        <td>ETD95476213874685</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">SWIFT code:</td>
                                                        <td>BR91905</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <!-- Invoice Description starts -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Item</th>
                                                <th class="py-1">Nominal</th>
                                                <th class="py-1">Qty</th>
                                                <th class="py-1">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                          // ambil data detail struk
                                            $total = 0;
                                            $mySqlDetail   = "SELECT dd.*, d.updated_date as tanggal_transaksi FROM data_qr_detail dd left join data_qr d on (d.transaction_id = dd.transaction_id) where dd.transaction_id='$id'  order by dd.id asc";
                                            $myQryDetail   = mysqli_query($koneksidb, $mySqlDetail)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                                            $nomor  = 0;
                                       while ($myDataDetail = mysqli_fetch_array($myQryDetail)) {
                                              $subtotal = $myDataDetail['nominal'] * $myDataDetail['qty'];
                                             ?>              
                                            <tr>
                                                <td class="py-1">
                                                    <p class="card-text fw-bold mb-25"><?= $myDataDetail['item'] ?></p>
                                                   
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?= $myDataDetail['nominal'] ?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?= $myDataDetail['qty'] ?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?= $subtotal ?></span>
                                                </td>
                                            </tr>

                                          
                                            <?php
                                          $total =+ $subtotal;
                                          }?>
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <td colspan="2"></td>
                                            <td>Total</td>
                                            <td><?= $total ?></td>
                                          </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                          
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- Invoice Description ends -->

                                <hr class="invoice-spacing" />

                                <!-- Invoice Note starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row">
                                        <!-- <div class="col-12">
                                            <span class="fw-bold">Note:</span>
                                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                                projects. Thank You!</span>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                        <!-- /Invoice -->

                        <!-- Invoice Actions -->
                        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                  
                                    <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
                                        Cetak
                                    </button>
                                    <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button>
                                    <a class="btn btn-outline-secondary w-100 mb-75" href="./app-invoice-print.html" target="_blank"> Print </a>
                                    <a class="btn btn-outline-secondary w-100 mb-75" href="./app-invoice-edit.html"> Edit </a>
                                    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
                                        Add Payment
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Actions -->
                    </div>
                </section>

                <!-- Send Invoice Sidebar -->
                <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">
                                    <span class="align-middle">Pilih Metode Pembayaran</span>
                                  
                                </h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" enctype="multipart/form-data">
                                   <div class="mb-1">
                                    <label>Metode Pembayaran</label>
                                        <select class="select2 form-select" name="txtMetodePembayaran" aria-label="Default select example" autocomplete="off" required>
                                          <option value="">Pilih</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Transfer Bank">Transfer Bank</option>
                                          <option value="QRIS">QRIS</option>
                                        </select>
                                   </div>
                                  
                                    <div class="mb-1 d-flex flex-wrap mt-2">
                                      <input type="hidden" name="txtID" value="<?= $myDataDetail['transaction_id'] ?>"> 
                                        <button name="btnSubmit" type=" submit" class="btn btn-primary me-1" data-bs-dismiss="modal">Cetak</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Send Invoice Sidebar -->

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