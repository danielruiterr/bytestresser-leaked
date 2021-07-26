<?php

if(!defined('allow')) {
    header("HTTP/1.0 404 Not Found");
    die();
}

include_once('inc.php');

if (!($User->IsLoged()) == true) {
    header('Location: login.php');
    die();
}

if($User->UserData()['Expire'] < time() && $User->UserData()['Plan'] != 0 && $User->UserData()['Expire'] > 1) {
      $UserID = $User->UserData()['id'];

		$DataBase->Query("UPDATE `users` SET `Plan`='0', `Expire`='1', `Addons`='0|0|0|0' WHERE `id`=:uID");
		$DataBase->Bind(':uID', $UserID);

		$DataBase->Execute();
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>ByteStresser.com - <?php echo $page; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="ByteStresser is a premium IP Stresser/Booter that features API access, Browser emulation / CAPTCHA bypass for Layer 7 & Unique Layer 4 DDoS attack methods!" name="description" />
      <meta content="top stresser, stressthem, stress them, stress denial of service, dos, stresser app,booter,ip stresser, stresser, booter, ddos tool, ddos attack, ddos attack online, layer7 ddos, layer4 ddos, api, api access, network stresser, network booter, msctf, best Booter, best stresser, strongest stresser, powerful booter, ddoser, ddos, gbooter, top booter, ipstress, booter, stresser, network stresser, network booter, #Booter, STORM, captcha bypass, drdos,ssyn, dns amplification" name="keywords">
      <meta content="ByteStresser" name="author" />
      <meta content="https://bytestresser.com" name="application-url">
      <meta content="ByteStresser" name="application-name">
      <meta content="index, follow" name="robots">
      <meta property="og:title" content="The most advanced IP Booter on the market.">
      <meta property="og:description" content="ByteStresser is a premium IP Stresser/Booter that has browser emulation technology with CAPTCHA bypass for Layer 7 and unique Layer 4 DDoS methods. We provide API access and are always online to stress them all.">
      <meta property="og:image" content="<?php echo $assets; ?>landing/images/bytestresser-og.png">
      <meta property="og:url" content="https://bytestresser.com">
      <meta property="og:type" content="website">
      <link rel="shortcut icon" href="<?php echo $assets ?>assets/images/favicon.ico">
      <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>assets/libs/toastr/build/toastr.min.css">
      <link href="<?php echo $assets ?>assets/css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <link href="<?php echo $assets ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo $assets ?>assets/css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <?php if(!empty($Alert->PrintAlert())) { echo $Alert->PrintAlert(); $Alert->RemoveAlert(); } ?>
      <div id="layout-wrapper">
         <header id="page-topbar">
            <div class="navbar-header">
               <div class="d-flex">
                  <div class="navbar-brand-box">
                     <a href="<?php echo $assets; ?>home" class="logo logo-light">
                     <span class="logo-sm">
                     <img src="<?php echo $assets ?>assets/images/logo.png" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                     <img src="<?php echo $assets ?>assets/images/logo.png" alt="" class="header-brand-img">
                     </span>
                     </a>
                  </div>
                  <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                  <i class="fa fa-fw fa-bars"></i>
                  </button>
               </div>
            </div>
         </header>

         <div class="topnav">
            <div class="container-fluid">
               <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                  <div class="collapse navbar-collapse" id="topnav-menu-content" style="justify-content: center;">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>home" id="topnav-home">
                              <i class="fas fa-home me-2"></i><span key="t-home">Home</span>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>hub" id="topnav-hub">
                              <i class="fas fa-hammer me-2"></i><span key="t-hub">Attack Hub</span>
                           </a>
                        </li>

                        <?php if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { ?>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>#api" id="topnav-api" data-bs-toggle="modal" data-bs-target="#APIFail">
                              <i class="fas fa-code me-2"></i><span key="t-api">API Manager</span>
                           </a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>api" id="topnav-api">
                              <i class="fas fa-code me-2"></i><span key="t-api">API Manager</span>
                           </a>
                        </li>
                        <?php } ?>

                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>deposit" id="topnav-deposit">
                              <i class="far fa-money-bill-alt me-2"></i><span key="t-deposit">Deposit</span>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>shop" id="topnav-shop">
                              <i class="fas fa-shopping-basket me-2"></i><span key="t-shop">Shop</span>
                           </a>
                        </li>

                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-support" role="button">
                           <i class="fas fa-question-circle me-2"></i><span key="t-support">Support</span> <div class="arrow-down"></div>
                           </a>
                           <div class="dropdown-menu" aria-labelledby="topnav-support">
                              <a href="<?php echo $assets; ?>support" class="dropdown-item" key="t-support">Support</a>
                              <a href="<?php echo $assets; ?>helpdesk" class="dropdown-item" key="t-helpdesk">Helpdesk</a>
                              <a href="<?php echo $assets; ?>faq" class="dropdown-item" key="t-faq">FAQ</a>
                           </div>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>profile" id="topnav-profile">
                              <i class="fas fa-user me-2"></i><span key="t-profile">Profile</span>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="<?php echo $assets; ?>logout" id="topnav-logout">
                              <i class="fas fa-sign-out-alt me-2"></i><span key="t-logout">Logout</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
            <?php if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { ?>
            <div id="APIFail" class="modal fade" tabindex="-1" aria-labelledby="APIFailL" style="display: none;" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title mt-0" id="APIFailL">Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <p>No Access<br>
                        Upgrade to premium.</p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
            </div>
            <?php } ?>