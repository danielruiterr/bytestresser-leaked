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
                        <h4 class="page-title">BlackList</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#AddBlackListM">
                            <i class="mdi mdi-plus-circle"></i> Add BlackList
                        </button>

                        <!-- Modal -->
                        <div id="AddBlackListM" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="AddBlackList" method="POST" autocomplete="off">
                                    <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add BlackList</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Word/Ip</label>
                                                        <input type="text" name="word" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Expires</label>
                                                        <input class="form-control" type="date" name="expires">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="close" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <span onclick="AddBlackList()" type="button" class="btn btn-info waves-effect waves-light">Add BlackList</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title mb-4">Manage BlackList</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Word</th>
                                    <th>Expires</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($BlackList->BlackListDataAll()['Response'] as $BLk => $BLv) { ?>
                                <tr>
                                    <td><b><?php echo $Secure->SecureTxt($BLv['id']); ?></b></td>
                                    <td>
                                        <a href="blacklist.php?id=<?php echo $Secure->SecureTxt($BLv['id']); ?>" class="text-body">
                                            <span class="ml-2"><?php echo $Secure->SecureTxt($BLv['word']); ?></span>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="ml-2"><?php echo date('m.d.Y', $BLv['expires']); ?></span>
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