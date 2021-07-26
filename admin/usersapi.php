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

if($Api->UsersApiDataID2($ID, 0)['Count'] == false) { 
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
                        <h4 class="page-title">Users API</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit Users API</h4>
                            <form method="POST" id="ChangeUsersAPI">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>API Key</label>
                                    <input class="form-control" name="api_key" placeholder="Enter API Key" value="<?php echo $Secure->SecureTxt($Api->UsersApiDataID2($ID, 1)['api_key']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Attack Time</label>
                                    <input class="form-control" name="time" placeholder="Enter Attack Time" value="<?php echo $Secure->SecureTxt($Api->UsersApiDataID2($ID, 1)['AttackTime']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Slots</label>
                                    <input class="form-control" name="slots" placeholder="Enter Slots" value="<?php echo $Secure->SecureTxt($Api->UsersApiDataID2($ID, 1)['Slots']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Premium</label>
                                    <select class="form-control" name="premium">
                                        <option selected="" disabled="">Select</option>
                                        <option <?php if($Secure->SecureTxt($Api->UsersApiDataID2($ID, 1)['Premium']) == 1) { echo 'selected'; } ?> value="1">True</option>
                                        <option <?php if($Secure->SecureTxt($Api->UsersApiDataID2($ID, 1)['Premium']) == 0) { echo 'selected'; } ?> value="0">False</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>WhiteList</label>
                                    <textarea class="form-control" name="whitelist" placeholder="Enter WhiteList"><?php 

if(!empty($Api->UsersApiDataID2($ID, 1)['WhiteList'])){
$IpExplode = explode('|',$Api->UsersApiDataID2($ID, 1)['WhiteList']);
if(!empty($IpExplode[0])) {
    echo $IpExplode[0];
}
if(!empty($IpExplode[1])) {
    echo "\n".$IpExplode[1];
}
if(!empty($IpExplode[2])) {
    echo "\n".$IpExplode[2];
} }                     ?></textarea>
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeUsersAPI()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteUsersAPI()" class="btn btn-danger">Delete</span>
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