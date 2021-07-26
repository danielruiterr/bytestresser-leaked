<?php 

define('allow', TRUE);
$userdb = true;

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

if($User->UserDataID($ID, 0)['Count'] == false) { 
  $Alert->ASaveAlert('Invalid User ID', 'error');
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
                        <h4 class="page-title">User</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit User</h4>
                            <form method="POST" id="ChangeUser">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" placeholder="Enter Username" value="<?php echo $Secure->SecureTxt($User->UserDataID($ID, 1)['Username']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Plan</label>
                                    <select class="form-control" name="plan">
                                        <option <?php if($User->UserDataID($ID, 1)['Plan'] == 0) { echo 'selected'; } ?> value="0">Nothing</option>
                                        <?php foreach ($Plan->PlanDataAll()['Response'] as $Pk => $Pv) {
                                            echo "<option "; if($User->UserDataID($ID, 1)['Plan'] == $Pv['id']) { echo 'selected '; } echo 'value='.$Pv['id'].'>'.$Pv['Name'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Expire</label>
                                    <input class="form-control" name="expire" placeholder="Enter Expire Date" type="date" value="<?php if($Secure->SecureTxt($User->UserDataID($ID, 1)['Expire']) != 0) { echo date('Y-m-d', $Secure->SecureTxt($User->UserDataID($ID, 1)['Expire'])); } else { echo '0'; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>Money</label>
                                    <input class="form-control" type="number" name="money" placeholder="Enter Money" value="<?php echo $Secure->SecureTxt($User->UserDataID($ID, 1)['Money']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option selected disabled>Select</option>
                                        <option <?php if($Secure->SecureTxt($User->UserDataID($ID, 1)['Status']) == 1) { echo 'selected'; } ?> value="1">Active</option>
                                        <option <?php if($Secure->SecureTxt($User->UserDataID($ID, 1)['Status']) == 0) { echo 'selected'; } ?> value="0">Suspended</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seconds</label>
                                    <input class="form-control" type="number" name="seconds" placeholder="Enter Seconds" value="<?php $Addons = explode('|', $User->UserDataID($ID, 1)['Addons']); echo (int) $Addons[0]; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Concurrents</label>
                                    <input class="form-control" type="number" name="concurrents" placeholder="Enter Concurrents" value="<?php echo (int) $Addons[1]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Premium</label>
                                    <select class="form-control" name="premium">
                                        <option selected disabled>Select</option>
                                        <option <?php if($Addons[2] == 1) { echo 'selected'; } ?> value="1">Active</option>
                                        <option <?php if($Addons[2] == 0) { echo 'selected'; } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Turbo</label>
                                    <select class="form-control" name="turbo">
                                        <option selected disabled>Select</option>
                                        <option <?php if($Addons[3] == 1) { echo 'selected'; } ?> value="1">Active</option>
                                        <option <?php if($Addons[3] == 0) { echo 'selected'; } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" name="newpw1" placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <label>Repeat Password</label>
                                    <input class="form-control" name="newpw2" placeholder="Repeat New Password">
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeUser()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteUser()" class="btn btn-danger">Delete</span>
                                </div>
                            </form>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Action Logs</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Action</th>
                                    <th>Time</th>
                                    <th>IP</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Logs->LogsDataAll()['Response'] as $Ak => $Av) { if($Av['userID'] == $ID) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['id']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['action']); ?></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Av['timestamp']); ?></td>
                                    <td><?php echo $Secure->decrypt($Av['ip']); ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-box">
                        <h4 class="header-title mb-4">Deposit Logs</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table1">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Invoice ID</th>
                                    <th>Adress</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Created</th>
                                    <th>Expires</th>
                                    <th>Time</th>
                                    <th>Checkout URL</th>
                                    <th>Status URL</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Order->OrderDataAll(0)['Response'] as $Ak => $Av) { if($Av['userID'] == $ID) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['order_id']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['invoice_id']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['checkout_address']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['checkout_amount']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['Price']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['checkout_currency']); ?></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Secure->SecureTxt($Av['invoice_created'])); ?></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Secure->SecureTxt($Av['invoice_expires'])); ?></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Av['timestamp']); ?></td>
                                    <td><a href="<?php echo urldecode($Av['checkout_url']); ?>" target="_blank">Click</a></td>
                                    <td><a href="<?php echo urldecode($Av['status_url']); ?>" target="_blank">Click</a></td>
                                    <td><?php if($Av['invoice_expires'] - time() < 0) { echo '<span class="badge badge-warning">Expired</span>'; } else if($Secure->SecureTxt($Av['invoice_status']) == 0) { echo '<span class="badge badge-danger">Waiting Payment</span>'; } else if($Secure->SecureTxt($Av['invoice_status']) == 1) { echo '<span class="badge badge-success">Paid</span>'; } else if($Secure->SecureTxt($Av['invoice_status']) == 2) { echo '<span class="badge badge-danger">Canceled</span>'; } ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-box">
                        <h4 class="header-title mb-4">Attack Logs</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Host</th>
                                    <th>Time</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th>Stopped</th>
                                    <th>Handler</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($ALogs->LogsDataAll()['Response'] as $Ak => $Av) { if($Av['userID'] == $ID) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['id']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['ip']); if(!$Av['port'] == 0) { echo ':'.$Secure->SecureTxt($Av['port']); } ?></td>
                                    <td><?php echo (int) $Secure->SecureTxt($Av['time']); ?></td>
                                    <td><a href="method.php?id=<?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['id']); ?>"><?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['name']); ?></a></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Av['date']); ?></td>
                                    <td><?php if($Av['stopped'] == 1) { echo 'Yes'; } else { echo 'No'; } ?></td>
                                    <td><a href="api.php?id=<?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['name']); ?></a></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>   
            
        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo date('Y'); ?> &copy; <a href="https://bytestresser.com">bytestresser.com</a> 
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
<?php include 'public/footer.php'; ?>