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
                        <h4 class="page-title">API</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#AddAPIM">
                            <i class="mdi mdi-plus-circle"></i> Add API
                        </button>

                        <!-- Modal -->
                        <div id="AddAPIM" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="AddAPI" method="POST" autocomplete="off">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add API</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Name</label>
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">IP</label>
                                                        <input type="text" name="ip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Link</label>
                                                        <input type="text" name="link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Layer</label>
                                                        <select class="form-control" name="layer">
                                                            <option selected disabled>Select</option>
                                                            <option value="4">4</option>
                                                            <option value="7">7</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Slots</label>
                                                        <input type="number" name="slots" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Methods</label>
                                                        <select class="form-control" name="methods[]" size="6" multiple>
                                                            <option selected disabled>Select</option>
                                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $K => $V) {
                                                                echo '<option value="'.$V['name'].'">'.$V['name'].' - Layer'.$V['layer'].'</option>
                                                                ';
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="close" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <span onclick="AddAPI()" type="button" class="btn btn-info waves-effect waves-light">Add API</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title mb-4">Manage APIs</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Layer</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { ?>
                                <tr>
                                    <td><a href="api.php?id=<?php echo $Secure->SecureTxt($Av['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Av['id']); ?></a></td>
                                    <td><a href="api.php?id=<?php echo $Secure->SecureTxt($Av['id']); ?>" class="text-muted"><?php echo $Secure->SecureTxt($Av['name']); ?></a></td>
                                    <td><?php echo $Secure->SecureTxt($Av['layer']); ?></td>
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