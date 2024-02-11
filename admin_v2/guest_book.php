<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";

?>

<body class="login vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

  <div class="app-content content ">
    <?php
    // $tgl             = date('Y-m-d H:i:s');
    $ses_nama = $_SESSION['SES_NAMA'];

    if (isset($_POST['btnSubmit'])) {
      $dataUser  = $_POST['txtUser'];

      $dataKode      = 'Smart Perpus';
      $dataUser      = isset($_POST['txtUser']) ?  $_POST['txtUser'] : '';
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


      try {
        autofalse();
        $mySql    = "SELECT user_fullname from master_user WHERE `user_id`='$dataUser'";
        $myQry    = mysqli_query($koneksidb, $mySql);
        $myData = mysqli_fetch_array($myQry);
        if (mysqli_num_rows($myQry) < 1)
          throw new Exception("Data " . $dataUser . " tidak ditemukan");


        $dataName = isset($myData['user_fullname']) ? $myData['user_fullname'] : "";

        $mySql    = "INSERT INTO check_in (`user_id`,date_in, `location`, updated_date, updated_by)
    value ('$dataUser',now(),'$dataKode',now(),'$dataName')";
        $myQry    = mysqli_query($koneksidb, $mySql);
        if (!$myQry)
          throw new Exception("gagal diinput. " . $myData['user_fullname'] . ' ' . mysqli_error($koneksidb));
        commit();
        echo "<meta http-equiv='refresh' content='0; url=?page=Guest-Book&msg=add'>";
      } catch (Exception $e) {
        rollback();
        echo "<meta http-equiv='refresh' content='0; url=?page=Guest-Book&msg=failed&info=" . $e->getMessage() . "'>";
        // echo $e->getMessage();
      }
      exit;
    }
    $msg = @$_GET['msg']; ?>
    <!-- BEGIN: Content-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-start mb-0">LIBRARY VISITOR</h2>
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a>Guest Book</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- BEGIN: Content-->
      <?php if ($msg != "") { ?>

        <?php if ($msg == "add") echo "<div class='alert alert-primary' role='alert'> <h4 class='alert-heading'>Sukses!</h4>";
        elseif ($msg == "failed") echo "<div class='alert alert-danger' role='alert'> <h4 class='alert-heading'>Failed!</h4></p>"; ?>
        <div class="alert-body">
          <?php if ($msg == "add") echo "<p>Tambah data berhasil</p>";
          elseif ($msg == "failed") echo "<p>" . $_GET['info'] . "</p>";
          elseif ($msg == "Delete") echo "<p>Delete data berhasil</p>"; ?>
        </div>
    </div>
  <?php } ?>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <div class="row match-height">
      <!-- Revenue Report Card -->
      <div class="col-lg-2 col-12">
      </div>
      <div class="col-lg-8 col-12">
        <div class="card card-revenue-budget">
          <div class="row mx-0">
            <div class="col-md-8 col-12 budget-wrapper">

              <h2 class="mb-25">Guest Book</h2>
              <br>
              <br>
              <div class="mb-1 mt-75">
                <label class="form-label" for="basicInput">User ID</label>
                <input type="text" class="form-control" name="txtUser" id="basicInput" placeholder="User ID" />
              </div>
              <br>
              <br>
              <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>

            </div>
            <div class="col-md-4 col-12 budget-wrapper">
              <div class='ml-75'>
                <img src="../uploads/qr-code.png" style="width:100%" class="ml-10" />
              </div>
              <h2 class="mb-25">Check in with QR Code</h2>
              <br>
              <h4 class="mb-25">Scan this QR Code using E-Library application</h4>


              <a href="../uploads/qr-code.png" class="btn btn-outline-secondary"><i data-feather='printer'></i> Print QR Code</a>


            </div>
          </div>
        </div>
      </div>
      <!--/ Revenue Report Card -->
    </div>
  </form>
  <!-- END: Content-->


  <!-- BEGIN: Vendor JS-->
  <script src="../app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <script src="../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="../app-assets/js/core/app-menu.js"></script>
  <script src="../app-assets/js/core/app.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  <script src="../app-assets/js/scripts/pages/auth-login.js"></script>
  <!-- END: Page JS-->

  <script>
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })
  </script>
</body>
</form>
</div>
</div>
<!-- END: Content-->
<?php include "footer_difan.php"; ?>
<script>
  $(document).ready(function() {

  });

  var options = {
    series: [{
      name: '',
      data: [44, 55, 57, 56, 61, 58, 63],
      style: {
        colors: ['#F4CF0D', '#E2C219']
      }
    }, {
      name: '',
      data: [76, 85, 101, 98, 87, 105, 91],
      style: {
        colors: ['#F4CF0D', '#E2C219']
      }

    }, ],
    chart: {
      type: 'bar',
      height: 350
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'

      },
    },
    dataLabels: {
      enabled: false,
      style: {
        colors: ['#F4CF0D', '#E2C219']
      }
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    },
    yaxis: {
      title: {
        text: ''
      }
    },
    fill: {
      opacity: 1,
      colors: ['#F4CF0D', '#E2C219'],
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return "" + val + " Books"
        }
      }
    }
  };

  // var chart = new ApexCharts(document.querySelector("#chart"), options);
  // chart.render();




  // Line



  var options = {
    series: [{
      name: "Visitors",
      data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
    }],
    chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight',
      colors: ['#8f1313'], // takes an array which will be repeated on columns
    },
    title: {
      text: '',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    }
  };

  // var chart = new ApexCharts(document.querySelector("#chart-line"), options);
  // chart.render();
</script>
</body>

</html>