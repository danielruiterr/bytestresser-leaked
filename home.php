<?php 

define('allow', TRUE);
$page = 'Home';

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
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Clients</p>
                                          <h4 class="mb-0"><?php echo (int) $User->UserDataAll()['Count']; ?></h4>
                                       </div>
                                       <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                          <span class="avatar-title">
                                          <i class="mdi mdi-account-multiple-plus card-custom-icon icon-dropshadow-info font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Online Boots</p>
                                          <h4 class="mb-0"><?php echo (int) $ALogs->LogsDataRunning()['Count']; ?></h4>
                                       </div>
                                       <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                          <span class="avatar-title rounded-circle bg-primary">
                                          <i class="mdi mdi-alarm-check card-custom-icon icon-dropshadow-secondary font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Boots</p>
                                          <h4 class="mb-0"><?php echo (int) $ALogs->LogsDataAll()['Count']; ?></h4>
                                       </div>
                                       <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                          <span class="avatar-title rounded-circle bg-primary">
                                          <i class="mdi mdi-alarm card-custom-icon icon-dropshadow-warning font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-8 col-lg-8 col-md-12">
                        <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">
                              News
                              </div>
                           </div>
                           <div class="card-body">
                              <div id="scrollbar3" class="latest-timeline scrollbar3" data-simplebar="">
                                 <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                       <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                       <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                          <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                             <div class="card">
                                                <div class="card-body">
                                                   <ul class="verti-timeline list-unstyled">
                                                      <?php foreach ($News->NewsDataAll()['Response'] as $Nk => $Nv) { ?>
                                                      <li class="event-list">
                                                         <div class="event-timeline-dot">
                                                               <i class="bx bx-right-arrow-circle"></i>
                                                         </div>
                                                         <div class="media">
                                                            <div class="media-body">
                                                               <div>
                                                                  <div class="d-flex "><span><h5><?php echo $Secure->SecureTxt($Nv['Title']); ?></h5></span><span class="ml-auto text-muted fs-11"><?php echo $Secure->SecureTxt(date('H:i - F d, Y', $Nv['Timestamp'])); ?></span></div>
                                                                  <p class="text-muted"><?php echo $Nv['Message']; ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </li>
                                                      <?php } ?>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 907px;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                       <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                       <div class="simplebar-scrollbar" style="height: 138px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <div class="card-title">
                              Profile Info
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table mb-0">
                                    <tbody>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Username</span></td>
                                             <td class="py-2 px-0"><?php echo $Secure->SecureTxt($User->UserData()['Username']); ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Balance</span></td>
                                             <td class="py-2 px-0">&euro; <?php echo (int) $User->UserData()['Money']; ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Plan Name</span></td>
                                             <td class="py-2 px-0"><?php if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Name']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Name']); } else { echo 'n/a'; }?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Attack Duration</span></td>
                                             <td class="py-2 px-0"><?php $Addons = explode('|', $User->UserData()['Addons']); if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']) + $Addons[0]; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Concurrents</span></td>
                                             <td class="py-2 px-0"><?php if(!empty($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']))) { echo $Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']) + $Addons[1]; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Premium</span></td>
                                             <td class="py-2 px-0"><?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Premium']) == true) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else if($Addons[2] == 1) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Turbo</span></td>
                                             <td class="py-2 px-0"><?php if($Addons[3] == 1) { echo '<i class="bx mr-2 bx-check text-success"></i>'; } else { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">API Access</span></td>
                                             <td class="py-2 px-0"><?php if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['API']) == false) { echo '<i class="bx mr-2 bx-x text-danger"></i>'; } else { echo '<i class="bx mr-2 bx-check text-success"></i>'; } ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Expires</span></td>
                                             <td class="py-2 px-0"><?php if($User->UserData()['Expire'] > time()) { echo date('d.m.Y', $User->UserData()['Expire']); } else if($User->UserData()['Expire'] == 1) { echo 'Expired'; } else { echo 'n/a'; } ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-12  col-md-12">
                           <div class="card">
                              <div class="card-header">
                                 <div class="card-title">
                                 Our Network
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Usage</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Network</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { if($Av['layer'] == 4) {
                                             $load = ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100;
                                 
                                             if($load < 35 ) {
                                                $boja = 'bg-success';
                                             } else if($load < 70) {
                                                $boja = 'bg-warning';
                                             } else if($load < 100) {
                                                $boja = 'bg-warning';
                                             } ?>
                                             <tr>
                                                <th class="font-weight-bold"><?php echo $Secure->SecureTxt($Av['name']); ?></th>
                                                <td>
                                                   <div class="progress h-2  mt-1" data-toggle="tooltip" data-placement="top" title="<?php echo $Api->CountApiOfAttacks($Av['id'])."/".$Av['slots'] ?>">
                                                         <div class="progress-bar <?php echo $boja; ?>" role="progressbar" style="width: <?php echo ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100; ?>%" aria-valuenow="<?php echo ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                   </div>
                                                </td>
                                                <td class="text-center"><span class="badge bg-primary">Layer4</span></td>
                                                <td class="text-center"><span class="badge bg-primary">Regular</span></td>
                                                <td class="text-center"><?php if($Av['status'] == true) { echo '<i class="fa fa-check mr-1 text-success"></i> Online'; } else { echo '<i class="fa fa-times mr-1 text-danger"></i> Offline'; } ?></td>
                                             </tr>
                                             <?php } } ?>
                                             <?php foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { if($Av['layer'] == 7) {
                                             $load = ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100;
                                 
                                             if($load < 35 ) {
                                                $boja = 'bg-success';
                                             } else if($load < 70) {
                                                $boja = 'bg-warning';
                                             } else if($load < 100) {
                                                $boja = 'bg-warning';
                                             } ?>
                                             <tr>
                                                <th class="font-weight-bold"><?php echo $Secure->SecureTxt($Av['name']); ?></th>
                                                <td>
                                                   <div class="progress h-2  mt-1" data-toggle="tooltip" data-placement="top" title="<?php echo $Api->CountApiOfAttacks($Av['id'])."/".$Av['slots'] ?>">
                                                         <div class="progress-bar <?php echo $boja; ?>" role="progressbar" style="width: <?php echo ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100; ?>%" aria-valuenow="<?php echo ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                   </div>
                                                </td>
                                                <td class="text-center"><span class="badge bg-primary">Layer7</span></td>
                                                <td class="text-center"><span class="badge bg-primary">Regular</span></td>
                                                <td class="text-center"><?php if($Av['status'] == true) { echo '<i class="fa fa-check mr-1 text-success"></i> Online'; } else { echo '<i class="fa fa-times mr-1 text-danger"></i> Offline'; } ?></td>
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
<?php
include_once('main/public/footer.php');
?>
