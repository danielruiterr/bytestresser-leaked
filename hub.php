<?php 

define('allow', TRUE);
$page = 'Attack Hub';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

$Addons = explode('|', $User->UserData()['Addons']);

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
                        <div class="col-xl-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Stresser Form
                                    </div>
                                </div>

                                <div class="card-body">

                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#l4" role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none">Layer 4</span>
                                                <span class="d-none d-sm-block">Layer 4</span>
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#l7" role="tab" aria-selected="false">
                                                <span class="d-block d-sm-none">Layer 7</span>
                                                <span class="d-none d-sm-block">Layer 7</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="l4" role="tabpanel">
                                            <form method="POST" id="Details4">
                                                <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                                <div class="form-group">
                                                    <label>Attack Method</label>
                                                    <select class="form-control" id="method" name="method">
                                                        <optgroup style="color:#a6aaaf" label="AMP (UDP Amplification)">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 1) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                        <optgroup style="color:#a6aaaf" label="TCP (Transmission Control Protocol)">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 2) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                        <optgroup style="color:#a6aaaf" label="UDP (User Datagram Protocol)">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 3) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                        <optgroup style="color:#a6aaaf" label="Layer 3 (IP Protocol)">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 4) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="form-group"><label for="address">
                                                    Address
                                                    </label>
                                                    <input type="text" class="form-control" id="address" required="" name="address" placeholder="127.0.0.1" onchange="IpPort()">
                                                </div>
                                                <div class="form-group"><label for="port">
                                                    Port
                                                    </label>
                                                    <input type="text" class="form-control" id="port" required="" name="port" placeholder="80">
                                                </div>
                                                <div class="form-group"><label for="time">
                                                    Duration
                                                    </label>
                                                    <input class="form-control" id="time" name="time" type="text" placeholder="Min: 15, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime'] + $Addons[0]; ?> sec (Optional)">
                                                </div>
                                                <div class="multi-collapse collapse" id="AdvancedLayer4" style="">
                                                    <div class="form-group">
                                                        <label for="payload">Payload</label>
                                                        <input class="form-control" id="payload" name="payload" type="text" placeholder="\x70\x61\x79\x6c\x6f\x61\x64 (Optional)">
                                                    </div>
                                                    <div class="form-group"><label for="pps">
                                                        Packets per second
                                                        </label><input class="form-control" id="pps" name="pps" type="text" placeholder="Min: 50000, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['PPS']; ?> (Optional)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mode">
                                                    Mode
                                                    </label>
                                                    <select name="mode" id="mode" class="form-control">
                                                        <option value="0">Basic</option>
                                                        <option value="1">Premium</option>
                                                        <option value="2">Turbo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="slots">Slots</label>
                                                    <input class="form-control" id="slots" name="slots" type="text" placeholder="Min: 1, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['Concurrent'] + $Addons[1]; ?> (Optional)">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><button type="button" class="btn btn-outline-primary waves-effect waves-light btn-block pointer">Send Attack</button></div>
                                                    <div class="col-md-6"><button type="button" class="btn btn-outline-light waves-effect btn-block" data-bs-toggle="collapse" href="#AdvancedLayer4" role="button" aria-expanded="false" aria-controls="AdvancedLayer4" <?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Premium']) == false) { echo 'disabled="disabled"'; } ?>>Advanced Options</button></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="l7" role="tabpanel">
                                            <form method="POST" id="Details7">
                                                <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                                <div class="form-group">
                                                    <label>Attack Method</label>
                                                    <select class="form-control" id="method" name="method">
                                                        <optgroup style="color:#a6aaaf" label="Bypass">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 7) { if($Mv['type'] == 1) { ?>
                                                            <option value="<?php echo $Mv['id']; ?> <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>"><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                        <optgroup style="color:#a6aaaf" label="Tor Network (.onion)">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 7) { if($Mv['type'] == 2) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                        <optgroup style="color:#a6aaaf" label="Basic Flood">
                                                        <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 7) { if($Mv['type'] == 3) { ?>
                                                            <option value="<?php echo $Mv['id']; ?>" <?php if($Mv['premium'] == 1) { echo 'style="color:#fec544"'; } if($Mv['premium'] == 1 && $Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) { echo ' disabled'; } ?>><?php echo $Secure->SecureTxt($Mv['name']); ?></option>
                                                        <?php } } } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="form-group"><label>
                                                    Address
                                                    </label>
                                                    <input type="text" class="form-control" id="address" required="" name="address" maxlength="" value="" placeholder="Website: https://example.com/">
                                                </div>
                                                <div class="form-group">
                                                    <label for="time">Duration</label>
                                                    <input class="form-control" id="time" name="time" type="text" placeholder="Min: 15, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime'] + $Addons[0]; ?> sec (Optional)">
                                                </div>
                                                <div class="multi-collapse collapse" id="AdvancedLayer7" style="">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="col-form-label">Request Method</label><br>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reqmethod[]" value="0" checked="" >
                                                                <label class="form-check-label">
                                                                    GET
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reqmethod[]" value="1">
                                                                <label class="form-check-label">
                                                                    POST
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="col-form-label">Precheck</label><br> 
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reqmethod1[]" value="0" id="precheck1" checked="" >
                                                                <label class="form-check-label">
                                                                    False
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reqmethod1[]" value="1" id="precheck0">
                                                                <label class="form-check-label">
                                                                    True
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-6 col-12"><label for="rate" class="col-form-label">Requests per IP</label> <input name="rate" placeholder="Min 1, Max: 64 (Optional)" type="text" class="form-control"></div>
                                                        <div class="form-group col-6" style="display: none;"><label for="rate" class="col-form-label">StatusCode</label> <input name="statusCode" placeholder="200 (Optional)" type="text" class="form-control"></div>
                                                    </div>
                                                    <div class="form-group" style="display:none;">
                                                        <label for="post">Post Data</label>
                                                        <input class="form-control" id="post" name="post" type="text" placeholder="username=username&password=password (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hdata">Header Data</label>
                                                        <input class="form-control" id="hdata" name="hdata" type="text" placeholder="Connection: keep-alive (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="referrer">Referrer</label>
                                                        <input class="form-control" id="referrer" name="referrer" type="text" placeholder="https://google.com/search?q=%RAND% (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Host</label>
                                                        <input class="form-control" id="host" name="host" type="text" placeholder="google.com (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="origin">
                                                        Attack Origin
                                                        </label>
                                                        <select name="origin" id="origin" class="form-control">
                                                            <option value="Worldwide">Worldwide</option>
                                                            <option value="United_states">United States</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Vietnam">Vietnam</option>
                                                            <option value="China">China</option>
                                                            <option value="Hong_Kong">Hong Kong</option>
                                                            <option value="Korea">Korea</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Netherland">Netherland</option>
                                                            <option value="Poland">Poland</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mode">
                                                    Mode
                                                    </label>
                                                    <select name="mode" id="mode" class="form-control">
                                                        <option value="0">Basic</option>
                                                        <option value="1">Premium</option>
                                                        <option value="2">Turbo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="slots">Slots</label>
                                                    <input class="form-control" id="slots" name="slots" type="text" placeholder="Min: 1, Max: <?php echo $Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']+$Addons[1]; ?> (Optional)">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><button type="button" class="btn btn-outline-primary waves-effect waves-light btn-block pointer">Send Attack</button></div>
                                                    <div class="col-md-6"><button type="button" class="btn btn-outline-light waves-effect btn-block" data-bs-toggle="collapse" href="#AdvancedLayer7" role="button" aria-expanded="false" aria-controls="AdvancedLayer7" <?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Premium']) == false) { echo 'disabled="disabled"'; } ?>>Advanced Options</button></div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Running Attacks
                                    </div>
                                    <div class="card-options">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item">Stop All Attacks</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">Target</th>
                                                    <th class="wd-20p border-bottom-0">Duration</th>
                                                    <th class="wd-15p border-bottom-0">Method</th>
                                                    <th class="wd-15p border-bottom-0">Timeleft</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ALogs->LogsDataUserID($User->UserData()['id'], 0)['Response'] as $Sk => $Sv) { if($Sv['time'] + $Sv['date'] > time() && $Sv['stopped'] == 0) { if($Sv['port'] == 0) { $target = $Sv['ip']; } else { $target = $Sv['ip'].":".$Sv['port']; } ?>
                                                <tr id="<?php echo (int) $Sv['id']; ?>">
                                                    <td><?php echo $Secure->SecureTxt($target); ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['time']); ?></td>
                                                    <td><?php echo $Secure->SecureTxt(@$Methods->MethodsDataID($Sv['method'])['name']); ?></td>
                                                    <td>
                                                        <script type="text/javascript">
                                                        setTimeout(() => {
                                                            AttackTimer(<?php echo $Secure->SecureTxt($Sv['UID']); ?>,<?php echo $Sv['time'] + $Sv['date'] - time(); ?>, <?php echo (int) $Sv['id']; ?>);
                                                        }, 500);
                                                        </script>
                                                        <form method="POST" id="Stop<?php echo (int) $Sv['id']; ?>">
                                                            <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                                            <input type="hidden" id="id" name="id" value="<?php echo (int) $Sv['id']; ?>">
                                                            <button type="button" class="btn btn-danger" style="font-size: 12px; padding: 2px 5px; font-weight: bolder;">
                                                                <i class="fa fa-ban"></i> 
                                                                <span id="countdown-<?php echo $Secure->SecureTxt($Sv['UID']); ?>">0</span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>