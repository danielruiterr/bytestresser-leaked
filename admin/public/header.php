<?php

if(!defined('allow')) {
    header("HTTP/1.0 404 Not Found");
}

define('admin', TRUE);

include_once('../inc.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->ASaveAlert('First Login.', 'error');
  header('Location: login.php');
  die();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

        <title>ByteStresser</title>

        <!-- third party css -->
        <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<?php if(@$db == true) { ?>
        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <?php } ?>
		<?php if(@$userdb == true) { ?>
        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <?php } ?>
    </head>
    <body>
    <?php if(!empty($Alert->APrintAlert())) { echo $Alert->APrintAlert(); $Alert->RemoveAlert(); } ?>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                            <span class="logo-lg-text-light">ByteStresser</span>
                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="40">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="index.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Home </span>
                                </a>
                            </li>

                            <li>
                                <a href="ticket_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Tickets </span>
                                </a>
                            </li>
                            
                            <?php if($Admin->AdminData()['Type'] > 0) { ?>
                            
                            <li>
                                <a href="news_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> News </span>
                                </a>
                            </li>

                            <li>
                                <a href="blacklist_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> BlackList </span>
                                </a>
                            </li>
                            
                            <?php } if($Admin->AdminData()['Type'] == 2) { ?>

                            <li>
                                <a href="method_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Methods </span>
                                </a>
                            </li>

                            <li>
                                <a href="plan_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Plans </span>
                                </a>
                            </li>

                            <li>
                                <a href="api_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> API </span>
                                </a>
                            </li>

                            <?php } if($Admin->AdminData()['Type'] > 0) { ?>

                            <li class="menu-title">Logs</li>

                            <?php } if($Admin->AdminData()['Type'] == 2) { ?>

                            <li>
                                <a href="logs_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Logs </span>
                                </a>
                            </li>

                            <?php } if($Admin->AdminData()['Type'] > 0) { ?>

                            <li>
                                <a href="attack_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Attack Logs </span>
                                </a>
                            </li>

                            <?php } if($Admin->AdminData()['Type'] == 2) { ?>

                            <li>
                                <a href="payment_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Payment Logs </span>
                                </a>
                            </li>

                            <li class="menu-title">Account</li>

                            <li>
                                <a href="user_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Users </span>
                                </a>
                            </li>

                            <li>
                                <a href="usersapi_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> API Access </span>
                                </a>
                            </li>

                            <li>
                                <a href="admin_list.php">
                                    <i class="la la-dashboard"></i>
                                    <span> Admins </span>
                                </a>
                            </li>

                            <?php } ?>

                            <li>
                                <a href="logout.php">
                                    <i class="la la-sign-out"></i>
                                    <span> Logout </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->