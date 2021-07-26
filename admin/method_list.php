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
                        <h4 class="page-title">Methods</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <button type="button" class="btn btn-sm btn-dark waves-effect waves-light float-right" data-toggle="modal" data-target="#AddMethodM">
                            <i class="mdi mdi-plus-circle"></i> Add Method
                        </button>

                        <!-- Modal -->
                        <div id="AddMethodM" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="AddMethod" method="POST" autocomplete="off">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Method</h4>
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
                                                        <label for="field-3" class="control-label">Type</label>
                                                        <select class="form-control" name="type">
                                                            <option selected disabled>Select</option>
                                                            <optgroup label="Layer4">
                                                                <option value="1">AMP (UDP Amplification)</option>
                                                                <option value="2">TCP (Transmission Control Protocol)</option>
                                                                <option value="3">UDP (User Datagram Protocol)</option>
                                                                <option value="4">Layer 3 (IP Protocol)</option>
                                                            </optgroup>
                                                            <optgroup label="Layer7">
                                                                <option value="1">Bypass</option>
                                                                <option value="2">Tor Network (.onion)</option>
                                                                <option value="3">Basic Flood</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Premium</label>
                                                        <select class="form-control" name="premium">
                                                            <option selected disabled>Select</option>
                                                            <option value="0">False</option>
                                                            <option value="1">True</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="field-3" class="control-label">Description</label>
                                                        <textarea type="text" name="description" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="close" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <span onclick="AddMethod()" type="button" class="btn btn-info waves-effect waves-light">Add News</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <h4 class="header-title mb-4">Manage Methods</h4>

                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Layer</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { ?>
                                <tr>
                                    <td><b><?php echo $Secure->SecureTxt($Mv['id']); ?></b></td>
                                    <td>
                                        <a href="method.php?id=<?php echo $Secure->SecureTxt($Mv['id']); ?>" class="text-body">
                                            <span class="ml-2"><?php echo $Secure->SecureTxt($Mv['name']); ?></span>
                                        </a>
                                    </td>

                                    <td>
                                        <?php echo (int) $Mv['layer']; ?>
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