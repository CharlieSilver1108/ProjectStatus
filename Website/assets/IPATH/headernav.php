<!-- This is called from IPATH at the top of each webpage as my header -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css?version=55" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<style>
    body{
      overflow-y: auto !important;
    }
    body::-webkit-scrollbar {
        width: 8px;               /* width of the entire scrollbar */
    }

    body::-webkit-scrollbar-track {
        background: none;        /* color of the tracking area */
    }

    body::-webkit-scrollbar-thumb {
        background-color: #343a40;    /* color of the scroll thumb */
        border-radius: 20px;       /* roundness of the scroll thumb */
        border: 3px;  /* creates padding around scroll thumb */
    }
    
    ::-webkit-scrollbar {
        width: 8px;               /* width of the entire scrollbar */
    }

    ::-webkit-scrollbar-track {
        background: none;        /* color of the tracking area */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #522a5b;    /* color of the scroll thumb */
        border-radius: 20px;       /* roundness of the scroll thumb */
        border: 3px;  /* creates padding around scroll thumb */
    }
</style>

<?php 
    function redirect($url){    #This function is used to redirect the user throughout the website
        ob_start();
        header('Location: '. $url);
        ob_end_flush();
        die();
    }

    session_start();    #This is an authorisation check
    if (empty($_SESSION['username'])){ #If the user has signed in using login.php then $_SESSION['username'] will be set to their username
        $username = "Unknown Account";
        redirect("login.php");
    } else{
        $username = $_SESSION['username'];
        $access = $_SESSION['access']; #This assigns whether the current user is an admin-user or staff-user
    }
?>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark highcliffe">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.php"><img src="assets/img/highcliffelogo.png" class="img-fluid max-width:100% height: auto"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-search" style="background: #343A40 !important; color: #ffffff !important;" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</body>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Core</div>

                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-first-aid"></i></div>
                            Fire
                        </a>

                    <div class="sb-sidenav-menu-heading" <?php if ($access==="S"){?>style="display:none"<?php } ?>>Accounts</div> <!--Only shows these choices if signed in as an administrator-->
                    
                        <a class="nav-link " href="studentAccounts.php" <?php if ($access==="S"){?>style="display:none"<?php } ?>>
                            <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                                Student Accounts
                        </a>
                        <a class="nav-link" href="staffAccounts.php" <?php if ($access==="S"){?>style="display:none"<?php } ?>>
                            <div class="sb-nav-link-icon"><i class="far fa-address-card"></i></div>
                                Staff Accounts
                        </a>
                           

                    <div class="sb-sidenav-menu-heading">Statuses</div>

                        <a class="nav-link" href="students.php?show=1">
                            <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                            Student Statuses
                        </a>


                        <a class="nav-link" href="statushistory.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                            Status History
                        </a>

                        <a class="nav-link" href="updateStatus.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                            Update Student Status
                        </a>

                    <div class="sb-sidenav-menu-heading" <?php if ($access==="S"){?>style="display:none"<?php } ?>>Admin</div> <!-- Only shows these choices if signed in as administrator-->

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts" <?php if ($access==="S"){?>style="display:none"<?php } ?>>
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages" <?php if ($access==="S"){?>style="display:none"<?php } ?>>
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.php">Login</a>
                                        <a class="nav-link" href="createaccount.html">Create Account</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                    
                </div>
            </div>

            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php echo $username; ?> <!-- Displays who the user is logged in as -->
            </div>
        </nav>
    </div>
