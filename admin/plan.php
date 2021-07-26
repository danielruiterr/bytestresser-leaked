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

if($Plan->PlanData($ID)['Count'] == false) { 
  $Alert->ASaveAlert('Invalid Plan ID', 'error');
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
                        <h4 class="page-title">Plan</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit Plan</h4>
                            <form method="POST" id="ChangePlan">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter Name" value="<?php echo $Secure->SecureTxt($Plan->PlanDataID($ID)['Name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Price (Euros)</label>
                                    <input class="form-control" name="price" placeholder="Enter Price" value="<?php echo $Secure->SecureTxt($Plan->PlanDataID($ID)['Price']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Attack Time (Seconds)</label>
                                    <input class="form-control" name="attacktime" placeholder="Enter Attack Time" value="<?php echo $Secure->SecureTxt($Plan->PlanDataID($ID)['AttackTime']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Concurrents</label>
                                    <input class="form-control" name="concurrent" placeholder="Enter Concurrents" value="<?php echo $Secure->SecureTxt($Plan->PlanDataID($ID)['Concurrent']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>PPS</label>
                                    <input class="form-control" name="pps" placeholder="Enter PPS" value="<?php echo $Secure->SecureTxt($Plan->PlanDataID($ID)['PPS']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">API Access</label>
                                    <select class="form-control" name="api">
                                        <option <?php if($Plan->PlanDataID($ID)['API'] == 0) { echo 'selected'; } ?> value="0">No</option>
                                        <option <?php if($Plan->PlanDataID($ID)['API'] == 1) { echo 'selected'; } ?> value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Premium</label>
                                    <select class="form-control" name="premium">
                                        <option <?php if($Plan->PlanDataID($ID)['Premium'] == 0) { echo 'selected'; } ?> value="0">No</option>
                                        <option <?php if($Plan->PlanDataID($ID)['Premium'] == 1) { echo 'selected'; } ?> value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Layer 4</label>
                                    <select class="form-control" name="l4">
                                        <option <?php if($Plan->PlanDataID($ID)['L4'] == 0) { echo 'selected'; } ?> value="0">No</option>
                                        <option <?php if($Plan->PlanDataID($ID)['L4'] == 1) { echo 'selected'; } ?> value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Layer 7</label>
                                    <select class="form-control" name="l7">
                                        <option <?php if($Plan->PlanDataID($ID)['L7'] == 0) { echo 'selected'; } ?> value="0">No</option>
                                        <option <?php if($Plan->PlanDataID($ID)['L7'] == 1) { echo 'selected'; } ?> value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangePlan()" class="btn btn-primary">Save</span>
                                    <span onclick="DeletePlan()" class="btn btn-danger">Delete</span>
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