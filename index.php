<?php

define('allow', true);

include_once('inc.php');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>ByteStresser.com | #1 Stresser on Market</title>
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
        <link rel="shortcut icon" href="<?php echo $assets; ?>landing/images/favicon.ico">
        <link rel="stylesheet" href="<?php echo $assets; ?>landing/libs/owl.carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo $assets; ?>landing/libs/owl.carousel/assets/owl.theme.default.min.css">
        <link href="<?php echo $assets; ?>landing/css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo $assets; ?>landing/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $assets; ?>landing/css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>
    <body data-bs-spy="scroll" data-bs-target="#topnav-menu" data-bs-offset="60">
        <nav class="navbar navbar-expand-lg navigation fixed-top sticky">
            <div class="container">
                <a class="navbar-logo" href="<?php echo $assets; ?>">
                    <img src="<?php echo $assets; ?>landing/images/logo.png" alt="" height="60" class="logo logo-light">
                </a>
                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#statistics">Statistics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pricing">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                    </ul>
                    <div class="my-2 ms-lg-2">
                        <a href="<?php echo $assets; ?>login" class="btn btn-outline-primary w-xs">Login</a>
                    </div>
                    <div class="my-2 ms-lg-2">
                        <a href="<?php echo $assets; ?>register" class="btn btn-outline-primary w-xs">Register</a>
                    </div>
                </div>
            </div>
        </nav>
        <section class="section hero-section bg-ico-hero" id="home">
            <div class="bg-overlay"></div>
            <div class="container" id="statistics">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="text-white-50">
                            <h1 class="text-white font-weight-semibold mb-3 hero-title">WORLDS BEST IP STRESSER ON THE MARKET</h1>
                            <p class="font-size-14">Leading professional DDoS tool for individual customers and an API provider for ip stressers/booters and DDoS-services.<br><br>Our support is ready to help you with any issue round the clock.</p>
                            <div class="button-items mt-4">
                                <a href="<?php echo $assets; ?>home" class="btn btn-primary">Attack Hub</a>
                                <a href="#pricing" class="btn btn-light">View Plans</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-8 col-sm-10 ms-lg-auto">
                        <img src="<?php echo $assets; ?>landing/images/logo-light.png" alt="" height="100" class="logo logo-light">
                    </div>
                </div>
            </div>
        </section>
        <section class="p-0 statistics">
            <div class="container">
                <div class="currency-price">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted">Total Clients</p>
                                            <h5><?php echo (int) $User->UserDataAll()['Count']; ?></h5>
                                        </div>
                                        <div class="avatar-xs me-4">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-account-multiple-plus card-custom-icon icon-dropshadow-info font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted">Total Online Boots</p>
                                            <h5><?php echo (int) $ALogs->LogsDataRunning()['Count']; ?></h5>
                                        </div>
                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="mdi mdi-alarm-check card-custom-icon icon-dropshadow-secondary font-size-24"></i>
                                            </span>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted">Total Boots</p>
                                            <h5><?php echo (int) $ALogs->LogsDataAll()['Count']; ?></h5>
                                        </div>
                                        <div class="avatar-xs me-4">
                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="mdi mdi-alarm card-custom-icon icon-dropshadow-warning font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section" id="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <div class="small-title">Features</div>
                            <h4>Choose us</h4>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center pt-4">
                    <div class="col-md-6 col-sm-8">
                        <div class="mt-4 mt-md-auto">
                            <div class="d-flex align-items-center mb-2">
                                <h4 class="mb-0">SECURE</h4>
                            </div>
                            <p class="text-muted">Elite proxies & Spoofed servers.<br>No logs are kept.<br>No email is needed.<br>All data is encrypted, everything is<br>coded with privacy and security in mind.</p>
                        </div>
                    </div>
                    <div class="col-md-6 ms-auto">
                        <div class="mt-4 mt-md-auto">
                            <div class="d-flex align-items-center mb-2">
                                <h4 class="mb-0">INSTANT STRESSER</h4>
                            </div>
                            <p class="text-muted">Powerful high bandwidth servers make your attack as stable and hard-hitting as possible. NodeJS backend ensures that all stress tests are started and stopped instantly. You never have to wait another millisecond or worry about downtime with us.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-5 pt-md-5">
                    <div class="col-md-6">
                        <div class="mt-4 mt-md-0">
                            <div class="d-flex align-items-center mb-2">
                                <h4 class="mb-0">ADVANCED</h4>
                            </div>
                            <p class="text-muted">With our self-coded solution and usage of high-quality proxies, we are currently providing the best bypasses and power stability on the market. While fully emulating a real user, there are also numerous parameters for tuning your attack, and our professional support will help you with that.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 ms-md-auto">
                        <div class="mt-4 mt-md-0">
                            <div class="d-flex align-items-center mb-2">
                                <h4 class="mb-0">CUSTOMIZABLE</h4>
                            </div>
                            <p class="text-muted">Custom origin, useragent, request type and r/s per IP are only a tiny part of the options. From automating/scheduling attacks and controlling the number of concurrents for each to a custom header for masking your attack on the website's backend - we've got you covered.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-white" id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <div class="small-title">Pricing</div>
                            <h4>Plan list</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="hori-pricing" dir="ltr">
                            <div class="owl-carousel owl-theme events navs-carousel" id="pricing-carousel">
                                <?php foreach ($Plan->PlanDataAll()['Response'] as $Kv => $Vv) { ?>
                                <div class="item event-list">
                                    <div>
                                        <div class="event-date">
                                            <div class="text-primary mb-1">€ <?php echo $Secure->SecureTxt($Vv['Price']); ?></div>
                                            <h5 class="mb-4"><?php echo $Secure->SecureTxt($Vv['Name']); ?></h5>
                                        </div>
                                        <div class="event-down-icon">
                                            <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                        </div>
                                        <div class="mt-3 px-3">
                                            <i class="fa fa-check text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['AttackTime']); ?> seconds<br>
                                            <i class="fa fa-check text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['Concurrent']); ?> concurrent<br>
                                            <i class="fa <?php if($Vv['Premium'] == false) { echo 'fa-times text-danger'; } else { echo 'fa-check text-success mr-2'; } ?>"></i> Premium<br>
                                            <i class="fa <?php if($Vv['API'] == false) { echo 'fa-times text-danger'; } else { echo 'fa-check text-success mr-2'; } ?>"></i> API Access
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section" id="faq">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <div class="small-title">FAQ</div>
                            <h4>Frequently asked questions</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="vertical-nav">
                            <div class="row">
                                <div class="col-lg-2 col-sm-4">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab">
                                            <i class= "bx bx-help-circle nav-icon d-block mb-2"></i>
                                            <p class="font-weight-bold mb-0">General Questions</p>
                                        </a>
                                        <a class="nav-link" id="v-pills-knowledgebase-tab" data-bs-toggle="pill" href="#v-pills-knowledgebase" role="tab">
                                            <i class= "bx bx-receipt nav-icon d-block mb-2"></i>
                                            <p class="font-weight-bold mb-0">Knowledgebase</p>
                                        </a>
                                        <a class="nav-link" id="v-pills-plans-tab" data-bs-toggle="pill" href="#v-pills-plans" role="tab">
                                            <i class= "bx bx-timer d-block nav-icon mb-2"></i>
                                            <p class="font-weight-bold mb-0">Plans</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel">
                                                    <h4 class="card-title mb-4">General Questions</h4>
                                                    <div>
                                                        <div id="gen-ques-accordion" class="accordion custom-accordion">
                                                            <div class="mb-3">
                                                                <a href="#general-collapseOne" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="general-collapseOne">
                                                                    <div>What is a Stresser?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="general-collapseOne" class="collapse show" data-bs-parent="#gen-ques-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">An IP Stresser is a specialized tool that you can use to test your's or your company's website or server for vulnerabilities in its DDoS Protection, bot flood, or simulate high traffic.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#general-collapseTwo" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="general-collapseTwo">
                                                                    <div>What payment methods do you accept?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="general-collapseTwo" class="collapse" data-bs-parent="#gen-ques-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">We do only accept cryptocurrencies, and no such option as PayPal provided. However, you can exchange your PayPal balance to crypto with a variety of options available on the web.<br><br>Cryptocurrencies we currently support: Bitcoin(BTC) | Ethereum(ETH) | Litecoin(LTC) | Monero(XMR) | USDTether(USDT)</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#general-collapseThree" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="general-collapseThree">
                                                                    <div>Do you keep logs?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="general-collapseThree" class="collapse" data-bs-parent="#gen-ques-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">We take your privacy seriously and don't keep any logs. Stress them all as you want.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="#general-collapseFour" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="general-collapseFour">
                                                                    <div>Can I attack government or banks' websites?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="general-collapseFour" class="collapse" data-bs-parent="#gen-ques-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Sadly, we do not allow attacking government, bank, or educational websites. If you are the owner of one of those, <a href="#">contact us</a> to prove your ownership and permission to stress test it or check for blacklist and add if necessary.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-knowledgebase" role="tabpanel">
                                                    <h4 class="card-title mb-4">Knowledgebase</h4>
                                                    <div>
                                                        <div id="knowledgebase-accordion" class="accordion custom-accordion">
                                                            <div class="mb-3">
                                                                <a href="#knowledgebase-collapseOne" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="knowledgebase-collapseOne">
                                                                    <div>USERS SECURITY AND PRIVACY</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="knowledgebase-collapseOne" class="collapse show" data-bs-parent="#knowledgebase-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">We pride on being one of the most privacy-respectful stress testing services out there, as well as one of the most secure.<br><br>We don't keep IP logs, we don't ask for email, and we don't invade your privacy with tracking systems.<br><br>Passwords are hashed&salted using blowfish, and everything has been coded with privacy and security in mind.<br><br>Besides, we have never been breached or suffered from any kind of leak.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#knowledgebase-collapseTwo" class="accordion-list" data-bs-toggle="collapse"
                                                                    aria-expanded="true"
                                                                    aria-controls="knowledgebase-collapseTwo">
                                                                    <div>OUR PAYMENT SYSTEM</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="knowledgebase-collapseTwo" class="collapse" data-bs-parent="#knowledgebase-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Our payment system is fully automatic. Every user gets the desired package at the first confirmation on the blockchain, usually within 15-30 minutes from the moment of purchase.<br><br>For privacy and security, we only accept cryptocurrency (no, we don't accept PayPal!). Apart from bitcoin, you can pay with a variety of other currencies, including XMR (thought to be the most untraceable currency).<br><br>If you don't have cryptocurrency, you can buy it from buybitcoinworldwide.com.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#knowledgebase-collapseThree" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="knowledgebase-collapseThree">
                                                                    <div>PROTECTION BYPASS</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="knowledgebase-collapseThree" class="collapse" data-bs-parent="#knowledgebase-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">We focus on providing methods that are capable of bypass the most popular DDoS protections and any JS challenges.<br><br>Some of the protections supported are: Cloudflare (free-enterprise), Cloudflare Captcha (hcaptcha & recaptcha), DDoS-Guard (JS challenge), Sucuri, Stormwall, Amazon CDN Cloudfront, Imperva Incapsula, Akamai, Fastly, Blazingfast, Nooder, React.su, Qrator, Arvan Cloud and ANY other automatic browser verification protection. In addition we also bypass geo-block based protections for most countries, ratelimit based protections, cookie based protections and referer based protections. For Layer 4 we bypass most popular server hostings (Digital Ocean, Hetzner, Amazon AWS (most of), Google Cloud (most of), Linode, Maxihost, OVH (some)) and many others.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="#knowledgebase-collapseFour" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="knowledgebase-collapseFour">
                                                                    <div>GUARANTEED POWER</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="knowledgebase-collapseFour" class="collapse" data-bs-parent="#knowledgebase-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Giving specific numbers is very hard as they depend on many factors, such as where it was tested and the network status at that moment, among others.<br><br>We also don't want to do false advertising and giving exaggerated or misleading numbers (as many do).<br><br>That said, we guarantee a minimum of 400k+ pps per concurrent for Layer 4 (the Gbps will depend on the method) and minimum 350rqps of valid, full HTTP requests(usually much more at around 1750-5500 rqps) which produce high load on webserver with low request count, unlike "Socket HTTP Flood" method advertised by majority of other stressers. Socket Flood is a method that is very easy to filter (and it uses many rqps for each IP!) and its requests are extremely lightweight and don't produce decent load on a server making it great for showing 50000 rqps on dstat but weak/ineffective against actual targets. We, on the other hand, use as low as 2-3 rqps per each IP by default, and can go as low as 0.1 rqps/IP to bypass extreme ratelimits and still overload the webserver.<br><br>Power for each concurrent is dedicated (for example, 5 concurrents deliver 5 times more pps/rqps than 1).</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-plans" role="tabpanel">
                                                    <h4 class="card-title mb-4">Plans</h4>
                                                    <div>
                                                        <div id="plans-accordion" class="accordion custom-accordion">
                                                            <div class="mb-3">
                                                                <a href="#plans-collapseOne" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="plans-collapseOne">
                                                                    <div>How long does it take to activate my plan?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="plans-collapseOne" class="collapse show" data-bs-parent="#plans-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Every user gets the desired package at the first confirmation on the blockchain, usually within 30 minutes.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#plans-collapseTwo" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="plans-collapseTwo">
                                                                    <div>Do you offer Free packages?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="plans-collapseTwo" class="collapse" data-bs-parent="#plans-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Yes! Free stresser package is given to you automatically once you <a href="<?php echo $assets ?>register">register</a>.<br><br>You can always ask our support for a test-hit.<br><br>We care about our customers and allocate as much power as possible to them.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#plans-collapseThree" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="plans-collapseThree">
                                                                    <div>What does Bypass scale represent in plans' specifications?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="plans-collapseThree" class="collapse" data-bs-parent="#plans-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">It represents approximate percentage of websites which protection can be bypassed with features and methods included with the particular plan.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="#plans-collapseFour" class="accordion-list collapsed" data-bs-toggle="collapse"
                                                                    aria-expanded="false"
                                                                    aria-controls="plans-collapseFour">
                                                                    <div>Can I upgrade my plan?</div>
                                                                    <i class="mdi mdi-minus accor-plus-icon"></i>
                                                                </a>
                                                                <div id="plans-collapseFour" class="collapse" data-bs-parent="#plans-accordion">
                                                                    <div class="card-body">
                                                                        <p class="mb-0">Yes. Please contact us!</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
            <div class="container-fluid text-center">
                Copyright © <script>document.write(new Date().getFullYear())</script> <a href="https://bytestresser.com">ByteStresser.com</a>
            </div>
        </footer>

        <script src="<?php echo $assets; ?>landing/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo $assets; ?>landing/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $assets; ?>landing/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo $assets; ?>landing/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo $assets; ?>landing/libs/jquery.easing/jquery.easing.min.js"></script>
        <script src="<?php echo $assets; ?>landing/libs/owl.carousel/owl.carousel.min.js"></script>
        <script src="<?php echo $assets; ?>landing/js/pages/ico-landing.init.js"></script>
    </body>
</html>