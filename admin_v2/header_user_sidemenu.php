    <!-- BEGIN: Main Menu-->
    <?php
    //matiin Stock Movement
    // $ygMati = $_SESSION['SES_BRANCH'];
    //$mati = 'Depo Sunter';
    $mati = '';
    ?>

    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto">
                        <img src="" style="height:45px!important">
                    </li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">


                    <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="codesandbox"></i>Dashboard</a>
                        <ul class="dropdown-menu" data-bs-popper="none">

                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="chevrons-right"></i>Library</a>

                                <ul class="dropdown-menu" data-bs-popper="none">
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="?page=Company" data-bs-toggle=""><i data-feather="circle"></i>Status</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                    <li class="dropdown nav-item" data-menu="dropdown"><a class=" nav-link d-flex align-items-center" href="?page=Main-User"><i data-feather="home"></i><?php echo _HOME ?></a>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class=" nav-link d-flex align-items-center" href="?page=Buku-Fisik"><i data-feather="book"></i><?php echo _PHYSICAL ?></a>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class=" nav-link d-flex align-items-center" href="?page=Buku-Digital"><i data-feather="smartphone"></i><?php echo _DIGITAL ?></a>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class=" nav-link d-flex align-items-center" href="?page=Information-User"><i data-feather="globe"></i><?php echo _INFORMATION ?></a>

                </ul>
                </li>
                </ul>

            </div>
        </div>
    </div>
    <!-- END: Main Menu-->