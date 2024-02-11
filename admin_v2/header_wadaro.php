<!-- Copyright @ 2018 PT. Rentas Media Indonesia (www.rentas.co.id) -->
<!-- Dilarang mengcopy , memperbanyak atau menggunakan source code ini dalam bentuk apapun tanpa izin tertulis dari PT. Rentas Media Indonesia. -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CMS Diginet</title>
  <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/logo/libra3.png">

  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-wysiwyg -->
  <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- FullCalendar -->
  <link href="../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
  <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
  <!-- Cs3 -->
  <link href="../vendors/cs3/css/c3.css" rel="stylesheet" type="text/css">
  <!-- Datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- Add ON -->
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.css" rel="stylesheet">
  <script language="javascript">
    function SelectProduct() {
      window.location = "?page=Product-Add&type=" + document.getElementById('txtType').value;
    }

    function SelectIjin() {
      window.location = "?page=HRD-Ijin-Add&id=" + document.getElementById('txtEmployee').value;
    }

    function SelectWarehouseIN() {
      window.location = "?page=Stock-Adjustment-Add-IN&wh=" + document.getElementById('txtWarehouse').value;
    }

    function SelectWarehouseOUT() {
      window.location = "?page=Stock-Adjustment-Add-OUT&wh=" + document.getElementById('txtWarehouse').value;
    }
  </script>
  <script type="text/javascript">
    function one_click(status) {
      document.getElementByName("btnSubmit").disabled = status;
    }
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-Q92P4JQQ87');
  </script>

</head>



<body class="nav-md">
  <!-- header -->
  <div class="container body">
    <div class="main_container">
      <!--/ header -->



      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img class="round" src="<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?>" alt="avatar" height="40" width="40">

                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="?page=Profile"><i class="fa fa-user pull-right"></i> Profile</a></li>
                  <li><a href="uploads/Rentas_ERP_user_guide.pdf" target="_blank"><i class="fa fa-book pull-right"></i> User Guide</a></li>
                  <li><a href="?page=Help"><i class="fa fa-question-circle pull-right"></i> Help</a></li>
                  <li><a href="?page=Logout"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                </ul>
              </li>
              <!-- approval -->
              <?php
              $Totalall1 = 0;
              // $ses_company = $_SESSION['SES_COMPANY'];
              // if ($_SESSION['SES_GROUP'] == 'PROCUREMENT') {
              //   $mySql   = "SELECT count(*) as totalpr FROM view_purchase_request_approval a WHERE a.approval_user_id='" . $_SESSION['SES_USERID'] . "'  and a.approval_status='Waiting Approval'  
              //    and (select count(*) from view_purchase_request_approval where purchase_id=a.purchase_id and approval_status='Disetujui')>=a.approval_number-1";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalPR  = $myData['totalpr'];

              //   $mySql   = "SELECT count(*) as totalpo FROM view_purchase_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "' and purchase_type='PO' and approval_status='Waiting Approval' ";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalPO  = $myData['totalpo'];

              //   $mySql   = "SELECT count(*) as totalcp FROM view_purchase_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "'  and purchase_type='CP' and approval_status='Waiting Approval' ";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalCP  = $myData['totalcp'];

              //   $mySql   = "SELECT count(*) as totalpb FROM view_receive_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "' and approval_status='Waiting Approval' ";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalPB  = $myData['totalpb'];


              //   $Totalall1 = $TotalPR +  $TotalPO + $TotalCP + $TotalPB;
              // }
              // if ($Totalall1 > 0) {
              ?>

              <!-- /end -->
              <?php
              // }

              // $Totalall = 0;
              // $TotalAPPhrd = 0;
              // $TotalAPPspd = 0;
              // $TotalAPPleave = 0;
              // $TotalAPPovertime = 0;
              // $TotalAPPpermission = 0;
              // $spd = '';
              // $leave = '';
              // $overtime = '';
              // $permission = '';
              // $ses_company = $_SESSION['SES_COMPANY'];
              // if ($_SESSION['SES_GROUP'] == 'HRD') {
              //   $mySql   = "SELECT count(*) as totalapp FROM hrd_approval a WHERE a.approval_user_id='" . $_SESSION['SES_USERID'] . "'  and a.approval_status='Waiting Approval' and a.approval_permission='Yes' ";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalAPPhrd  = $myData['totalapp'];

              // $mySql   = "SELECT count(*) as totalpo FROM view_purchase_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "' and purchase_type='PO' and approval_status='Waiting Approval' ";
              // $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              // $myData = mysqli_fetch_array($myQry);
              // $TotalPO  = $myData['totalpo'];

              // $mySql   = "SELECT count(*) as totalcp FROM view_purchase_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "'  and purchase_type='CP' and approval_status='Waiting Approval' ";
              // $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              // $myData = mysqli_fetch_array($myQry);
              // $TotalCP  = $myData['totalcp'];

              // $mySql   = "SELECT count(*) as totalpb FROM view_receive_approval_active WHERE approval_user_id='" . $_SESSION['SES_USERID'] . "' and approval_status='Waiting Approval' ";
              // $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              // $myData = mysqli_fetch_array($myQry);
              // $TotalPB  = $myData['totalpb'];


              //   $Totalall = $TotalAPPhrd;
              // }


              // if ($_SESSION['SES_GROUP'] == 'Employee') {
              //   $mySql   = "SELECT count(*) as totalapp FROM view_hrd_spd where employee_id='" . $_SESSION['SES_USERID'] . "' and notif='0'";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalAPPspd  = $myData['totalapp'];
              //   $spd  = $myData['totalapp'];

              //   $mySql   = "SELECT count(*) as totalapp FROM view_hrd_leave where employee_id='" . $_SESSION['SES_USERID'] . "' and notif='0'";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalAPPleave  = $myData['totalapp'];
              //   $leave  = $myData['totalapp'];

              //   $mySql   = "SELECT count(*) as totalapp FROM view_hrd_permission where employee_id='" . $_SESSION['SES_USERID'] . "' and notif='0'";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalAPPpermission  = $myData['totalapp'];
              //   $permission  = $myData['totalapp'];

              //   $mySql   = "SELECT count(*) as totalapp FROM view_hrd_overtime where employee_id='" . $_SESSION['SES_USERID'] . "' and notif='0'";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);
              //   $TotalAPPovertime  = $myData['totalapp'];
              //   $overtime  = $myData['totalapp'];

              //   $mySql   = "SELECT *, count(*) as totalapp FROM hrd_employee_sp where employee_id='" . $_SESSION['SES_USERID'] . "' and notif='0'";
              //   $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
              //   $myData = mysqli_fetch_array($myQry);

              //   $TotalAPPsp  = $myData['totalapp'];
              //   $sp  = $myData['totalapp'];
              //   $id = $myData['sp_number'];

              //   $Totalall = $TotalAPPspd + $TotalAPPleave + $TotalAPPovertime + $TotalAPPpermission + $TotalAPPsp;
              // }


              // if ($Totalall > 0) {
              ?>

              <?php
              // } 
              ?>

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->