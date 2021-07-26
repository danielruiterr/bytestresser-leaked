<?php 

define('allow', TRUE);
$page = 'Helpdesk';

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
                        <div class="block block-rounded block-transparent card">
                            <div class="card-header">
                                <div class="card-title">
                                All Methods List &amp; Description
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="searchTable">
                                        <tbody class="">
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: Layer 7</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">ID</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Name</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Type</th>
                                                <th class="font-w500">Description</th>
                                            </tr>
                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 7) { ?>
                                            <tr class="border-0 text-center">
                                                <td><?php echo $Secure->SecureTxt($Mv['id']); ?></td>
                                                <td><?php echo $Secure->SecureTxt($Mv['name']); ?></td>
                                                <td>Layer7</td>
                                                <td><?php echo $Mv['description']; ?></td>
                                            </tr>
                                            <?php } } ?>
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: AMP</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">ID</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Name</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Type</th>
                                                <th class="font-w500">Description</th>
                                            </tr>
                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 1) { ?>
                                            <tr class="border-0 text-center">
                                                <td><?php echo $Secure->SecureTxt($Mv['id']); ?></td>
                                                <td><?php echo $Secure->SecureTxt($Mv['name']); ?></td>
                                                <td>IPv4 (L4)</td>
                                                <td><?php echo $Mv['description']; ?></td>
                                            </tr>
                                            <?php } } } ?>
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: TCP</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">ID</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Name</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Type</th>
                                                <th class="font-w500">Description</th>
                                            </tr>
                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 2) { ?>
                                            <tr class="border-0 text-center">
                                                <td><?php echo $Secure->SecureTxt($Mv['id']); ?></td>
                                                <td><?php echo $Secure->SecureTxt($Mv['name']); ?></td>
                                                <td>IPv4 (L4)</td>
                                                <td><?php echo $Mv['description']; ?></td>
                                            </tr>
                                            <?php } } } ?>
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: UDP</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">ID</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Name</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Type</th>
                                                <th class="font-w500">Description</th>
                                            </tr>
                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 3) { ?>
                                            <tr class="border-0 text-center">
                                                <td><?php echo $Secure->SecureTxt($Mv['id']); ?></td>
                                                <td><?php echo $Secure->SecureTxt($Mv['name']); ?></td>
                                                <td>IPv4 (L4)</td>
                                                <td><?php echo $Mv['description']; ?></td>
                                            </tr>
                                            <?php } } } ?>
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: Premium</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">ID</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Name</th>
                                                <th class="text-center  font-w500" style="width: 20%;">Type</th>
                                                <th class="font-w500">Description</th>
                                            </tr>
                                            <?php foreach ($Methods->MethodsDataAll()['Response'] as $Mk => $Mv) { if($Mv['layer'] == 4) { if($Mv['type'] == 4) { ?>
                                            <tr class="border-0 text-center">
                                                <td><?php echo $Secure->SecureTxt($Mv['id']); ?></td>
                                                <td><?php echo $Secure->SecureTxt($Mv['name']); ?></td>
                                                <td>IPv4 (L4)</td>
                                                <td><?php echo $Mv['description']; ?></td>
                                            </tr>
                                            <?php } } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="block block-rounded block-transparent card">
                            <div class="card-header">
                                <div class="card-title">
                                API Parameters
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="searchTable">
                                        <tbody class="">
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: Layer 4</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">Var</th>
                                                <th class="text-center font-w500" style="width: 30%;">Information</th>
                                                <th class="text-center font-w500" style="width: 10%;">Type</th>
                                                <th class="text-center font-w500" style="width: 10%;">Optional</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>target</td>
                                                <td>IPv4 Target 0.0.0.0</td>
                                                <td>string</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>port</td>
                                                <td>Port dest (1-65535)</td>
                                                <td>integer</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>duration</td>
                                                <td>Attack Duration (15+)</td>
                                                <td>integer</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>method</td>
                                                <td>Attack Method</td>
                                                <td>integer</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>pps</td>
                                                <td>Packets per second (50000+)</td>
                                                <td>integer</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>payload</td>
                                                <td>Packet Payload (\x70\x61\x79\x6c\x6f\x61\x64)</td>
                                                <td>string</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="">
                                                <th class="font-weight-semibold bg-light" colspan="4"><i class="fa fa-project-diagram"></i> Category: Layer 7</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <th style="width: 10%;">Var</th>
                                                <th class="text-center font-w500" style="width: 30%;">Information</th>
                                                <th class="text-center font-w500" style="width: 10%;">Type</th>
                                                <th class="text-center font-w500" style="width: 10%;">Optional</th>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>target</td>
                                                <td>URL Target (https://example.com)</td>
                                                <td>string</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>duration</td>
                                                <td>Attack Duration (15+)</td>
                                                <td>integer</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>method</td>
                                                <td>Attack Method</td>
                                                <td>integer</td>
                                                <td>false</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>reqmethod</td>
                                                <td>Requst Method (GET/POST)</td>
                                                <td>integer</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>rate</td>
                                                <td>Requests Per IP (1-64)</td>
                                                <td>integer</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>precheck</td>
                                                <td>Status Code Precheck (true/false)</td>
                                                <td>integer</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>statuscode</td>
                                                <td>Status Code Precheck (1-999)</td>
                                                <td>integer</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>hdata</td>
                                                <td>Header Data (Connection...)</td>
                                                <td>string</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>referrer</td>
                                                <td>URL Referrer (https://example.com)</td>
                                                <td>string</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>host</td>
                                                <td>URL Host (http://0.0.0.0)</td>
                                                <td>string</td>
                                                <td>true</td>
                                            </tr>
                                            <tr class="border-0 text-center">
                                                <td>origin</td>
                                                <td>Worldwide, United_states, Germany, Brazil, Thailand, Vietnam, China, Hong_Kong, Korea, Japan, Italy, Netherland, Poland, France</td>
                                                <td>string</td>
                                                <td>true</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
