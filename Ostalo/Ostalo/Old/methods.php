<?php

// Start Session
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Includes
define('allow', true);
define('before', true);
include_once('includes.php');

?>

<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <title>Stresser.Pro - The best IP Stresser / Booter, free services !</title>

        <meta name="description" content="Stresser.pro is the best free ip stresser, We also provide premium ip booter services." />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="all,follow" />
        <meta itemprop="name" content="Stresser" />
        <meta itemprop="url" content="https://stresser.pro" />
        <meta name="keywords" content="ip stresser, booter, stresser, ip booter, free ip stresser, free ip booter, free stresser" />
        <meta name="distribution" content="global" />
        <meta name="audience" content="all" />
        <meta name="author" content="Stresser.Pro" />
        <meta rel="sitemap" type="application/xml" content="sitemap.xml" />

        <meta property="og:site_name" content="Stresser" />
        <meta property="og:site" content="https://stresser.pro" />
        <meta property="og:title" content="Stresser">
        <meta property="og:description" content="Stresser.pro is the best free ip stresser, We also provide premium ip booter services." />
        <meta property="og:image" content="assets/images/og.png" />
        <meta property="og:url" content="https://stresser.pro" />
        <meta property="og:type" content="website" />

        <!-- Google Analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview');
        </script>

        <!-- App favicon -->
        <link rel="shortcut icon" href="source/assets/images/favicon.ico">

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body>
		<!-- Navigation -->
		<header>
			<a href="home" class="logo text-center">
				<span class="logo-lg-text-light">Stresser</span>
			</a>
			<nav id="cd-top-nav">
				<ul>
					<li><a href="home"><i class="fas fa-home"></i> Home</a></li>
					<li><a href="https://t.me/warzonet0"><i class="fas fa-headset"></i> Live Support</a></li>
					<li><a href="panel" class="btn btn-primary">Hub</a></li>
				</ul>
			</nav>
			<a id="cd-menu-trigger" class="visible-xs" href="#"><span class="cd-menu-text">Menu</span><span class="cd-menu-icon"></span></a>
		</header>
		<nav id="cd-lateral-nav">
			<ul class="cd-navigation cd-single-item-wrapper">
				<li><a href="home"><i class="fas fa-home"></i> Home</a></li>
				<li><a href="https://t.me/warzonet0"><i class="fas fa-headset"></i> Live Support</a></li>
				<a href="panel" class="btn btn-primary btn-block">Hub</a>
			</ul>
		</nav>
		<div class="header">
			<div class="container">
				<div class="rows">
					<h1>Stresser</h1>
					<table class="table" style="color:#fff">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Layer</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $K => $V) { ?>
                            <tr>
                                <td><?php echo $Secure->SecureTxt($V['name']); ?></td>
                                <td><?php echo $Secure->SecureTxt($V['layer']); ?></td>
                                <td><?php echo $Secure->SecureTxt($V['id']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
				</div>
			</div> 
		</div>
		<div class=footer>
			<div class="container">
				<div class="rows">
					<div class="pull-left">
						2020 © Stresser All Rights Reservered.
					</div>
					<div class="pull-right">
						Powered by:
						<a href="">WarZone</a> Team
					</div>
				</div>
			</div>
		</div>
		
		<!-- JavaScript -->
		<script src="assets/js/jquery-3.2.1.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/owl.slider.js"></script>
	</body>
</html>