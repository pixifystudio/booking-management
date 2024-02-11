<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";

?>

<body class="login vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" style=" background:url(../../uploads/wallpaper.jpg);" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

  <div class="app-content content ">
    <?php
    // $tgl             = date('Y-m-d H:i:s');
    $ses_nama = $_SESSION['SES_NAMA'];
    $pesanError = array();
    $info = "";
    $info = @$_GET['info'];
    $msg = @$_GET['msg'];
    if ($info != "")
      $pesanError[] = $info;


    # Tombol Submit diklik
    if (isset($_POST['btnSubmit'])) {
      $pesanError = array();

      function autofalse()
      {
        global $koneksidb;
        mysqli_autocommit($koneksidb, FALSE);
      }
      function commit()
      {
        global $koneksidb;
        mysqli_commit($koneksidb);
      }
      function rollback()
      {
        global $koneksidb;
        mysqli_rollback($koneksidb);
      }

      # BACA DATA DALAM FORM, masukkan datake variabel
      $tgl                = date('Y-m-d');
      $dataCode           = buatNomorNew("stock_order", "", $tgl, 'IN');
      $dataUser       = $_POST['txtUser'];
      $dataDocument         = $_POST['txtDocument'];
      $dataDateOut         = $_POST['txtDateOut'];
      $dataDateIn         = $_POST['txtDateIn'];




      try {
        autofalse();
        $ses_nama = $_SESSION['SES_NAMA'];

        $dataQry = mysqli_query($koneksidb, "SELECT d.document_id,d.racking_id from document d where d.racking_id is not null");
        if (!$dataQry)
          throw new Exception("Form gagal diinput. code:fp01. " . mysqli_error($koneksidb));
        $dataRow = mysqli_fetch_array($dataQry);
        $dataRacking = $dataRow['racking_id'];

        $mySql   = "INSERT INTO stock_order 
      (stock_order_id, stock_order_reference, stock_order_reference_id, stock_order_status, stock_order_date, warehouse_id, stock_order_for, stock_order_note, date_out, date_in, updated_by, updated_date)
      VALUES 
      ('$dataCode','RETURNING','$dataUser','IN','$tgl','1','$dataDocument', '$dataUser | $dataDocument','$dataDateOut', '$dataDateIn', '$ses_nama',now())";
        $myQry3 = mysqli_query($koneksidb, $mySql);
        if (!$myQry3)
          throw new Exception("Form gagal diinput. code:fp01. " . mysqli_error($koneksidb));

        $mySql      = "INSERT INTO stock (stock_order_id, stock_status, stock_date, product_id, qty, stock_note, racking_id, 
          warehouse_id, updated_by, updated_date)
          VALUES ('$dataCode', 'IN',NOW(),'$dataDocument','1','RETURNING : $dataUser | $dataDocument','$dataRacking','1','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql);
        if (!$myQry)
          throw new Exception("Form gagal diinput. code:fp01. " . mysqli_error($koneksidb));

        commit();
        // exit;
        echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Physical-Return&msg=add&code=" . $dataCode . "'>";
        // $msg = 'add';
      } catch (Exception $e) {
        rollback();
        // echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Physical-Return&id=" . $dataCode . "&msg=add'>";
        $pesanError[] =  $e->getMessage();
        // echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Physical-Return&id=" . $dataCode . "&status=" . $dataStatus . "&info=" . $e->getMessage() . "'>";
        // $msg = 'Failed';
        // echo "asu" . $e->getMessage();
      }
      // exit;
    }

    $date =  date('Y-m-d');
    $date1 = str_replace('-', '/', $date);
    $tomorrow = date('Y-m-d', strtotime($date1 . "+3 days"));
    ?>
    <!-- BEGIN: Content-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
        <div class="content-header row">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <a href="?page=Main">
                  <h2 class="content-header-title float-start mb-0">Physical Book</h2>
                  <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active"><a>Returning Book</a>
                      </li>
                    </ol>
                  </div>
              </div>
            </div>
          </div>
          <?php if ($msg != "") { ?>
            <div class="alert alert-primary" role="alert">
              <h4 class="alert-heading">Sukses!</h4>
              <div class="alert-body">
                <?php if ($msg == "add") echo "<p>Tambah " . $_GET['code'] . " data berhasil</p>";
                elseif ($msg == "failed") echo "<p>Edit data berhasil</p>";
                elseif ($msg == "Delete") echo "<p>Delete data berhasil</p>"; ?>
              </div>
            </div>
          <?php } ?>
          <?php if (count($pesanError) >= 1) { ?>
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">Danger</h4>
              <div class="alert-body">
                <?php
                $noPesan = 0;
                foreach ($pesanError as $indeks => $pesan_tampil) {
                  $noPesan++;
                  echo "<p>$noPesan. $pesan_tampil</p>";
                }
                ?>
              </div>
            </div>
          <?php } ?>
        </div>

        <!-- BEGIN: Content-->

        <div class="row match-height">
          <!-- Revenue Report Card -->
          <div class="col-lg-2 col-12">
          </div>
          <div class="col-lg-8 col-12">
            <div class="card card-revenue-budget">
              <div class="row mx-0">
                <div class="col-md-12 col-12 budget-wrapper">

                  <h2 class="mb-25">Returning Form</h2>
                  <br>
                  <div class="mb-1 mt-75">
                    <label class="form-label" for="basicInput">User ID</label>
                    <input type="text" class="form-control" name="txtUser" id="basicInput" placeholder="User ID" />
                  </div>
                  <br>
                  <div class="mb-1 mt-75">
                    <label class="form-label" for="basicInput">Book Title</label>
                    <input type="text" class="form-control" name="txtDocument" id="basicInput" placeholder="Book Title" />
                  </div>
                  <br>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class="mb-1 mt-75">
                        <label class="form-label" for="basicInput">Borrowing Date</label>
                        <input id="tanggal" autocomplete="off" class="dapick form-control" placeholder="YYYY-MM-DD" name="txtDateOut" type="text" value="<?php echo $date; ?>" maxlength="20" required="required" autocomplete="off" />
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class="mb-1 mt-75">
                        <label class="form-label" for="basicInput">Returning Date</label>
                        <input id="tanggal" autocomplete="off" class="dapick form-control" placeholder="YYYY-MM-DD" name="txtDateIn" type="text" value="<?php echo $tomorrow; ?>" maxlength="20" required="required" autocomplete="off" />
                      </div>
                    </div>
                  </div>

                  <br>
                  <button type="submit" name="btnSubmit" class="btn btn-primary" style="width:100%">Proceed</button>

                </div>
              </div>
            </div>
          </div>
          <!--/ Revenue Report Card -->


        </div>
        <!-- END: Content-->

      </form>
    </div>
  </div>
  <!-- END: Content-->
  <?php include "footer_difan.php"; ?>
  <script src="js_new/footer_default.js"></script>

</body>

</html>