<?php 

define('allow', TRUE);
$page = 'Deposit';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

$pricesK = file_get_contents('http://api.nomics.com/v1/currencies/ticker?key=32c401cc02ce4a9544ea9bf43351e77f&ids=BTC,ETH,XMR,DOGE,LTC&interval=1d&convert=EUR&per-page=5&page=1');
$prices = json_decode($pricesK);

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
                        <div class="col-xl-12 col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Add Balance
                                    </div>
                                </div>
                                <div class="card-body">

                                    <form id="Deposit" method="POST">
                                        <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" name="amount">
                                        </div>

                                        <center>
                                            <button type="button" class="btn social-btn btn-google mb-3" style="width: 175px;height: 150px;margin-right: 10px;margin-left: 10px; padding: 1.7rem .9rem; cursor: pointer;" name="currency" value="BTC">
                                                <img src="<?php echo $assets; ?>assets/images/coins/btc.svg"><br>
                                                <p>BTC</p>
                                                <span><strong>1 BTC</strong> ≅ €<?php echo @number_format($prices[0]->price, 0); ?></span>
                                            </button>
                                            <button type="button" class="btn social-btn btn-google mb-3" style="width: 175px;height: 150px;margin-right: 10px;margin-left: 10px; padding: 1.7rem .9rem; cursor: pointer;" name="currency" value="ETH">
                                                <img src="<?php echo $assets; ?>assets/images/coins/ethereum.png"><br>
                                                <p>ETH</p>
                                                <span><strong>1 ETH</strong> ≅ €<?php echo @number_format($prices[1]->price, 0); ?></span>
                                            </button>
                                            <button type="button" class="btn social-btn btn-google mb-3" style="width: 175px;height: 150px;margin-right: 10px;margin-left: 10px; padding: 1.7rem .9rem; cursor: pointer;" name="currency" value="XMR">
                                                <img src="<?php echo $assets; ?>assets/images/coins/xmr.svg"><br>
                                                <p>XMR</p>
                                                <span><strong>1 XMR</strong> ≅ €<?php echo @number_format($prices[3]->price, 0); ?></span>
                                            </button>
                                            <button type="button" class="btn social-btn btn-google mb-3" style="width: 175px;height: 150px;margin-right: 10px;margin-left: 10px; padding: 1.7rem .9rem; cursor: pointer;" name="currency" value="DOGE">
                                                <img src="<?php echo $assets; ?>assets/images/coins/doge.png"><br>
                                                <p>DOGE</p>
                                                <span><strong>1 DOGE</strong> ≅ €<?php echo @number_format($prices[2]->price, 5); ?></span>
                                            </button>
                                            <hr>
                                            <p>Choose the payment method you want to use.</p>
                                        </center>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Payments history
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">ID</th>
                                                    <th class="wd-15p border-bottom-0">Amount</th>
                                                    <th class="wd-15p border-bottom-0">Date</th>
                                                    <th class="wd-15p border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($Order->OrderDataUserPaid($User->UserData()['id'], 0)['Response'] as $Sk => $Sv) { ?>
                                                <tr>
                                                    <td><?php echo $Secure->SecureTxt($Sv['order_id']); ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['checkout_amount']); ?></td>
                                                    <td><?php echo date('d.m.Y H:i',$Secure->SecureTxt($Sv['timestamp'])); ?></td>
                                                    <td><a class="btn btn-outline-primary btn-sm btn-block" href="<?php echo $assets; ?>invoice/<?php echo $Secure->SecureTxt($Sv['order_id']); ?>" type="button"><i class="mdi mdi-pencil"></i></a></td>
                                                </tr>
                                                <?php } ?>
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