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

if($Methods->MethodsData($ID, 0)['Count'] == false) { 
  $Alert->ASaveAlert('Invalid Method ID', 'error');
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
                        <h4 class="page-title">Method</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit Method</h4>
                            <form method="POST" id="ChangeMethod">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter Title" value="<?php echo $Secure->SecureTxt($Methods->MethodsDataID($ID)['name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Layer</label>
                                    <select class="form-control" name="layer">
                                        <option <?php if($Methods->MethodsDataID($ID)['layer'] == 4) { echo 'selected'; } ?> value="4">4</option>
                                        <option <?php if($Methods->MethodsDataID($ID)['layer'] == 7) { echo 'selected'; } ?> value="7">7</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Type</label>
                                    <select class="form-control" name="type">
                                        <optgroup label="Layer4">
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 4) if($Methods->MethodsDataID($ID)['type'] == 1) { echo 'selected'; } ?> value="1">AMP (UDP Amplification)</option>
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 4) if($Methods->MethodsDataID($ID)['type'] == 2) { echo 'selected'; } ?> value="2">TCP (Transmission Control Protocol)</option>
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 4) if($Methods->MethodsDataID($ID)['type'] == 3) { echo 'selected'; } ?> value="3">UDP (User Datagram Protocol)</option>
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 4) if($Methods->MethodsDataID($ID)['type'] == 4) { echo 'selected'; } ?> value="4">Layer 3 (IP Protocol)</option>
                                        </optgroup>
                                        <optgroup label="Layer7">
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 7) if($Methods->MethodsDataID($ID)['type'] == 1) { echo 'selected'; } ?> value="1">Bypass</option>
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 7) if($Methods->MethodsDataID($ID)['type'] == 2) { echo 'selected'; } ?> value="2">Tor Network (.onion)</option>
                                            <option <?php if($Methods->MethodsDataID($ID)['layer'] == 7) if($Methods->MethodsDataID($ID)['type'] == 3) { echo 'selected'; } ?> value="3">Basic Flood</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Premium</label>
                                    <select class="form-control" name="premium">
                                        <option <?php if($Methods->MethodsDataID($ID)['premium'] == 0) { echo 'selected'; } ?> value="0">False</option>
                                        <option <?php if($Methods->MethodsDataID($ID)['premium'] == 1) { echo 'selected'; } ?> value="1">True</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter Description" value="<?php echo $Methods->MethodsDataID($ID)['description']; ?>"></textarea>
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeMethod()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteMethod()" class="btn btn-danger">Delete</span>
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