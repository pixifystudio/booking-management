<?php
$_SESSION['SES_TITLE'] = "Management Admin";
include_once "library/inc.seslogin.php";
include "header_v2.php";

$_SESSION['SES_PAGE'] = "?page=Management Admin";

// ambil data 

 $mySql   = "SELECT dd.*, d.updated_date as tanggal_transaksi FROM data_qr_detail dd left join data_qr d on (d.transaction_id = dd.transaction_id) where dd.transaction_id='$id'  order by dd.id asc";
                $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
                $nomor  = 0;
             $myData = mysqli_fetch_array($myQry);
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
                                            <td>Total</td>
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
                                        <div class="col-12">
                                            <span class="fw-bold">Note:</span>
                                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                                projects. Thank You!</span>
                                        </div>
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
                                        Send Invoice
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
                                    <span class="align-middle">Send Invoice</span>
                                </h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <form>
                                    <div class="mb-1">
                                        <label for="invoice-from" class="form-label">From</label>
                                        <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com" placeholder="company@email.com" />
                                    </div>
                                    <div class="mb-1">
                                        <label for="invoice-to" class="form-label">To</label>
                                        <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com" placeholder="company@email.com" />
                                    </div>
                                    <div class="mb-1">
                                        <label for="invoice-subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="invoice-subject" value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                                    </div>
                                    <div class="mb-1">
                                        <label for="invoice-message" class="form-label">Message</label>
                                        <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="11" placeholder="Message...">
Dear Queen Consolidated,

Thank you for your business, always a pleasure to work with you!

We have generated a new invoice in the amount of $95.59

We would appreciate payment of this invoice by 05/11/2019</textarea>
                                    </div>
                                    <div class="mb-1">
                                        <span class="badge badge-light-primary">
                                            <i data-feather="link" class="me-25"></i>
                                            <span class="align-middle">Invoice Attached</span>
                                        </span>
                                    </div>
                                    <div class="mb-1 d-flex flex-wrap mt-2">
                                        <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Send Invoice Sidebar -->

                <!-- Add Payment Sidebar -->
                <div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">
                                    <span class="align-middle">Add Payment</span>
                                </h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <form>
                                    <div class="mb-1">
                                        <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="amount">Payment Amount</label>
                                        <input id="amount" class="form-control" type="number" placeholder="$1000" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="payment-date">Payment Date</label>
                                        <input id="payment-date" class="form-control date-picker" type="text" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="payment-method">Payment Method</label>
                                        <select class="form-select" id="payment-method">
                                            <option value="" selected disabled>Select payment method</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Debit">Debit</option>
                                            <option value="Credit">Credit</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="payment-note">Internal Payment Note</label>
                                        <textarea class="form-control" id="payment-note" rows="5" placeholder="Internal Payment Note"></textarea>
                                    </div>
                                    <div class="d-flex flex-wrap mb-0">
                                        <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Add Payment Sidebar -->

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