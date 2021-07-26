<?php 
    session_start();
    include_once "config.php";
    $csrf = mysqli_real_escape_string($conn, $_POST['_csrf']);
	if ($csrf != $csrftoken) {
        echo "Invalid CSRF.";
	} else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if(!empty($email) && !empty($password)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $user_pass = md5($password);
                $enc_pass = $row['password'];
                if($user_pass === $enc_pass){
                    $status = time();
                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                    if($sql2){
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo "success";

                        $myid = $_SESSION['unique_id'];
                        $time = time();
                        $sql = mysqli_query($conn, "UPDATE `users` SET `status` = '$time' WHERE `users`.`unique_id` = $myid;");
                        // if(!$sql) {
                        //     echo 'error';
                        // }
                        $_SESSION['token'] = bin2hex(random_bytes(32));
                    }else{
                        echo "Something went wrong. Please try again!";
                    }
                }else{
                    echo "Email or Password is Incorrect!";
                }
            }else{
                echo "$email - This email not Exist!";
            }
        }else{
            echo "All input fields are required!";
        }
    }
?>