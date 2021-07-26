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
                        <h4 class="page-title">Admin List</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#AddAdminM">
                            <i class="mdi mdi-plus-circle"></i> Add Admin
                        </button>
                        <!-- Add Admin Modal -->
                        <div id="AddAdminM" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="AddAdmin" method="POST" autocomplete="off">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Admin</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Username</label>
                                                        <input type="text" name="Username" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Admin Type</label>
                                                <select class="form-control" name="Type">
                                                    <option value="0">Support</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Owner</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Password</label>
                                                        <input type="text" name="Password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="close" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <span onclick="AddAdmin()" type="button" class="btn btn-info waves-effect waves-light">Add Admin</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <h4 class="header-title mb-4">Manage Users</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Admin->AdminDataAll()['Response'] as $Ak => $Av) { ?>
                                <tr>
                                    <td><a href="admin.php?id=<?php echo $Secure->SecureTxt($Av['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Av['id']); ?></a></td>
                                    <td><a href="admin.php?id=<?php echo $Secure->SecureTxt($Av['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Av['Username']); ?></a></td>
                                    <td><?php if($Secure->SecureTxt($Av['Type']) == 0) { echo 'Support'; } else if($Secure->SecureTxt($Av['Type']) == 1) { echo 'Admin'; } else { echo 'Owner'; } ?></td>
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