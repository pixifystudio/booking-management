    <!-- BEGIN: Header-->

    <nav style='background: #0c24ad;' class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="navbar-brand" href="#"><img style='width:8%' src="../base-app-assets/images/logo/libra4.png"></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i style='color:aliceblue' class="ficon" data-feather="search"></i></a>
                    <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">

                        <div class="search-input">
                            <div class="search-input-icon"><i data-feather="search"></i></div>
                            <input class="form-control input" style="width:75%" type="text" placeholder="Search..." name='cari' tabindex="-1" data-search="search">
                            <button type="hidden" src="?page=Validasi" name="btnCariAdmin"></i></button>
                            <div class="search-input-close"><i data-feather="x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </form>
                </li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i style='color:aliceblue' class="ficon" data-feather="moon"></i></a></li>
                <?php
                $Totalall = 0;
                $TotalExpiry = 0;
                $TotalApproveDig = 0;
                $TotalApprovePhy = 0;
                include_once "library/inc.seslogin.php";
                if ($_SESSION['SES_GROUP'] != 'USER') {
                    $mySql1   = "SELECT count(*) as totalAppr FROM view_document
                    WHERE (document_status='Created' OR document_status='Updated' OR document_status='Request Delete' OR document_status='Reviewed')
                    AND category_level_1 ='DIGITAL'";
                    $myQry1   = mysqli_query($koneksidb, $mySql1)  or die("Error query " . mysqli_error($koneksidb));
                    $myData1 = mysqli_fetch_array($myQry1);
                    $Totalall  = $Totalall + $myData1['totalAppr'];
                    $TotalApproveDig  = $TotalApproveDig + $myData1['totalAppr'];

                    $mySql2   = "SELECT count(*) as totalAppr FROM view_document
                    WHERE (document_status='Created' OR document_status='Updated' OR document_status='Request Delete' OR document_status='Reviewed')
                    AND category_level_1 ='PHYSICAL'";
                    $myQry2   = mysqli_query($koneksidb, $mySql2)  or die("Error query " . mysqli_error($koneksidb));
                    $myData2 = mysqli_fetch_array($myQry2);
                    $Totalall  = $Totalall + $myData2['totalAppr'];
                    $TotalApprovePhy  = $TotalApprovePhy + $myData2['totalAppr'];

                    $mySql2   = "SELECT COUNT(*) as totalExpiry FROM view_document WHERE DATEDIFF(document_expire_date,NOW()) < 30 AND category_level_1='DIGITAL'";
                    $myQry2   = mysqli_query($koneksidb, $mySql2)  or die("Error query " . mysqli_error($koneksidb));
                    $myData2 = mysqli_fetch_array($myQry2);
                    $Totalall  = $Totalall + $myData2['totalExpiry'];
                    $TotalExpiry  = $TotalExpiry + $myData2['totalExpiry'];

                    // $Totalall = $TotalAPPspd + $TotalAPPleave + $TotalAPPovertime + $TotalAPPpermission + $TotalAPPsp;
                }

                // $Totalall = 1;
                if ($Totalall > 0) {
                ?>
                    <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i style='color:aliceblue' class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up"><?php echo $Totalall; ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 style='color:aliceblue' class="notification-title mb-0 me-auto">Notifications</h4>
                                    <div style='color:aliceblue' class="badge rounded-pill badge-light-primary"><?php echo $Totalall; ?> New</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex" href="#">
                                    <?php if ($TotalApproveDig > 1) {
                                    ?> <a class="d-flex" href="?page=Content-Management-Approval&code=Digital">
                                            <div class="list-item d-flex align-items-start">
                                                <div class="list-item-body flex-grow-1">
                                                    <p style='color:red' class="media-heading">Dokument Approval Digital</p><small class="notification-text message"> Anda memiliki <?php echo $TotalApproveDig; ?> Notifikasi baru</small>
                                                </div>
                                            </div>
                                        </a>
                                    <?php }
                                    if ($TotalApprovePhy > 1) {
                                    ?>
                                        <a class="d-flex" href="?page=Content-Management-Approval&code=Physical">
                                            <div class="list-item d-flex align-items-start">
                                                <div class="list-item-body flex-grow-1">
                                                    <p style='color:red' class="media-heading">Dokument Approval Physical</p><small class="notification-text message"> Anda memiliki <?php echo $TotalApprovePhy; ?> Notifikasi baru</small>
                                                </div>
                                            </div>
                                        </a>
                                    <?php }
                                    if ($TotalExpiry > 1) {
                                    ?> <a class="d-flex" href="?page=Content-Management-Expiry">
                                            <div class="list-item d-flex align-items-start">
                                                <div class="list-item-body flex-grow-1">
                                                    <p style='color:red' class="media-heading">Dokument Expiry</p><small class="notification-text message"> Anda memiliki <?php echo $TotalExpiry; ?> Notifikasi baru</small>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                            </li>
                            <li class="dropdown-menu-footer">
                                <h6 style='color:aliceblue' class="fw-bolder me-auto mb-0">Klik pada notifikasi</h6>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span style='color:aliceblue' class="user-name fw-bolder"><?php echo $_SESSION['SES_NAMA']; ?></span>
                            <span style='color:aliceblue' class="user-status"><?php echo $_SESSION['SES_GROUP'] ?></span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="<?php echo "../uploads/user/" . $_SESSION['SES_PHOTO']; ?>" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="?page=Profile"><i class="me-50" data-feather="user"></i> Profile</a>
                        <!-- <a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Inbox</a>
                        <a class="dropdown-item" href="app-todo.html"><i class="me-50" data-feather="check-square"></i> Task</a>
                        <a class="dropdown-item" href="app-chat.html"><i class="me-50" data-feather="message-square"></i> Chats</a> -->
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="uploads/Rentas_ERP_user_guide.pdf" target="_blank"><i class="me-50" data-feather="settings"></i> User Guide</a> -->
                        <!-- <a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Pricing</a> -->
                        <a class="dropdown-item" href="?page=Help"><i class="me-50" data-feather="help-circle"></i> Help</a>
                        <a class="dropdown-item" href="?page=Logout"><i class="me-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header -->