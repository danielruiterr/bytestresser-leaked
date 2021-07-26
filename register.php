<?php

define('allow', TRUE);

include_once('inc.php');

if ($User->IsLoged() == true) {
    $Alert->SaveAlert('Welcome back!', 'success');
    header('Location: home');
    die();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>ByteStresser.com - Register</title>
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
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">
        <link href="assets/css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <?php if(!empty($Alert->PrintAlert())) { echo $Alert->PrintAlert(); $Alert->RemoveAlert(); } ?>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Register</h5>
                                            <p>Create New Account</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" id="Register">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="Password">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="Password2">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group text-center">
                                                <img class="text-center" id="CaptchaImg" width="140" height="35" src="request/captcha/<?php echo time(); ?>" alt="Captcha Code">
                                                <button type="button" class="btn btn-primary">Refresh</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="captcha" class="form-label">Captcha code</label>
                                            <input type="text" class="form-control" id="captcha" placeholder="Enter captcha" name="CaptchaCode">
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light w100">Register</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="<?php echo $assets; ?>login" class="btn btn-primary waves-effect waves-light w100">Log in</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                        Copyright © <script>document.write(new Date().getFullYear())</script> <a href="https://bytestresser.com">ByteStresser.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo $assets; ?>assets/libs/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="<?php echo $assets; ?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo $assets; ?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo $assets; ?>assets/libs/toastr/build/toastr.min.js"></script>
        <script src="<?php echo $assets; ?>assets/js/toastr.js"></script>
        <script src="<?php echo $assets; ?>assets/js/query.js"></script>
        <script src="<?php echo $assets; ?>assets/js/app.js"></script>
   </body>
</html>