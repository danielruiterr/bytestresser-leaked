<?php 

define('allow', TRUE);
define('pages', TRUE);

include_once('../../includes.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

?>
<div class="table-responsive">
    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                <th>Server Name</th>
                <th>Status</th>
                <th>Server Load</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { if($Av['layer'] == 4) {
                
            $load = ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100;
            if($load == 0) {
                $klasa = 'progress-bar-empty';
                $loaded = '100';
                $load = 0;
            } else {
                $klasa = 'progress-bar';
                $loaded = number_format($load, 0);
                $load = number_format($load, 0);
            }

            
            if($load > 80 ) {
                $boja = 'bg-danger';
            } else if($load > 40) {
                $boja = 'bg-warning';
            } else {
                $boja = '';
            } ?><tr>
                <th><?php echo $Secure->SecureTxt($Av['name']); ?></th>
                <td><?php if($Av['status'] == 1) { echo '<span class="badge badge-success">ONLINE</span>'; } else { echo '<span class="badge badge-light-danger">OFFLINE</span>'; } ?></td>
                <td><?php echo '<div class="progress mb-0"><div class="'.$klasa.' '.$boja.'" role="progressbar" style="width: '.$loaded.'%;" aria-valuenow="'.$loaded.'" aria-valuemin="0" aria-valuemax="100">'.$load.'%</div></div>'; ?></td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>