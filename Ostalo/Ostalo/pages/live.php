<?php 

define('allow', TRUE);
define('pages', TRUE);

include_once('../../includes.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

if($_SERVER['HTTP_REFERER'] !== 'https://warzone.to/panel') {
	header("Location: /index.php?error");
	header("HTTP/1.0 404 Not Found");
}

?>
<div id="msg_alert"><?php echo $Alert->PrintAlert(); ?></div>

<script type="text/javascript">
setTimeout(function() {
    document.getElementById('msg_alert').innerHTML = "<?php echo $Alert->RemoveAlert(); ?>";
}, 5000);
</script>

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

        <!-- start page title -->
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">Live Chat</h4>

                    <div class="tab-content">
                        
                        <div class="tab-pane show active">

                            <div id="LiveChat"></div>

                            <form id="LiveChat" method="POST" autocomplete="off" class="comment-area-box mt-2 mb-3">
                                <input hidden name="tID" value="<?php echo $tID; ?>">
                                <span class="input-icon">
                                    <textarea rows="2" name="Message" class="form-control" placeholder="Write something..." style="margin-top: 0px; margin-bottom: 0px; height: 76px;"></textarea>
                                </span>
                                <div class="comment-area-btn">
                                    <span onclick="AnswerLive()" class="btn btn-sm btn-dark waves-effect waves-light">Send</span>
                                    <span onclick="ExitLive()" class="btn btn-sm btn-dark waves-effect waves-light">End</span>
                                </div>
                            </form>

                            
                        </div>

                    </div> <!-- end tab-content -->
                </div> <!-- end card-box-->
            </div><!-- end col -->
        </div>
        <!-- end row -->    
        
    </div> <!-- container -->

</div>

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

<!-- App js -->
<script src="../libs/jquery-toast/jquery.toast.min.js"></script>
<script src="../js/toast.js"></script>

<script type="text/javascript">
    function GetChat(){
        var oldscrollHeight = $("#LiveChat").attr("scrollHeight") - 20;
        $.ajax({
            url: "live_chat.php",
            cache: false,
            success: function(html){
                $("#LiveChat").html(html);
                var newscrollHeight = $("#LiveChat").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#LiveChat").animate({ scrollTop: newscrollHeight }, 'normal');
                }              
            },
        });
    }

    GetChat();

    var ChatInt = setInterval(function(){ GetChat() }, 2500);
</script>