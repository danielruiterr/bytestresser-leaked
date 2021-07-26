<?php 

define('allow', TRUE);

include_once('public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

?>
<div id="msg_alert"><?php echo $Alert->PrintAlert(); ?></div>

<script type="text/javascript">
setTimeout(function() {
    document.getElementById('msg_alert').innerHTML = "<?php echo $Alert->RemoveAlert(); ?>";
}, 5000);
</script>

<div class="content">

    <div class="container-fluid">
        
        <div class="row no-gutters mt-30" style="margin-bottom: 24px;">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary">
                                <i class="fe-tag font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span><?php echo $User->UserDataAll()['Count'] + 2856; ?></span></h3>
                                <p class="text-primary mb-1 text-truncate">Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning">
                                <i class="fe-clock font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span><?php echo $Support->ticketsList()['Count'] + 2068; ?></span></h3>
                                <p class="text-warning mb-1 text-truncate">Total Tickets</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success">
                                <i class="fe-check-circle font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span><?php echo $ALogs->LogsDataAll()['Count'] + 168500; ?></span></h3>
                                <p class="text-success mb-1 text-truncate">Total Boots</p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle bg-soft-danger rounded-0 card-box mb-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-danger">
                                <i class="fe-server font-22 avatar-title text-danger"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span><?php echo $Api->ApiDataAll()['Count'] + 10; ?></span></h3>
                                <p class="text-danger mb-1 text-truncate">Total Servers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" dir="ltr">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" onclick="AttackMap()" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase" role="button" aria-expanded="true" aria-controls="cardCollpase" class=""><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-3">LIVE ATTACK MAP</h4>
                        <div id="cardCollpase" class="mapcontainer">
                            <div class="map"></div>
                            <div style="display:none;" id="AttackMap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" dir="ltr">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" onclick="L7()" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="true" aria-controls="cardCollpase1" class=""><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-3">SERVERS - LAYER7</h4>
                        <div id="cardCollpase1">
                            <div id="l7"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" dir="ltr">
                        <div class="card-widgets">
                            <a href="javascript: void(0);" onclick="L4()" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="true" aria-controls="cardCollpase2" class=""><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-3">SERVERS - LAYER4</h4>
                        <div id="cardCollpase1">
                            <div id="l4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="timeline" dir="ltr">

                    <article class="timeline-item">
                        <h2 class="m-0 d-none">&nbsp;</h2>
                        <div class="time-show mt-0">
                            <a href="javascript:void(0);" class="btn btn-danger width-lg">NEWS</a>
                        </div>
                    </article>

                    <?php
                    
                    for ($i=0; $i < $News->NewsDataAll()['Count']; $i++) {

                    foreach ($News->NewsDataAll()['Response'] as $Nk => $Nv) {
                    $i = $i + 1;
                    ?><article class="timeline-item<?php if($i % 2 == 0) { echo ' timeline-item-left'; } ?>">
                        <div class="timeline-desk">
                            <div class="timeline-box">
                                <span class="arrow<?php if($i % 2 == 0) { echo '-alt'; } ?>"></span>
                                <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                <h4 class="mt-0 font-16"><?php echo $Secure->SecureTxt($Nv['Title']); ?></h4>
                                <p class="text-muted"><small><?php echo $Secure->SecureTxt(date('d.m.Y H:i:a', $Nv['Timestamp'])); ?></small></p>
                                <p class="mb-0"><?php echo $Secure->SecureTxt($Nv['Message']); ?> </p>
                            </div>
                        </div>
                    </article><?php } } ?>
                    
                </div>
            </div>
        </div>
        
    </div>

</div>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo date('Y'); ?> &copy; <a href="https://stresser.pro/">Stresser.Pro</a> 
            </div>
        </div>
    </div>
</footer>

<?php
include_once('public/footer.php');
?>
<script src="<?php echo $assets; ?>assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo $assets; ?>assets/libs/peity/jquery.peity.min.js"></script>
<script src="<?php echo $assets; ?>assets/js/knob.js"></script>

<script src="<?php echo $assets; ?>assets/libs/raphael/raphael.min.js"></script>
<script src="<?php echo $assets; ?>assets/libs/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo $assets; ?>assets/libs/jquery-mapael/world_countries.min.js"></script>

<script src="<?php echo $assets; ?>assets/libs/jquery-toast/jquery.toast.min.js"></script>

<script src="<?php echo $assets; ?>assets/js/home-assets.js"></script>