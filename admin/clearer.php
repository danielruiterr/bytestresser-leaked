<?php 

define('allow', TRUE);
$db = true;

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
  die();
}

if($Admin->AdminData()['Type'] < 2) {
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
                        <h4 class="page-title">Clear</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Clearer</h4>
                            <form method="POST" id="Clearer">
                                <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Type</label>
                                    <select class="form-control" name="Type">
                                        <option selected disabled>Select</option>
                                        <option value="attack_logs">Attack Logs</option>
                                        <option value="logs">Logs</option>
                                        <option value="blacklist">Blacklist</option>
                                        <option value="news">News</option>
                                        <option value="payments">Payments</option>
                                        <option value="tickets">Tickets</option>
                                        <option value="users_api">Users API</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span onclick="Clearer()" class="btn btn-primary">Do</span>
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