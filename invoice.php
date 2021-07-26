<?php 

define('allow', TRUE);
$page = 'Invoice';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

$ID = (int) $Secure->SecureTxt($GET['id']);

if(empty($ID)) {
    $Alert->SaveAlert('Invalid Invoice.', 'error');
    echo '<script>window.location.replace("'.$assets.'home");</script>';
    die();
}

if(!($Order->OrderDataID($ID, $User->UserData()['id'], 0)['Count']) == true) {
    $Alert->SaveAlert('Invalid Invoice.', 'error');
    echo '<script>window.location.replace("'.$assets.'home");</script>';
    die();
}

?>
        <script>
            function copyToClipboard(text) {
                var input = document.body.appendChild(document.createElement("input"));
                input.value = text;
                input.focus();
                input.select();
                document.execCommand('copy');
                input.parentNode.removeChild(input);
                toastr['success']('Successfully copied!', '')
            }
        </script>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payments #<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['order_id']); ?></h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Crypto</label> 
                                        <div class="col-md-9"><input type="text" disabled="disabled" value="<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['checkout_currency']); ?>" class="form-control"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Address</label> 
                                        <div class="col-md-9">
                                            <div class="input-group"><input type="text" disabled="disabled" class="form-control" value="<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_address']); ?>" id="address"> <span class="input-group-append"><button onclick="copyToClipboard('<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_address']); ?>')" class="btn btn-primary">Copy</button></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Amount</label> 
                                        <div class="col-md-9">
                                            <div class="input-group"><input type="text" disabled="disabled" class="form-control" value="<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_amount']); ?>" id="amount"> <span class="input-group-append"><button onclick="copyToClipboard('<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_amount']); ?>')" class="btn btn-primary">Copy</button></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Amount paid</label> 
                                        <div class="col-md-9"><input type="text" disabled="disabled" class="form-control" value="<?php echo $Order->GetTransactionInfo($Order->OrderDataID($ID, $User->UserData()['id'], '1')['invoice_id'])['result']['received']; ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Expired</label> 
                                        <div class="col-md-9">
                                            <div class="input-group"><input type="text" disabled="disabled" value="<?php echo date('d.m.Y H:i:s', $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['invoice_expires'])); ?>" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <p>1. Please transfer the specified amount to the addresss displayed.</p>
                                        <p>2. Wait 5-30 minutes (usually 10) for the transaction to confirm.</p>
                                        <p>3. Your account will be automatically upgraded with the desired plan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Where to buy Bitcoin
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                    <p>If you dont know how or where to buy bitcoin here are some links that will help you. Buying bitcoin is very easy and can be done within 30 minutes.<br> <br> <b>What is bitcoin:</b> <a href="https://bitcoin.org/en/buy" target="_blank">https://www.youtube.com/watch?v=2X9eJF1nLiY</a><br> <b>How to buy bitcoin:</b> <a href="https://bitcoin.org/en/buy" target="_blank">https://www.youtube.com/watch?v=M4R8Wbt3Ido</a><br> <b>You can buy bitcoin here:</b> <a href="https://bitcoin.org/en/buy" target="_blank">https://bitcoin.org/en/buy</a>, <a href="https://www.bitnovo.com/" target="_blank">https://www.bitnovo.com/</a>, <a href="https://www.buybitcoinworldwide.com" target="_blank">https://buybitcoinworldwide.com</a>, <a href="https://www.buybitcoinworldwide.com" target="_blank">https://www.buybitcoinworldwide.com</a>, <a href="https://www.paxful.com" target="_blank">https://www.paxful.com</a><br></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Package Activation
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                    After you send the displayed amount of the choosen crypto currency and the transaction confirms in the blockchain (usually within 30 minutes) your account will be automatically upgraded with the desired package.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Contact Support
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                    If you need help or have any questions you can contact us at our Telegram group or contact the owner at msctf@pm.me, dont forget to also read our support / help page which may answer your questions.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Info</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="py-2 px-0"><span class="font-weight-semibold w-50">Date</span></td>
                                                    <td class="py-2 px-0"><?php echo date('d.m.Y H:i:s', $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['invoice_created'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 px-0"><span class="font-weight-semibold w-50">Expires</span></td>
                                                    <td class="py-2 px-0"><?php echo date('d.m.Y H:i:s', $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['invoice_expires'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 px-0"><span class="font-weight-semibold w-50">Status</span></td>
                                                    <td class="py-2 px-0"><?php if($Order->OrderDataID($ID, $User->UserData()['id'], '1')['invoice_status'] == 0) { echo 'Awaiting Payment'; } else if($Order->OrderDataID($ID, $User->UserData()['id'], '1')['invoice_status'] == 1) { echo 'Paid'; } else if(($Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['invoice_expires']) - time()) < 0) { echo 'Expired'; } else { echo 'Canceled'; } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 px-0"><span class="font-weight-semibold w-50">Amount</span></td>
                                                    <td class="py-2 px-0">€ <?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], 1)['Price']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">QR-code</h4>
                                    <div class="text-center py-4 bg-light border"><img src="https://chart.googleapis.com/chart?chs=185x185&cht=qr&chl=<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_address']); ?>&amount=<?php echo $Secure->SecureTxt($Order->OrderDataID($ID, $User->UserData()['id'], '1')['checkout_amount']); ?>" alt="qr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>