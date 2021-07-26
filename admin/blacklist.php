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

$ID = (int) $GET['id'];

if(empty($ID)) {
    $Alert->ASaveAlert('Invalid ID.', 'error');
    header('Location: index.php');
    die();
}

if($BlackList->BlackListData($ID)['Count'] == false) { 
  $Alert->ASaveAlert('Invalid BlackList ID', 'error');
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
                        <h4 class="page-title">BlackList</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3 header-title">Edit BlackList</h4>
                            <form method="POST" id="ChangeBlackList">
                                <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                <input hidden name="id" value="<?php echo $ID; ?>">
                                <div class="form-group">
                                    <label>Word</label>
                                    <input class="form-control" name="word" placeholder="Enter Word" value="<?php echo $Secure->SecureTxt($BlackList->BlackListDataID($ID)['word']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Expires</label>
                                    <input class="form-control" value="<?php echo date('Y-m-d', $Secure->SecureTxt($BlackList->BlackListDataID($ID)['expires'])); ?>" type="date" name="expires">
                                </div>
                                <div class="form-group">
                                    <span onclick="ChangeBlackList()" class="btn btn-primary">Save</span>
                                    <span onclick="DeleteBlackList()" class="btn btn-danger">Delete</span>
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