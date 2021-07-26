<?php

define('allow', TRUE);
define('admin', TRUE);

include_once('../inc.php');

if(!isset($_SESSION['attemp'])) {
    @$_SESSION['attemp']['num'] == 0;
}

if ($Admin->IsLoged() == true) {
    $Alert->ASaveAlert('Welcome back', 'success');
    header('Location: index.php');
    die();
}

if(isset($_GET['log'])) {
    $Username = $Secure->SecureTxt($_POST['Username']);
    $Password = $_POST['Password'];
    $csrf = $_POST['_csrf'];

    if($csrf != $csrftoken) {
        $Alert->SaveAlert('Invalid token.', 'error');
        header('Location: login.php');
        die();
    }

    if($Admin->AdminDataByUsername($Username)['Count'] == 0) {
        @$_SESSION['attemp']['num'] = @$_SESSION['attemp']['num'] + 1;

        $Alert->SaveAlert('This account doesnt exist.', 'error');
        header('Location: login.php');
        die();
    }

    if(@$_SESSION['attemp']['num'] >= 5) {
        $Alert->SaveAlert('This account doesnt exist.', 'error');
        header('Location: login.php');
        die();
    }

    $Admin->LogIn($Username, $Password);
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

    </head>
    <body class="authentication-bg authentication-bg-pattern">
    <?php if(!empty($Alert->APrintAlert())) { echo $Alert->APrintAlert(); $Alert->RemoveAlert(); } ?>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">

                                <h5 class="auth-title">Sign In</h5>

                                <form method="POST" action="login.php?log">
                                    <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                    <div class="form-group mb-3">
                                        <label>Username</label>
                                        <input class="form-control" name="Username" type="text" required="" placeholder="Enter your Username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input class="form-control" name="Password" type="password" required="" placeholder="Enter your Password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            <?php echo date('Y'); ?> &copy; ByteStresser
        </footer>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/app.js"></script>

		<script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>
		<script src="assets/js/toast.js"></script>
    </body>
</html>