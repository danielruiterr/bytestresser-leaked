<?php

session_start();

define('allow', TRUE);

include_once('includes.php');

if ($User->IsLoged() == true) {
    $Alert->SaveAlert('Welcome back', 'success');
    header('Location: panel');
    die();
}

// unset($_SESSION['captcha']);
// unset($_SESSION['answer']);
// $_SESSION['captcha'] = rand(1, 100);
// $x1 = rand(1,20);
// $x2 = rand(1,20);
// $_SESSION['answer'] = SHA1(($x1 + $x2).$_SESSION['captcha']);

?>
<!DOCTYPE html>
<html lang="en">
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
        <link rel="shortcut icon" href="<?php echo $assets; ?>assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $assets; ?>assets/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $assets; ?>assets/css/app.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    </head>
    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <span><img class="logo-logreg" src="assets/images/logo-light.png" alt="" height="55"></span>
                                </div>

                                <h5 class="auth-title">Sign Up</h5>

                                <div id="msg_alert"></div>

                                <form method="POST" id="Register">
                                    <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                    <div class="form-group mb-3">
                                        <label>Username</label>
                                        <input class="form-control" id="username-register" name="Username" type="text" required="" placeholder="Enter your Username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        <input class="form-control" id="email-register" name="Email" type="text" required="" placeholder="Enter your Email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input class="form-control" id="password1-register" name="Password1" type="password" required="" placeholder="Enter your Password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input class="form-control" id="password2-register" name="Password2" type="password" required="" placeholder="Re enter your Password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Captcha</label>
                                        <input class="form-control" id="captcha-register" name="Captcha" type="text" required="" placeholder="How much is <?php echo $x1.' + '.$x2; ?> ?">
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" name="ToS" class="custom-control-input" id="checkbox-signup">
                                            <label class="custom-control-label" for="checkbox-signup">I accept <a href="tos" class="text-dark">Terms of Service</a></label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <span class="btn btn-danger btn-block" onclick="Register()"> Register </span>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Already have account? <a href="login" class="text-muted ml-1"><b class="font-weight-semibold">Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <?php echo date('Y'); ?> &copy; <a href="https://stresser.pro" class="text-muted">Stresser.Pro</a> 
        </footer>

        <!-- Vendor js -->
        <script src="<?php echo $assets; ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo $assets; ?>assets/js/app.js?<?php echo time(); ?>"></script>
        <script src="<?php echo $assets; ?>assets/js/app.min.js"></script>

        <!-- Notifications -->
        <script src="<?php echo $assets; ?>assets/js/jquery.toast.min.js"></script>
    </body>
</html>