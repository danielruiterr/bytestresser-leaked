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

if($Api->ApiDataID($ID, 0)['Count'] == false) { 
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
                        <h4 class="page-title">API</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit API</h4>
                            <form method="POST" id="ChangeAPI">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter Name" value="<?php echo $Secure->SecureTxt($Api->ApiDataID($ID, 1)['name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>IPv4</label>
                                    <input class="form-control" name="ip" placeholder="Enter IP" value="<?php echo $Secure->SecureTxt($Api->ApiDataID($ID, 1)['ip']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input class="form-control" name="link" placeholder="Enter Link" value="<?php echo $Secure->decrypt($Api->ApiDataID($ID, 1)['link']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Layer</label>
                                    <select class="form-control" name="layer">
                                        <option selected disabled>Select</option>
                                        <option <?php if($Secure->SecureTxt($Api->ApiDataID($ID, 1)['layer']) == 4) { echo 'selected'; } ?> value="4">4</option>
                                        <option <?php if($Secure->SecureTxt($Api->ApiDataID($ID, 1)['layer']) == 7) { echo 'selected'; } ?> value="7">7</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Slots</label>
                                    <input class="form-control" name="slots" placeholder="Enter Slots" value="<?php echo $Secure->SecureTxt($Api->ApiDataID($ID, 1)['slots']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option selected disabled>Select</option>
                                        <option <?php if($Secure->SecureTxt($Api->ApiDataID($ID, 1)['status']) == 1) { echo 'selected'; } ?> value="1">Online</option>
                                        <option <?php if($Secure->SecureTxt($Api->ApiDataID($ID, 1)['status']) == 0) { echo 'selected'; } ?> value="0">Offline</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Methods</label>
                                    <select class="form-control" name="methods[]" size="6" multiple>
                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $K => $V) {
                                            $pos = strpos($Api->ApiDataID($ID, 1)['methods'], $V['name']);
                                            if ($pos === false) {
                                                $selected = '';
                                            } else {
                                                $selected = 'selected';
                                            }
                                            echo '<option '.$selected.' value="'.$V['name'].'">'.$V['name'].'  - Layer'.$V['layer'].'</option>
                                            ';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeAPI()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteAPI()" class="btn btn-danger">Delete</span>
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