<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $POST['incoming_id']);
        $output = "";
        $outputer = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] !== $outgoing_id){
                    $outputer .= Secure($row['msg_id']."|");
                }
            }

            $outputer1 = explode("|", $outputer);
            $output .= max($outputer1);

            if(empty($output)) {
                $outpu .= "";
            }
        }else{
            $output .= "";
        }

        if(empty($output)) {
            echo '0';
        } else {
            echo $output;
        }
    }else{
        header("location: ../login.php");
    }

    // echo '123';

?>