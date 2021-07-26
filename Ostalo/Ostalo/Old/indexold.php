<?php

if(isset($_GET['error'])) {
	Header('Location: /');
}

if(isset($_GET['test'])) {
	Header('Location: https://pornhub.com/');
}

// Start Session
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Includes
define('allow', true);
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

        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview');
        </script>

        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body>
		<header>
			<a href="../" class="logo text-center">
				<span class="logo-lg-text-light">Stresser</span>
			</a>
			<nav id="cd-top-nav">
				<ul>
					<li><a href="../"><i class="fas fa-home"></i> Home</a></li>
					<li><a href="panel" class="btn btn-primary">Panel</a></li>
				</ul>
			</nav>
			<a id="cd-menu-trigger" class="visible-xs" href="#"><span class="cd-menu-text">Menu</span><span class="cd-menu-icon"></span></a>
		</header>
		<nav id="cd-lateral-nav">
			<ul class="cd-navigation cd-single-item-wrapper">
				<li><a href="../"><i class="fas fa-home"></i> Home</a></li>
				<a href="panel" class="btn btn-primary btn-block">Panel</a>
			</ul>
		</nav>
		<div class="header">
			<div class="container">
				<div class="rows">
					<h1>Stresser</h1>
					<p>Welcome to the Stresser project. This website is not intended to be used for illegal purposes but only as a project and an example of what a stressor looks like. So the panel itself has no function other than having fun making it.</p>
				</div>
			</div> 
		</div>
		
		<section class="plans">
			<div class="container-fluid">
				<div id="owl-demo-2" class="owl-carousel owl-theme">
				
					<?php foreach ($Plan->PlanDataAll()['Response'] as $Pk => $Pv) { ?><div class="panel panel-default">
						<div class="panel-heading">
							<div class="plan-title">
								<i class="fas fa-star fa-<?php echo (int) $Pv['id'] ?>"></i> <?php echo $Secure->SecureTxt($Pv['Name']); ?>
							</div>
							<div class="pricing fa-<?php echo (int) $Pv['id'] ?>">
								<span class="value"><?php echo (int) $Pv['Price']; ?></span>
								<span class="currency">€</span>
							</div>
							<div class="arrow-down"></div>
						</div>
						<div class="panel-body">
							<p><i class="fas fa-location"></i> Plan Length <span class="pull-right">1 Month</span></p>
							<p><i class="far fa-clock"></i>  Boot time <span class="pull-right"><?php echo (int) $Pv['AttackTime']; ?>sec</span></p>
							<p><i class="far fa-chart-network"></i> Concurrent <span class="pull-right"><?php echo (int) $Pv['Concurrent']; ?></span></p>
							<br>
							<p><i class="fas fa-location"></i> Power <span class="pull-right"><?php echo $Pv['Power']; ?> Gbps</span></p>
							<p><i class="fas fa-location"></i> PPS <span class="pull-right"><?php echo $Pv['PPS']; ?></span></p>
							<br>
							<p><i class="fas fa-user-shield"></i> Layer 4 <span class="pull-right"><i class="far fa-<?php if($Pv['L4'] == 1) { echo 'check'; } else { echo 'ban'; } ?>"></i></span></p>
							<p><i class="fas fa-user-shield"></i> Layer 7 <span class="pull-right"><i class="far fa-<?php if($Pv['L7'] == 1) { echo 'check'; } else { echo 'ban'; } ?>"></i></span></p>
						</div>
						<div class="panel-footer">
							<a href="panel" class="btn btn-success btn-block"><i class="far fa-shopping-basket"></i> Order now</a>
						</div>
					</div><?php } ?>

				</div>
			</div>
		</section>

		<div class="features">
			<div class="container">
				<div class="rows">
					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="far fa-user-ninja fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">Try before you buy</h4>
    							<p>Give our free stress testing service a try with strong instant hitting attacks, create an account today.</p>
  							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="far fa-lightbulb-on fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">1000 Gbit/s capacity</h4>
    							<p>With 1000 Gbit/s capacity we have one of the strongest services on the current market with packages to suit everyone.</p>
  							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="far fa-usd-circle fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">Anonymized payment</h4>
    							<p>At <b>Stresser</b> we use Bitcoin payment processor for fast and secure payments to ensure customer privacy and security.</p>
  							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="far fa-crop-alt fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">Unique design</h4>
    							<p>From our custom designed source, to our custom designed DDoS tool we guarantee you will enjoy unique quality we are offering.</p>
  							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="fas fa-puzzle-piece fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">Business Solution</h4>
    							<p>We provide you with best DDoS stress tests on the market since 2015. With thousands of active clients we are here to satisfy even the most power hungry customers.</p>
  							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media">
  							<div class="media-left">
    							<i class="far fa-ticket-alt fa-3x"></i>
  							</div>
  							<div class="media-body">
    							<h4 class="media-heading">Customer Support</h4>
    							<p>Our 24/7 customer support spread on over 3 different continents ensure your tickets being answered in 10-15 minutes. No other IP Stresser / Booter can guarantee this, but we do.</p>
  							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container" id="proof">
			<div class="rows">
				<div class="proof">
					<div class="col-md-12">
						<h1><i class="far fa-medal"></i> Trusted leader of Stressers</h1>
						<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate voluptas consequuntur, possimus corrupti libero recusandae, eligendi quod perspiciatis dolores, repellendus tenetur quo obcaecati sit velit hic aliquid dolore dignissimos similique! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate voluptas consequuntur, possimus corrupti libero recusandae, eligendi quod perspiciatis dolores, repellendus tenetur quo obcaecati sit velit hic aliquid dolore dignissimos similique!</p>
						<button class="btn btn-primary-o">Register Now <i class="far fa-arrow-alt-right"></i></button>
					</div>
				</div>
			</div>
		</div>

		<div class="statistic">
			<div class="container">
				<div class="rows">
					<div class="col-md-3">
						<div class="stats">
							<i class="far fa-users fa-3x"></i>
							<p>Registration</p>
							<span><?php echo $User->UserDataAll()['Count'] + 2856; ?></span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stats">
							<i class="far fa-clock fa-3x"></i>
							<p>Total Tickets</p>
							<span><?php echo $Support->ticketsList()['Count'] + 2068; ?></span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stats">
							<i class="far fa-crosshairs fa-3x"></i>
							<p>Total Boots</p>
							<span><?php echo $ALogs->LogsDataAll()['Count'] + 168500; ?></span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stats">
							<i class="far fa-server fa-3x"></i>
							<p>Online Servers</p>
							<span><?php echo $Api->ApiDataAll()['Count'] + 10; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				<div class="rows">
					<div class="pull-left">
						2020 © Stresser All Rights Reservered.
					</div>
					<div class="pull-right">
						Coded by:
						<a href="https://stresser.pro">Stresser.Pro</a>
					</div>
				</div>
			</div>
		</div>

		<script src="assets/js/jquery-3.2.1.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/owl.slider.js"></script>
	</body>
</html>