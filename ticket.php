<?php 

define('allow', TRUE);
$page = 'Ticket';

include_once('main/public/header.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

$tID = (int) $Secure->SecureTxt($GET['id']);

if(empty($tID)) {
    $Alert->SaveAlert('Invalid Ticket.', 'error');
    echo '<script>PageContent("support")</script>';
    die();
}

if(!($Support->ticketByID($tID, $User->UserData()['id'])['Count']) == true) {
    $Alert->SaveAlert('Invalid Ticket.', 'error');
    echo '<script>PageContent("support")</script>';
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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Messages
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-conversation p-3">
                                        <ul class="list-unstyled mb-0" data-simplebar="init" style="max-height: 486px;">
                                            <div class="simplebar-wrapper" style="margin: 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 0px;">
                                                                <?php foreach ($Support->ticketByID($tID, $User->UserData()['id'])['Response'] as $Vk => $Vv) { ?>
                                                                <li>
                                                                    <div class="conversation-list">
                                                                        <div class="ctext-wrap">
                                                                            <div class="conversation-name"><?php echo $Secure->SecureTxt($User->UserData()['Username']); ?></div>
                                                                            <p><?php echo $Secure->SecureTxt($Vv['Message']); ?></p>
                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $Secure->get_timeago($Vv['created']); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } ?> <?php foreach ($Support->answOnTicketList($tID) as $Sk => $Sv) { if (empty($Sv['supportID'])) { ?>
                                                                <li>
                                                                    <div class="conversation-list">
                                                                        <div class="ctext-wrap">
                                                                            <div class="conversation-name"><?php echo $Secure->SecureTxt($User->UserData()['Username']); ?></div>
                                                                            <p><?php echo $Secure->SecureTxt($Sv['Message']); ?></p>
                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $Secure->get_timeago($Sv['lastactivity']); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } else { ?>
                                                                <li class="right">
                                                                    <div class="conversation-list">
                                                                        <div class="ctext-wrap">
                                                                            <div class="conversation-name"><?php echo $Secure->SecureTxt($Admin->AdminDataID($Sv['supportID'], 1)['Username']); ?></div>
                                                                            <p><?php echo $Secure->SecureTxt($Sv['Message']); ?></p>
                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $Secure->get_timeago($Sv['lastactivity']); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } } ?>
                                                                <div id="scroll"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 639px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 369px; transform: translate3d(0px, 117px, 0px); display: block;"></div>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="p-3 chat-input-section">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <form id="AnswerTicket" method="POST">
                                                        <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                                        <input hidden name="tID" value="<?php echo $tID; ?>">
                                                        <textarea name="Message" type="text" class="form-control chat-input" placeholder="Enter Message..."></textarea>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Ticket <?php echo $tID; ?>
                                    </div>
                                </div>
                                <div class="card-box">
                                    <?php foreach ($Support->ticketByID($tID, $User->UserData()['id'])['Response'] as $Sk => $Sv) { ?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td class="text-white" style="width: 50%"><?php if($Secure->SecureTxt($Sv['Status']) == 0) { echo '<span class="badge bg-light">Closed</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 1) { echo '<span class="badge bg-danger">Open</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 2) { echo '<span class="badge bg-danger">Waiting for Response</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 3) { echo '<span class="badge bg-success">Answered</span>'; } else if ($Secure->SecureTxt($Sv['Status']) == 2) { echo '<span class="badge bg-success">Open</span>'; } else if($Secure->SecureTxt($Sv['Status']) == 3) { echo '<span class="badge bg-success">Answered</span>'; } else { echo '<span class="badge bg-light">Closed</span>'; } ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Update</th>
                                                <td class="text-white" style="width: 50%"><?php echo $Secure->SecureTxt(date('d.m.Y H:i:s', $Sv['lastactivity'])); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <form id="CloseTicket" class="col-xl-12" method="POST" autocomplete="off" class="comment-area-box mb-3">
                                            <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $csrftoken; ?>">
                                            <input hidden name="tID" value="<?php echo $tID; ?>">
                                            <div class="form-group"><button type="button" class="btn btn-danger w-sm waves-effect waves-light btn-block"><i class="far fa-times-circle"></i> Close</button></div>
                                        </form>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="<?php echo $assets; ?>support" class="btn btn-light w-sm waves-effect waves-light btn-block"><i class="far fa-arrow-alt-circle-left"></i> Go back</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('main/public/footer.php'); ?>