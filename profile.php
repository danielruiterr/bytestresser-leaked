<?php 

define('allow', TRUE);
$page = 'Profile';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"><?php echo $page; ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Profile Info
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                            <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Username</span></td>
                                             <td class="py-2 px-0"><?php echo $Secure->SecureTxt($User->UserData()['Username']); ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Balance</span></td>
                                             <td class="py-2 px-0">&euro; <?php echo (int) $User->UserData()['Money']; ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Plan Name</span></td>
                                             <td class="py-2 px-0"><?php if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Name']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Name']); } else { echo 'n/a'; }?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Attack Duration</span></td>
                                             <td class="py-2 px-0"><?php $Addons = explode('|', $User->UserData()['Addons']); if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']) + $Addons[0]; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Concurrents</span></td>
                                             <td class="py-2 px-0"><?php if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']) + $Addons[1]; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Premium</span></td>
                                             <td class="py-2 px-0"><?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Premium']) == true) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else if($Addons[2] == 1) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Turbo</span></td>
                                             <td class="py-2 px-0"><?php if($Addons[3] == 1) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">API Access</span></td>
                                             <td class="py-2 px-0"><?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['API']) == false) { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } else { echo '<i class="bx mr-2 bx-check text-success"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Expires</span></td>
                                             <td class="py-2 px-0"><?php if($User->UserData()['Expire'] > time()) { echo date('d.m.Y', $User->UserData()['Expire']); } else if($User->UserData()['Expire'] == 1) { echo 'Expired'; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Edit Password
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="ChangePassword" method="POST">
                                        <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                        <div class="form-group"><label class="form-label">Change Password</label> <input name="CPassword" type="password" value="" class="form-control"></div>
                                        <div class="form-group"><label class="form-label">New Password</label> <input name="Password1" type="password" value="" class="form-control"></div>
                                        <div class="form-group"><label class="form-label">Confirm Password</label> <input name="Password2" type="password" value="" class="form-control"></div>
                                    </form>
                                </div>
                                <div class="card-footer text-right"><button type="button" class="btn btn-primary">Update</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>