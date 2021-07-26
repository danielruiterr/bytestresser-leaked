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

<link href="<?php echo $assets; ?>assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

<div class="content">

    <!-- Start Content-->
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $User->UserDataAll()['Count'] + 2856; ?></span></h3>
                                <p class="text-primary mb-1 text-truncate">Customers</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Support->ticketsList()['Count'] + 2068; ?></span></h3>
                                <p class="text-warning mb-1 text-truncate">Total Tickets</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $ALogs->LogsDataAll()['Count'] + 168500; ?></span></h3>
                                <p class="text-success mb-1 text-truncate">Total Boots</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Api->ApiDataAll()['Count'] + 10; ?></span></h3>
                                <p class="text-danger mb-1 text-truncate">Total Servers</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title">Popup with Video or Map</h4>
                    <p class="sub-header">
                        Entered data is not lost if you open and close the popup or if you go to another page and then press back browser button.
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <a class="popup-youtube btn btn-light mt-2 mt-sm-0" href="http://www.youtube.com/watch?v=7pFEitIyo1w">Open YouTube Video</a>
                            <a class="popup-vimeo btn btn-light mt-2 mt-sm-0" href="https://vimeo.com/45830194">Open Vimeo Video</a>
                            <a class="popup-gmaps btn btn-light mt-2 mt-sm-0" href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom">Open Google Map</a>
                        </div>
                    </div>
                    
                </div> <!-- end card-box-->
            </div>

            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title">Lightbox Gallery</h4>
                    <p class="sub-header">
                        Examples of lightbox image gallery.
                    </p>

                    <div class="popup-gallery">

                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-3">
                                <a href="<?php echo $assets; ?>assets/images/small/img-1.jpg" title="Project 1">
                                    <div class="img-responsive">
                                        <img src="<?php echo $assets; ?>assets/images/small/img-1.jpg" alt="" class="img-fluid">
                                    </div>
                                </a>
                            </div> <!-- end col-->
                            <div class="col-3">
                                <a href="a<?php echo $assets; ?>ssets/images/small/img-2.jpg" title="Project 2">
                                    <div class="img-responsive">
                                        <img src="<?php echo $assets; ?>assets/images/small/img-2.jpg" alt="" class="img-fluid">
                                    </div>
                                </a>
                            </div> <!-- end col-->
                            <div class="col-3">
                                <a href="<?php echo $assets; ?>assets/images/small/img-3.jpg" title="Project 3">
                                    <div class="img-responsive">
                                        <img src="<?php echo $assets; ?>assets/images/small/img-3.jpg" alt="" class="img-fluid">
                                    </div>
                                </a>
                            </div> <!-- end col-->
                            <div class="col-3">
                                <a href="<?php echo $assets; ?>assets/images/small/img-4.jpg" title="Project 4">
                                    <div class="img-responsive">
                                        <img src="<?php echo $assets; ?>assets/images/small/img-4.jpg" alt="" class="img-fluid">
                                    </div>
                                </a>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- end .popup-gallery-->
                    
                </div> <!-- end card-box-->
            </div>
        </div>
        
    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?php echo date('Y'); ?> &copy; <a href="https://warzone.to">Warzone.to</a> 
            </div>
            <div class="col-md-6">
                <!-- <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">OnlyFans</a>
                </div> -->
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

<?php
include_once('public/footer.php');
?>

<!-- Magnific Popup-->
<script src="<?php echo $assets; ?>assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Tour init js-->
<script src="<?php echo $assets; ?>assets/js/pages/lightbox.init.js"></script>