<?php 

define('allow', TRUE);
$page = 'Shop';

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
                    <div class="row row-sm">
                        <?php $ok = 0; if($ok == 1) { foreach ($Plan->PlanDataAll()['Response'] as $Kv => $Vv) { ?>
                        <div class="col-sm-6 col-lg-3" style="margin-bottom: 15px;">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <div class="card-title">
                                    <?php echo $Secure->SecureTxt($Vv['Name']); ?>
                                    </div>
                                </div>
                                <div class="card-body text-center crde">
                                    <div class="display-4 font-weight-semibold">
                                        € <?php echo $Secure->SecureTxt($Vv['Price']); ?>
                                    </div>
                                    <ul class="list-unstyled leading-loose">
                                        <li><i class="fa fa-check text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['AttackTime']); ?> seconds</li>
                                        <li><i class="fa fa-check text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['Concurrent']); ?> concurrent</li>
                                        <li><i class="fa fa-check text-success mr-2"></i> 30 days</li>
                                        <li><i class="fa <?php if($Vv['Premium'] == false) { echo 'fa-times text-danger'; } else { echo 'fa-check text-success mr-2'; } ?>"></i> Premium</li>
                                        <li><i class="fa <?php if($Vv['API'] == false) { echo 'fa-times text-danger'; } else { echo 'fa-check text-success mr-2'; } ?>"></i> API Access</li>
                                    </ul>
                                    <div class="text-center mt-6">
                                        <form method="POST" id="Pay<?php echo (int) $Vv['id']; ?>">
                                            <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                            <?php if($User->UserData()['Plan'] != $Vv['id']) { ?>
                                            <button type="button" class="btn btn-lg btn-primary btn-block">Pay</button>
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-lg btn-primary btn-block" disabled>Paid</button>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } else { foreach ($Plan->PlanDataAll()['Response'] as $Kv => $Vv) { ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card plan-box">
                                <div class="card-header">
                                    <div class="card-title">
                                    <?php echo $Secure->SecureTxt($Vv['Name']); ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="py-4">
                                        <h2><sup><small>$</small></sup> <?php echo $Secure->SecureTxt($Vv['Price']); ?>/<span class="font-size-13">Per month</span></h2>
                                    </div>

                                    <div class="plan-features mb-4">
                                        <p><i class="bx bx-checkbox-square text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['AttackTime']); ?> seconds</p>
                                        <p><i class="bx bx-checkbox-square text-success mr-2"></i> <?php echo $Secure->SecureTxt($Vv['Concurrent']); ?> concurrent</p>
                                        <p><i class="bx bx-checkbox-square text-<?php if($Vv['Premium'] == false) { echo 'danger'; } else { echo 'success'; } ?> mr-2"></i> Premium</p>
                                        <p><i class="bx bx-checkbox-square text-<?php if($Vv['API'] == false) { echo 'danger'; } else { echo 'success'; } ?> mr-2"></i> API Access</p>
                                    </div>

                                    <div class="text-center plan-btn">
                                        <?php if($User->UserData()['Plan'] != $Vv['id']) { ?>
                                        <form method="POST" id="Pay<?php echo (int) $Vv['id']; ?>">
                                            <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Buy</button>
                                        </form>
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" disabled>Paid</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Addons</h4>
                                <!-- <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $page; ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo $page; ?></li>
                                    </ol>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Blacklist Monthly
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="bl1">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="address" maxlength="30" placeholder="Host: 0.0.0.0 / Example.com">
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Total cost: 
                                                    <bb class="badge bg-primary">
                                                        <i class="bx bx-euro"></i> 
                                                        <bb id="cost-Monthly"> 15</bb>
                                                    </bb>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary text-white float-end">Buy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Blacklist Lifetime
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="bl2">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="address" maxlength="30" placeholder="Host: 0.0.0.0 / Example.com">
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Total cost: 
                                                    <bb class="badge bg-primary">
                                                        <i class="bx bx-euro"></i> 
                                                        <bb id="cost-Lifetime"> 200</bb>
                                                    </bb>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary text-white float-end">Buy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Add Seconds
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-xs-12">
                                        <form method="POST" id="addSeconds">
                                            <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                            <select class="form-control" type="text" id="seconds" name="seconds" onchange="checkseconds()">
                                                <option value="0">Select</option>
                                                <option value="1">--&gt; 600 Sec</option>
                                                <option value="2">--&gt; 1200 Sec</option>
                                                <option value="3">--&gt; 1800 Sec</option>
                                                <option value="4">--&gt; 2400 Sec</option>
                                                <option value="5">--&gt; 3000 Sec</option>
                                                <option value="6">--&gt; 3600 Sec</option>
                                                <option value="7">--&gt; 4200 Sec</option>
                                                <option value="8">--&gt; 4800 Sec</option>
                                                <option value="9">--&gt; 5400 Sec</option>
                                                <option value="10">--&gt; 6000 Sec</option>
                                                <option value="11">--&gt; 6600 Sec</option>
                                                <option value="12">--&gt; 7200 Sec</option>
                                                <option value="13">--&gt; 7800 Sec</option>
                                                <option value="14">--&gt; 8400 Sec</option>
                                                <option value="15">--&gt; 9000 Sec</option>
                                                <option value="16">--&gt; 9600 Sec</option>
                                                <option value="17">--&gt; 10200 Sec</option>
                                                <option value="18">--&gt; 10800 Sec</option>
                                                <option value="19">--&gt; 11400 Sec</option>
                                                <option value="20">--&gt; 12000 Sec</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="form-group text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                Total Cost:
                                                <bb class="badge bg-primary" id="ani">
                                                    <i class="bx bx-euro"></i> 
                                                    <bb id="cost-sec"> 0</bb>
                                                </bb>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary text-white float-end">Buy
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Add Concurrents
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-sx-12">
                                        <form method="POST" id="addConcurrents">
                                            <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                            <select class="form-control" type="text" id="concu" name="concu" onchange="checkconcu()">
                                                <option value="0">Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="form-group text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                Total Cost: 
                                                <bb class="badge bg-primary" id="ani2">
                                                    <i class="bx bx-euro"> </i> 
                                                    <bb id="cost-concu"> 0</bb>
                                                </bb>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary text-white float-end">Buy
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Premium
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="AddPremium">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="form-group text-right">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Total cost: 
                                                    <bb class="badge bg-primary">
                                                        <i class="bx bx-euro"></i> 
                                                        50
                                                    </bb>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary text-white float-end">Buy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6 box-col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Turbo
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="AddTurbo">
                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="form-group text-right">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Total cost: 
                                                    <bb class="badge bg-primary">
                                                        <i class="bx bx-euro"></i> 
                                                        100
                                                    </bb>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary text-white float-end">Buy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>

<script type="text/javascript">
function checkseconds() {
    var price = $('#seconds').val() * 10;
    $("#cost-sec").text(price)
}

function checkconcu() {
    var price = $('#concu').val() * 35;
    $("#cost-concu").text(price)
}
</script>