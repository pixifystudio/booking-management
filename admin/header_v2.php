<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Self Studio - <?= $_SESSION['SES_TITLE'] ?></title>

    <link rel="apple-touch-icon" href="../app-assets/images/logo/logo-sf.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/logo/logo-sf.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/extensions/keyTable.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/pickers/bootstrap-datepicker/datepicker.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/horizontal-menu.css">

    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/editors/quill/quill.snow.css">


    <!-- <link rel="stylesheet" type="text/css" href="../app-assets/css/bz-core.css"> -->
    <!-- END: Page CSS-->


    <!-- BEGIN: Vendor JS-->
    <!-- <script src="../app-assets/vendors/js/vendors.min.js"></script> -->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <!-- <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script> -->
</head>

<!-- <body class="horizontal-layout horizontal-menu navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col=""> -->
<?php
include "language.php";
?>

<body class="horizontal-layout horizontal-menu navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col=""> -->
    <?php include 'header_top.php'; ?>
    <?php include 'header_sidemenu.php'; ?>