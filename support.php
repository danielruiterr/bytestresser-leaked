<?php 

define('allow', TRUE);
$page = 'Support';

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
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Opened Tickets
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="table ">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Created</th>
                                                    <th scope="col">Last reply</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($Support->ticketsListByUserIDOpen($User->UserData()['id'], 0)['Response'] as $Sk => $Sv) { ?>
                                                <tr>
                                                    <td><?php echo $Secure->SecureTxt($Sv['id']); ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['Subject']); ?></td>
                                                    <td><?php echo $Secure->get_timeago($Sv['created']); ?></td>
                                                    <td><?php echo $Secure->get_timeago($Sv['lastactivity']); ?></td>
                                                    <td><a class="btn btn-outline-primary btn-sm btn-block" href="<?php echo $assets; ?>support/request/<?php echo $Secure->SecureTxt($Sv['id']); ?>" type="button"><i class="mdi mdi-pencil"></i></a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center"><a href="<?php echo $assets; ?>support/create" class="btn btn-primary mt-3">Create</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>