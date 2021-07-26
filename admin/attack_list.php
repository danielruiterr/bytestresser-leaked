<?php 

define('allow', TRUE);
$db = true;

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
  die();
}

if($Admin->AdminData()['Type'] < 1) {
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
                        <h4 class="page-title">Attack Logs</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Attacks</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Host</th>
                                    <th>Time</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th>Stopped</th>
                                    <th>Handler</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($ALogs->LogsDataAll()['Response'] as $Ak => $Av) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['id']); ?></td>
                                    <td><a href="user.php?id=<?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['Username']); ?></a></td>
                                    <td><?php echo $Secure->SecureTxt($Av['ip']); if(!$Av['port'] == 0) { echo ':'.$Secure->SecureTxt($Av['port']); } ?></td>
                                    <td><?php echo (int) $Secure->SecureTxt($Av['time']); ?></td>
                                    <td><a href="method.php?id=<?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['id']); ?>"><?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['name']); ?></a></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Av['date']); ?></td>
                                    <td><?php if($Av['stopped'] == 1) { echo 'Yes'; } else { echo 'No'; } ?></td>
                                    <td><a href="api.php?id=<?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['name']); ?></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->   

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Running Attacks</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Host</th>
                                    <th>Time</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th>Timer</th>
                                    <th>Handler</th>
                                    <th>Options</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($ALogs->LogsDataRunning()['Response'] as $Ak => $Av) { ?>
                                <tr>
                                    <td><?php echo $Secure->SecureTxt($Av['id']); ?></td>
                                    <td><a href="user.php?id=<?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($User->UserDataID($Av['userID'], 1)['Username']); ?></a></td>
                                    <td><?php echo $Secure->SecureTxt($Av['ip']); if(!$Av['port'] == 0) { echo ':'.$Secure->SecureTxt($Av['port']); } ?></td>
                                    <td><?php echo (int) $Secure->SecureTxt($Av['time']); ?></td>
                                    <td><a href="method.php?id=<?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['id']); ?>"><?php echo $Secure->SecureTxt($Methods->MethodsDataID($Av['method'])['name']); ?></a></td>
                                    <td><?php echo date('d.m.Y H:i:s', $Av['date']); ?></td>
                                    <td><div class="dtr-title" id="counter_<?php echo (int) $Av['id'] ?>">9999999</div></td>
                                    <td><a href="api.php?id=<?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['id']); ?>"><?php echo $Secure->SecureTxt($Api->ApiDataID($Av['handler'], 1)['name']); ?></a></td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <span class="dropdown-item" onclick="Stop('<?php echo (int) $Av['id']; ?>')"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Stop</span>
                                            </div>
                                        </div>
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

<div id="AttackJS"></div>
<script>
    $("#AttackJS").load("attacks_java.php");
</script>