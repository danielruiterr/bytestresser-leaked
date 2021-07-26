<?php

// Includes
define('allow', true);
define('api', true);
include_once('../includes.php');

// GET Info
$GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

// Define
$userID = @$GET['user'];
$api_key = @$GET['api_key'];
$stopper = @$GET['stopper'];
$error = '';

if(empty($stopper)) {
	$message = array(
		"message" => "Please fill all fields."
	);
		
	// Json App Header
	header("Content-Type: application/json");
	// Encode
	$print = json_encode($message);
	// Print
	print_r($print);
	die();
}

if(empty($userID)) {
	$message = array(
		"message" => "UserID cant be empty."
	);
		
	// Json App Header
	header("Content-Type: application/json");
	// Encode
	$print = json_encode($message);
	// Print
	print_r($print);
	die();
}

if(empty($api_key)) {
	$message = array(
		"message" => "API Key cant be empty."
	);
		
	// Json App Header
	header("Content-Type: application/json");
	// Encode
	$print = json_encode($message);
	// Print
	print_r($print);
	die();
}

// Check is valid API v1
if($Api->UsersApiDataID($api_key, 1)['api_key'] != $api_key) {
    if($Plan->PlanDataID($User->UserDataID(@$userID, 1)['Plan'])['API'] == 0) {
        // Message
        $message = array(
            "status" => 'false',
            "message" => "Invalid User ID / API key."
        );
        // Json App Header
        header("Content-Type: application/json");
        // Encode
        $print = json_encode($message);
        // Print
        print_r($print);
        die();
    }
}

// Is Plan Expired
if($User->UserDataID(@$userID, 1)['Expire'] < time()) {
	// Message
	$message = array(
		"status" => 'false',
		"message" => "Your Plan is expired."
	);
	// Json App Header
	header("Content-Type: application/json");
	// Encode
	$print = json_encode($message);
	// Print
	print_r($print);
	die();
}

// Check is IP Whlitelisted
$WL = $Api->UsersApiDataID($api_key, 1)['WhiteList'];
$IpExplode = explode('|',$Secure->ApiIps($WL));

if(filter_var($IpExplode[0], FILTER_VALIDATE_IP)) {
	if($IpExplode[0] != $User->UserIP()) {
		if($IpExplode[1] != $User->UserIP()) {
			if($IpExplode[2] != $User->UserIP()) {
				// Message
				$message = array(
					"status" => 'false',
					"message" => "This ip is not White Listed"
				);
				// Json App Header
				header("Content-Type: application/json");
				// Encode
				$print = json_encode($message);
				// Print
				print_r($print);
				die();
			}
		}
	}
}

if ($ALogs->LogsDataStopper($stopper, 1)['userID'] != $userID) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "This is not your attack."
        );
        $error = true;
    }
}

if ($ALogs->LogsDataStopper($stopper, 1)['stopped'] != 0) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "This attack is stopped."
        );
        $error = true;
    }
}

if ($ALogs->LogsDataStopper($stopper, 1)['date'] + $ALogs->LogsDataStopper($stopper, 1)['time'] < time()) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "This attack is expired."
        );
        $error = true;
    }
}

if($error == false) {
// Stop Function
    $ch = curl_init($Api->ApiDataID($ALogs->LogsDataStopper($stopper, 1)['handler'], 1)['link']."&stop=1&stopper=$stopper");

    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);$data = curl_exec($ch);

    $info = curl_getinfo($ch);

    if(curl_errno($ch)) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataStopper($stopper, 1)['handler'], 1)['name']
            );
            $error = true;
        }
    }

    curl_close($ch);

    if ($data === FALSE) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataStopper($stopper, 1)['handler'], 1)['name']
            );
            $error = true;
        }
    }

    // Message
    $response = json_decode($data, true);
    $status = $response['status'];
    $rmessage = $response['message'];

    if($status == 'true') {
        $DataBase->Query("UPDATE `attack_logs` SET `stopped`='1' WHERE `UID`=:uID");
        $DataBase->Bind(':uID', $stopper);

        $update = $DataBase->Execute();

        if($update == false) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Error on update! Please contact Support!'
                );
                $error = true;
            }
        }

        // Log
        $Logs->CreateLog($userID, 'User stopped every attack.');

        $message = array(
            "status" => 'true',
            "message" => $rmessage
        );
        $error = false;
    } else if($status == 'false') {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => $rmessage
            );
            $error = true;
        }
    } else {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'Error. Please contact support!'
            );
            $error = true;
        }
    }
}

if(empty($message)) {
	$message = array(
		"status" => 'false',
		"message" => 'Undefined'
	);
}

// Json App Header
header("Content-Type: application/json");
// Encode
$print = json_encode($message);
// Print
print_r($print);
die();