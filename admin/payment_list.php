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
                        <h4 class="page-title">Payment Logs</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Logs</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Invoice ID</th>
                                    <th>User</th>
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
                                <?php foreach ($Order->OrderDataAll(0)['Response'] as $Ak => $Av) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['order_id']); ?></td>
                                    <td><?php echo $Secure->SecureTxt($Av['invoice_id']); ?></td>
                                    <td><a href="user.php?id=<?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['Username']); ?></a></td>
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