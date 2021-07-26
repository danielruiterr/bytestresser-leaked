<?php 

define('allow', TRUE);
$db = true;

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
  die();
}

if($Admin->AdminData()['Type'] != 2) {
    $Alert->ASaveAlert('you are not permited.', 'error');
    header('Location: index.php');
    die();
}

?>
<div class="content-page">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Users API</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Manage Users API</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Key</th>
                                    <th>User</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Api->UsersApiDataAll()['Response'] as $Uk => $Uv) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Uv['id']); ?></td>
                                    <td><a href="usersapi.php?id=<?php echo $Secure->SecureTxt($Uv['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Uv['api_key']); ?></a></td>
                                    <td><a href="user.php?id=<?php echo $Secure->SecureTxt($User->UserDataID($Uv['userID'],1)['id']); ?>"><?php echo $Secure->SecureTxt($User->UserDataID($Uv['userID'],1)['Username']); ?></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->    
            
        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo date('Y'); ?> &copy; <a href="https://bytestresser.com">ByteStresser.com</a> 
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
<?php include 'public/footer.php'; ?>