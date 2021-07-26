<?php 

define('allow', TRUE);

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
  die();
}

if (!($User->IsLoged()) == true) {
    $Alert->LoginAlert('Login.', 'error');
    header('Location: login.php');
    die();
}

$tID = (int) $Secure->SecureTxt($GET['id']);

if(empty($tID)) {
    $Alert->ASaveAlert('Invalid Ticket.', 'error');
    header('Location: ticket_list.php');
    die();
}

?>
<div class="content-page">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ticket</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            
            <div class="row no-gutters">
                <div class="col-lg-12 col-xl-12">
                    <div class="card-box">

                        <div class="tab-content">
                            
                            <div class="tab-pane show active">

                                <?php foreach ($Support->ticketByIDAdmin($tID)['Response'] as $Vk => $Vv) { ?>
                                <div class="border border-light p-2 mb-3">
                                    <div class="media">
                                        <img class="mr-2 avatar-sm rounded-circle" src="assets/images/users/user-3.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <a href="user.php?id=<?php echo (int) $Secure->SecureTxt($Vv['userID']); ?>"><h5 class="m-0"><?php echo $Secure->SecureTxt($User->UserDataID($Vv['userID'], 1)['Username']); ?></h5></a>
                                            <p class="text-muted"><small><?php echo $Secure->get_timeago($Vv['created']); ?></small></p>
                                        </div>
                                    </div>
                                    <p><?php echo $Secure->SecureTxt($Vv['Message']); ?></p>
                                </div>
                                <?php } ?> <?php foreach ($Support->answOnTicketList($tID) as $Sk => $Sv) { if (empty($Sv['supportID'])) { ?>
                                <div class="border border-light p-2 mb-3">
                                    <div class="media">
                                        <img class="mr-2 avatar-sm rounded-circle" src="assets/images/users/user-3.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                        <a href="user.php?id=<?php echo (int) $Secure->SecureTxt($Vv['userID']); ?>"><p class="text-muted"><h5 class="m-0"><?php echo $Secure->SecureTxt($User->UserDataID($Vv['userID'], 1)['Username']); ?></h5></a>
                                            <p class="text-muted"><small><?php echo $Secure->SecureTxt($Sv['Date']); ?></small></p>
                                        </div>
                                    </div>
                                    <p><?php echo $Secure->SecureTxt($Sv['Message']); ?></p>
                                </div>
                                <?php } else { ?>
                                <div class="border border-light p-2 mb-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <img class="avatar-sm rounded-circle" src="assets/images/users/user-3.jpg" alt="Generic placeholder image" style="float: right;">
                                            <h5 class="align-right" style="margin-right: 46px;">Support</h5>
                                            <p class="text-muted align-right" style="margin-right: 46px;"><small><?php echo $Secure->SecureTxt($Sv['Date']); ?></small></p>
                                        </div>
                                    </div>
                                    <p class="align-right"><?php echo $Secure->SecureTxt($Sv['Message']); ?></p>
                                </div>
                                <?php } } ?>

                                <form id="AnswerTicket" method="POST" autocomplete="off" class="comment-area-box mt-2 mb-3">
                                    <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                    <input hidden name="tID" value="<?php echo $tID; ?>">
                                    <span class="input-icon">
                                        <textarea rows="2" name="Message" class="form-control" placeholder="Write something..." style="margin-top: 0px; margin-bottom: 0px; height: 76px;"></textarea>
                                    </span>
                                    <div class="comment-area-btn">
                                        <span onclick="AnswerTicket()" class="btn btn-sm btn-dark waves-effect waves-light">Send</span>
                                        <span onclick="CloseTicket()" class="btn btn-sm btn-dark waves-effect waves-light ml-1">Close</span>
                                    </div>
                                </form>

                                
                            </div>

                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->
                </div><!-- end col -->
            </div>
            <!-- end row -->    
            
        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo date('Y'); ?> &copy; <a href="https://bytestresser.com">ByteStresser.com</a> 
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    <?php include 'public/footer.php'; ?>