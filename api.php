<?php 

define('allow', TRUE);
$page = 'API Manager';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) {
    header('Location: home');
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
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Manage API
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="table ">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">Attack Duration</th>
                                                    <th scope="col">Slots</th>
                                                    <th scope="col">Mode</th>
                                                    <th scope="col">Key</th>
                                                    <th scope="col">Whitelist</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($Api->UsersApiDataUserID($User->UserData()['id'], 0)['Response'] as $Sk => $Sv) { ?>
                                                <tr>
                                                    <td><?php echo (int) $Secure->SecureTxt($Sv['AttackTime']); ?></td>
                                                    <td><?php echo (int) $Secure->SecureTxt($Sv['Slots']); ?></td>
                                                    <td><?php if($Secure->SecureTxt($Sv['Mode']) == 0) { echo 'Basic'; } else if($Secure->SecureTxt($Sv['Mode']) == 1) { echo 'Premium'; } else if($Secure->SecureTxt($Sv['Mode']) == 2) { echo 'Turbo'; } ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['api_key']); ?></td>
                                                    <td><?php $IpExplode = explode('|', $Sv['WhiteList']); if(!empty($IpExplode[0])) { echo $IpExplode[0]; } else { echo 'Empty'; } if(!empty($IpExplode[1])) { echo ", ".$IpExplode[1]; } if(!empty($IpExplode[2])) { echo ", ".$IpExplode[2];} ?></td>
                                                    <td><form method="POST" id="RemoveApi<?php echo (int) $Sv['id']; ?>">
                                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                                        <button type="button" class="btn btn-outline-danger btn-sm btn-block pointer">Remove</button>
                                                    </form>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Generate API
                                    </div>
                                </div>
                                <form method="POST" id="GenerateAPI">
                                    <div class="card-body">
                                        <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                        <div class="form-group"><label for="duration">
                                            Max Attack Duration
                                            </label><input class="form-control" id="duration" name="duration" type="text" placeholder="Min: 30, Max: <?php $Addons = explode('|', $User->UserData()['Addons']); echo $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']+$Addons[0]; ?>">
                                        </div>
                                        <div class="form-group"><label for="slots">
                                            Max Slots
                                            </label><input class="form-control" id="slots" name="slots" type="text" placeholder="Min: 1, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']+$Addons[1]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="mode">
                                            Mode
                                            </label>
                                            <select name="mode" id="mode" class="form-control">
                                                <option value="0" selected="&quot;selected&quot;">Basic</option>
                                                <option value="1">Premium</option>
                                                <option value="2">Turbo</option>
                                            </select>
                                        </div>
                                        <div class="form-group"><label for="ip-address">IP Address Allowed (Optional, max : 3)</label><textarea class="form-control" name="ip-address" placeholder="<?php echo "1.1.1.1\n2.2.2.2\n3.3.3.3" ?>" id="ip-address" rows="7"></textarea></div>
                                        <strong class="text-white">Informations :</strong>
                                        <p>If you want to allow requests from all, keep this field empty.</p>
                                    </div>
                                    <div class="card-footer text-right"><button type="button" class="btn btn-primary">Deploy</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="card-title">
                                    Documentation
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group"><label>
                                    Layer 4 Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="https://api.bytestresser.com/start?user=<?php echo $User->UserData()['id']; ?>&amp;api_key=&amp;target=&amp;port=&amp;duration=&amp;method=&amp;pps=&amp;payload=" placeholder="" onclick="this.select();document.execCommand('copy');toastr['success']('Successfully copied!', '');">
                                    </div>
                                    <div class="form-group"><label>
                                    Layer 7 Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="https://api.bytestresser.com/start?user=<?php echo $User->UserData()['id']; ?>&amp;api_key=&amp;target=&amp;duration=&amp;method=&amp;reqmethod=&amp;rate=&amp;precheck=&amp;statuscode=&amp;hdata=&amp;referrer=&amp;host=&amp;origin=" placeholder="" onclick="this.select();document.execCommand('copy');toastr['success']('Successfully copied!', '');">
                                    </div>
                                    <div class="form-group"><label>
                                    Stop Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="https://api.bytestresser.com/stop?user=<?php echo $User->UserData()['id']; ?>&amp;api_key=&amp;stopper=" placeholder="" onclick="this.select();document.execCommand('copy');alert('Copied');">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        FAQ
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                What is the purpose of the API
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                        <p>The API is that you can send attacks via a link, which allows you to use our services on your stresser<br></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                How to use it
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                        <p>AIt is very easy to use API, above in the documentation you have links on how to start attacks and how to stop them. You can see the list of methods <a href="helpdesk">here</a></p>
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
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>