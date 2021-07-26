<?php 

define('allow', TRUE);
$db = true;

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
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
                        <h4 class="page-title">Tickets</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row no-gutters">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary">
                                    <i class="fe-tag font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $User->UserDataAll()['Count']; ?></span></h3>
                                    <p class="text-primary mb-1 text-truncate">Customers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning">
                                    <i class="fe-clock font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Support->ticketsList()['Count']; ?></span></h3>
                                    <p class="text-warning mb-1 text-truncate">Total Tickets</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success">
                                    <i class="fe-check-circle font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $ALogs->LogsDataAll()['Count']; ?></span></h3>
                                    <p class="text-success mb-1 text-truncate">Total Boots</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-danger rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-danger">
                                    <i class="fe-server font-22 avatar-title text-danger"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Api->ApiDataAll()['Count']; ?></span></h3>
                                    <p class="text-danger mb-1 text-truncate">Total Servers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Manage Tickets</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Creator</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Last Activity</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Support->ticketsList()['Response'] as $Sk => $Sv) { ?>
                                <tr>
                                    <td><b><?php echo $Secure->SecureTxt($Sv['id']); ?></b></td>

                                    <td>
                                        <a href="user.php?id=<?php echo (int) $Secure->SecureTxt($Sv['userID']); ?>" class="text-body">
                                            <?php echo $Secure->SecureTxt($User->UserDataID($Sv['userID'], 1)['Username']); ?>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="ticket.php?id=<?php echo (int) $Secure->SecureTxt($Sv['id']); ?>" class="text-body">
                                            <span class="ml-2"><?php echo $Secure->SecureTxt($Sv['Subject']); ?></span>
                                        </a>
                                    </td>

                                    <td>
                                        <?php if($Secure->SecureTxt($Sv['Status']) == 0) { echo '<span class="badge badge-light">Closed</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 1) { echo '<span class="badge badge-success">Open</span>'; } else if ($Secure->SecureTxt($Sv['Status']) == 2) { echo '<span class="badge badge-success">Open</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 3) { echo '<span class="badge badge-success">Answered</span>'; } else { echo '<span class="badge badge-light">Closed</span>'; } ?>
                                    </td>

                                    <td>
                                        <?php echo $Secure->get_timeago($Sv['created']); ?>
                                    </td>

                                    <td>
                                        <?php echo $Secure->get_timeago($Sv['lastactivity']); ?>
                                    </td>
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