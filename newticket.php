<?php 

define('allow', TRUE);
$page = 'Create Ticket';

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
                        <div class="col-lg-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Create Ticket
                                    </div>
                                </div>
                                <form method="POST" id="CreateTicket">
                                    <div class="card-body">
                                        <input hidden name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="row mb-4">
                                            <label for="Subject" class="col-form-label col-lg-2">Subject</label>
                                            <div class="col-lg-10">
                                                <input id="Subject" name="Subject" type="text" class="form-control" placeholder="Enter Subject...">
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="Message" class="col-form-label col-lg-2">Message</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="Message" rows="5" placeholder="Enter Content"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="Captcha" class="col-form-label col-lg-2">Captcha Code</label>
                                            <div class="col-lg-10">
                                                <div class="form-group text-center">
                                                    <img class="text-center" id="CaptchaImg" width="140" height="35" src="<?php echo $assets; ?>request/captcha/<?php echo time(); ?>" alt="Captcha Code">
                                                    <button type="button" class="btn btn-primary">Refresh</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="Captcha" class="col-form-label col-lg-2">Captcha</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" name="CaptchaCode" placeholder="Enter Captcha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right"><button type="button" class="btn btn-primary">Deploy</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>