<?php 

define('allow', TRUE);
$page = 'Deposit';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

$pricesK = file_get_contents('http://api.nomics.com/v1/currencies/ticker?key=32c401cc02ce4a9544ea9bf43351e77f&ids=BTC,ETH,XMR,DOGE,LTC,USDT&interval=1d&convert=EUR&per-page=6&page=1');
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Deposit
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="crypto-buy-sell-nav">
                                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#buy" role="tab" aria-selected="true">
                                                Cryptocurrencies
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#sell" role="tab" aria-selected="false">
                                                Stablecoin
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content crypto-buy-sell-nav-content p-4">
                                            <div class="tab-pane active" id="buy" role="tabpanel">
                                                <form id="DepositC" method="POST">
                                                    <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                                    <div class="mb-2">
                                                        <label>Currency :</label>
    
                                                        <div class="row">
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="bitcoin" class="card-radio-input">
            
                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[0]->logo_url; ?>" width="24">
                                                                                <span>Bitcoin</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">€ <?php echo @number_format($prices[0]->price, 0); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="ethereum" class="card-radio-input">
            
                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[1]->logo_url; ?>" height="24">
                                                                                <span>Ethereum</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">€ <?php echo @number_format($prices[1]->price, 0); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="monero" class="card-radio-input">

                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[5]->logo_url; ?>" width="24">
                                                                                <span>Monero</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">€ <?php echo @number_format($prices[5]->price, 0); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="doge" class="card-radio-input">

                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[3]->logo_url; ?>" width="24">
                                                                                <span>Doge</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">€ <?php echo @number_format($prices[3]->price, 5); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="litecoin" class="card-radio-input">

                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[4]->logo_url; ?>" width="24">
                                                                                <span>Litecoin</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">€ <?php echo @number_format($prices[4]->price, 0); ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="number" class="form-control" name="amount">
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button type="button" class="btn btn-success">Deposit</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane" id="sell" role="tabpanel">
                                                <form id="DepositS" method="POST">
                                                    <input hidden id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">

                                                    <div class="mb-2">
                                                        <label>Currency :</label>
    
                                                        <div class="row">
                                                            <div class="col-xl-2 col-sm-4">
                                                                <div class="mb-3">
                                                                    <label class="card-radio-label mb-2">
                                                                        <input type="radio" name="currency" value="usdt" class="card-radio-input">

                                                                        <div class="card-radio">
                                                                            <div>
                                                                                <img src="<?php echo @$prices[2]->logo_url; ?>" width="24">
                                                                                <span>USDT</span>
                                                                            </div>
                                                                        </div>
                                                                    </label>

                                                                    <div>
                                                                        <p class="text-muted mb-1">Current price :</p>
                                                                        <h5 class="font-size-16">$ 1</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="number" class="form-control" name="amount">
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button type="button" class="btn btn-success">Deposit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Deposits
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">ID</th>
                                                    <th class="wd-15p border-bottom-0">Amount</th>
                                                    <th class="wd-15p border-bottom-0">Coin</th>
                                                    <th class="wd-15p border-bottom-0">Date</th>
                                                    <th class="wd-15p border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($Order->OrderDataUser($User->UserData()['id'], 0)['Response'] as $Sk => $Sv) { if($Sv['invoice_status'] == 1 || $Sv['invoice_expires'] > time()) { ?>
                                                <tr>
                                                    <td><?php echo $Secure->SecureTxt($Sv['order_id']); ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['Price']); ?></td>
                                                    <td><?php echo $Secure->SecureTxt($Sv['checkout_currency']); ?></td>
                                                    <td><?php echo date('d.m.Y H:i',$Secure->SecureTxt($Sv['timestamp'])); ?></td>
                                                    <td><a class="btn btn-outline-primary btn-sm btn-block" href="<?php echo $assets; ?>invoice/<?php echo $Secure->SecureTxt($Sv['order_id']); ?>" type="button"><i class="mdi mdi-pencil"></i></a></td>
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