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

$ID = (int) $GET['id'];

if(empty($ID)) {
    $Alert->ASaveAlert('Invalid ID.', 'error');
    header('Location: index.php');
    die();
}

if($Admin->AdminDataID($ID, 0)['Count'] == false) { 
  $Alert->ASaveAlert('Invalid API ID', 'error');
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
                        <h4 class="page-title">Admin</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit Admin</h4>
                            <form method="POST" id="ChangeAdmin">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="Username" placeholder="Enter Username" value="<?php echo $Secure->SecureTxt($Admin->AdminDataIDSignle($ID)['Username']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Admin Type</label>
                                    <select class="form-control" name="Type">
                                        <option value="0" <?php if($Secure->SecureTxt($Admin->AdminDataIDSignle($ID)['Type']) == 0) { echo 'selected '; } ?>>Support</option>
                                        <option value="1" <?php if($Secure->SecureTxt($Admin->AdminDataIDSignle($ID)['Type']) == 1) { echo 'selected '; } ?>>Admin</option>
                                        <option value="2" <?php if($Secure->SecureTxt($Admin->AdminDataIDSignle($ID)['Type']) == 2) { echo 'selected '; } ?>>Owner</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" name="Password1" placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <label>Repeat New Password</label>
                                    <input class="form-control" name="Password2" placeholder="Retype New Password">
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeAdmin()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteAdmin()" class="btn btn-danger">Delete</span>
                                </div>
                            </form>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
                <!-- end col -->

            </div>   
            
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