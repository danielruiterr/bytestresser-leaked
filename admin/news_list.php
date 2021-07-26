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
                        <h4 class="page-title">News</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#AddNewsM">
                            <i class="mdi mdi-plus-circle"></i> Add News
                        </button>

                        <!-- Modal -->
                        <div id="AddNewsM" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="AddNews" method="POST" autocomplete="off">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add News</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Title</label>
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Message</label>
                                                        <textarea type="text" name="message" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="close" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <span onclick="AddNews()" type="button" class="btn btn-info waves-effect waves-light">Add News</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title mb-4">Manage News</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($News->NewsDataAll()['Response'] as $Nk => $Nv) { ?>
                                <tr>
                                    <td><a href="new.php?id=<?php echo $Secure->SecureTxt($Nv['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Nv['id']); ?></a></td>
                                    <td><a href="new.php?id=<?php echo $Secure->SecureTxt($Nv['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Nv['Title']); ?></a></td>
                                    <td><?php echo date('d.m.Y H:i:a', $Secure->SecureTxt($Nv['Timestamp'])); ?></td>
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