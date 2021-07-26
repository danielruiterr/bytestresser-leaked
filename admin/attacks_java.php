<?php 

define('allow', TRUE);
define('admin', TRUE);

include_once('../inc.php');

if (!($Admin->IsLoged()) == true) {
    $Alert->LoginAlert('First Login.', 'error');
    header('Location: login.php');
    die();
}

if($Admin->AdminData()['Type'] < 1) {
    $Alert->ASaveAlert('you are not permited.', 'error');
    header('Location: index.php');
    die();
}

?>
<?php foreach ($ALogs->LogsDataAll($User->UserData()['id'])['Response'] as $Sk => $Sv) { 
$Timer = $Sv['date'] + $Sv['time'] - time(); if($Timer > 0) { ?><script>

    var count_<?php echo $Sv['id']; ?> = <?php echo $Timer; ?>;
    var counter_<?php echo $Sv['id']; ?> = setInterval(counter<?php echo $Sv['id']; ?>, 1000);

    function counter<?php echo $Sv['id']; ?>(){
        count_<?php echo $Sv['id']; ?> = count_<?php echo $Sv['id']; ?> - 1;

        if (count_<?php echo $Sv['id']; ?> <= 0){
            clearInterval(counter_<?php echo $Sv['id']; ?>);
            return;
        }
        $('#counter_<?php echo $Sv['id']; ?>').html(count_<?php echo $Sv['id']; ?>);
    }
</script>
<?php } } ?>