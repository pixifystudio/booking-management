    <!-- BEGIN: Main Menu-->
    <?php
    //matiin Stock Movement
    // $ygMati = $_SESSION['SES_BRANCH'];
    //$mati = 'Depo Sunter';
    $mati = '';
    ?>



    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto">
                        <img src="../base-app-assets/images/logo/libra3.png" style="height:45px!important">
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

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="layers"></i>Dashboard</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item xx" href="?page=Main" data-bs-toggle="">Dashboard</a>
                            <a class="dropdown-item xx" href="?page=Main-Digital" data-bs-toggle="">Leadarboard User</a>
                            <!-- <a class="dropdown-item" href="?page=Information" data-bs-toggle="">Information, News & Article</a> -->
                        </ul>
                    </li>

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="database"></i>Digital Content Management</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Content-Categories&code=Digital" data-bs-toggle="">Content Categories Management</a>
                            <a class="dropdown-item" href="?page=Content-Management-Digital" data-bs-toggle="">Content Management</a>
                            <a class="dropdown-item" href="?page=Content-Management-Approval&code=Digital" data-bs-toggle="">Content Approval Processing</a>
                            <a class="dropdown-item" href="?page=Content-Management-Access" data-bs-toggle="">Content Previleges Management</a>
                            <a class="dropdown-item" href="?page=Content-Management-Expiry" data-bs-toggle="">Content Expiration Management</a>
                            <!-- <a class="dropdown-item" href="?page=Book-Management-Digital" data-bs-toggle="">Populer Content Generator</a> -->
                        </ul>
                    </li>

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="database"></i>Education Asset Management</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Content-Categories&code=Physical" data-bs-toggle="">Education Asset Categories Management</a>
                            <a class="dropdown-item" href="?page=Asset-Management-Physical" data-bs-toggle="">Education Asset Management</a>
                            <a class="dropdown-item" href="?page=Content-Management-Approval&code=Physical" data-bs-toggle="">Education Asset Approval Processing</a>
                            <a class="dropdown-item" href="?page=Bookshelf" data-bs-toggle="">Education Asset Location Management</a>

                            <a class="dropdown-item" href="?page=Asset-Management-Physical-Borrow" data-bs-toggle="">Education Asset Borrowing Process</a>
                            <a class="dropdown-item" href="?page=Asset-Management-Physical-Return" data-bs-toggle="">Education Asset Returning Process</a>
                            <a class="dropdown-item" href="?page=Asset-Management-Physical-Stock" data-bs-toggle="">Education Asset Inventory</a>
                            <a class="dropdown-item" href="?page=Asset-Management-Physical-Stock-Trans" data-bs-toggle="">Education Asset Borrowing History</a>
                        </ul>
                    </li>

                    <!-- =================================================================================================================================== -->

                    <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="database"></i>Master Data</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Content-Categories" data-bs-toggle="">Book Categories</a>
                            <a class="dropdown-item" href="?page=Bookshelf" data-bs-toggle="">Bookshelf</a>
                        </ul>
                    </li> -->

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="users"></i>User Management</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Organization" data-bs-toggle="">Organization Management</a>
                            <a class="dropdown-item" href="?page=Position" data-bs-toggle="">Position Management</a>
                            <a class="dropdown-item" href="?page=Role-Permission" data-bs-toggle="">Role Permission</a>
                            <a class="dropdown-item" href="?page=Management-Admin" data-bs-toggle="">Admin Management</a>
                            <a class="dropdown-item" href="?page=Management-User" data-bs-toggle="">User Management</a>
                            <a class="dropdown-item" href="?page=Management-Reward" data-bs-toggle="">Reward & Bages Management</a>
                        </ul>
                    </li>

                    <!-- <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="airplay"></i>Library Visitor</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Guest-Book" data-bs-toggle="">Guest Book</a>
                            <a class="dropdown-item" href="?page=Report-Visitor" data-bs-toggle="">Report</a>
                        </ul>
                    </li> -->

                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="book"></i>Report</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Activity-User" data-bs-toggle="">User Activity</a>
                            <a class="dropdown-item" href="?page=Asset-History" data-bs-toggle="">Content History</a>
                            <a class="dropdown-item" href="?page=Asset-Stock" data-bs-toggle="">Inventory Asset</a>
                        </ul>
                    </li>
                    <!-- 
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="book"></i>Physical Book</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Book-Management-Physical" data-bs-toggle="">Book List</a>
                            <a class="dropdown-item" href="?page=Book-Management-Physical-Borrow" data-bs-toggle="">Borrowing Book</a>
                            <a class="dropdown-item" href="?page=Book-Management-Physical-Return" data-bs-toggle="">Returning Book</a>
                            <a class="dropdown-item" href="?page=Book-Management-Physical-Stock" data-bs-toggle="">Book Stock Management</a>
                            <a class="dropdown-item" href="?page=Book-Management-Physical-Stock-Trans" data-bs-toggle="">Borrowing Book History</a>
                        </ul>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="smartphone"></i>Digital Book</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Book-Management-Digital" data-bs-toggle="">Book List</a>
                        </ul>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown"><i data-feather="smartphone"></i>Book Management</a>
                        <ul class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="?page=Book-Management-Approval" data-bs-toggle="">Approval</a>
                            <a class="dropdown-item" href="?page=Book-Management-Access" data-bs-toggle="">Access</a>
                            <a class="dropdown-item" href="?page=Book-Management-Expiry" data-bs-toggle="">Expiry</a>
                        </ul>
                    </li>
                </ul> -->

            </div>
        </div>
    </div>
    <!-- END: Main Menu-->