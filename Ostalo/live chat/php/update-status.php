<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $myid = $_SESSION['unique_id'];
        $time = time();
        $sql = mysqli_query($conn, "UPDATE `users` SET `status` = '$time' WHERE `users`.`unique_id` = $myid;");
        if(!$sql) {
            echo 'error';
        } else {
            echo 'success';
        }
    }else{
        header("location: ../login.php");
    }
?>