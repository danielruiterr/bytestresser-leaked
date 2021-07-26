<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Admin {

	public function AdminDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `admins`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function AdminData() {
		global $DataBase;

		if(isset($_SESSION['AdminLogin'])) {
			$DataBase->Query("SELECT * FROM `admins` WHERE `id` = :ID");
			$DataBase->Bind(':ID', $_SESSION['AdminLogin']['ID']);
			$DataBase->Execute();

			return $DataBase->Single();
		} else {
			return false;
		}
	}

	public function AdminDataByUsername($Username) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `admins` WHERE `Username` = :Username");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount()
		);

		return $Return;
	}

	public function AdminDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `admins` WHERE `id` = :ID");
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

	public function AdminDataIDSignle($uID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `admins` WHERE `id` = :uID");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function ChangeUser($userID, $Username, $Plan, $Expire, $Money, $Status, $Pw, $Addons) {
		global $DataBase;
		global $User;
		global $Secure;
		global $lang;

		if(!$Pw == '0') {
			$DataBase->Query("UPDATE `users` SET `Username`=:Username,`Plan`=:Plan,`Expire`=:Expire,`Money`=:Money,`Status`=:Status,`Password`=:Pw, `Addons`=:Addons WHERE `id`=:uID");
			$DataBase->Bind(':Username', $Username);
			$DataBase->Bind(':Plan', $Plan);
			$DataBase->Bind(':Expire', $Expire);
			$DataBase->Bind(':Money', $Money);
			$DataBase->Bind(':Status', $Status);
			$DataBase->Bind(':Pw', $Secure->encrypt($Pw));
			$DataBase->Bind(':Addons', $Addons);
			$DataBase->Bind(':uID', $userID);

			$ez = $DataBase->Execute();

			if($ez == false) {
				$rMsg = ['error', 'Error'];
				echo json_encode($rMsg);
				die();
			} else {
				$rMsg = ['success', 'Successfully Executed!'];
				echo json_encode($rMsg);
				die();
			}
		} else {
			$DataBase->Query("UPDATE `users` SET `Username`=:Username,`Plan`=:Plan,`Expire`=:Expire,`Money`=:Money,`Status`=:Status, `Addons`=:Addons WHERE `id`=:uID");
			$DataBase->Bind(':Username', $Username);
			$DataBase->Bind(':Plan', $Plan);
			$DataBase->Bind(':Expire', $Expire);
			$DataBase->Bind(':Money', $Money);
			$DataBase->Bind(':Status', $Status);
			$DataBase->Bind(':Addons', $Addons);
			$DataBase->Bind(':uID', $userID);

			$ez = $DataBase->Execute();

			if($ez == false) {
				$rMsg = ['error', 'Error'];
				echo json_encode($rMsg);
				die();
			} else {
				$rMsg = ['success', 'Successfully Executed!'];
				echo json_encode($rMsg);
				die();
			}
		}
	}

	public function DeleteUser($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `users` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `attack_logs` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `logs` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `payments` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `tickets` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `tickets_answ` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();

		$DataBase->Query("DELETE FROM `users_api` WHERE `userID`=:uID");
		$DataBase->Bind(':uID', $id);

		$DataBase->Execute();
	}

	public function AddAdmin($Username, $Password, $Type) {
		global $DataBase;
		global $Secure;

		// Insert in Base
		$DataBase->Query("INSERT INTO `admins` (`id`, `Username`, `Password`, `Type`) VALUES (NULL, :Username, :Password, :Type);");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Bind(':Password', $Secure->encrypt($Password));
		$DataBase->Bind(':Type', $Type);

		return $DataBase->Execute();
	}

	public function ChangeAdmin($Username, $Password, $Type, $id) {
		global $DataBase;
		global $Secure;

		if($Password != '0') {
			$DataBase->Query("UPDATE `admins` SET `Username`=:Username, `Password`=:Password, `Type`=:Type WHERE `id`=:uID");
			$DataBase->Bind(':Username', $Username);
			$DataBase->Bind(':Password', $Secure->encrypt($Password));
			$DataBase->Bind(':Type', $Type);
			$DataBase->Bind(':uID', $id);
		} else {
			$DataBase->Query("UPDATE `admins` SET `Username`=:Username, `Type`=:Type WHERE `id`=:uID");
			$DataBase->Bind(':Username', $Username);
			$DataBase->Bind(':Type', $Type);
			$DataBase->Bind(':uID', $id);
		}

		return $DataBase->Execute();
	}

	public function DeleteAdmin($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `admins` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function ChangeApiAccess($id, $api_key, $AttackTime, $Slots, $Premium, $whitelist) {
		global $DataBase;
		global $Api;
		global $Plan;
		global $Logs;
		global $Secure;
		global $User;

		$IpExplode = explode('|',$Secure->ApiIps($whitelist));
		
		if(!empty($whitelist)) {

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
		$wl = @$IpExplode[0]."|".@$IpExplode[1]."|".@$IpExplode[2];

		// Insert in DB
		$DataBase->Query("UPDATE `users_api` SET `api_key`=:api_key, `AttackTime`=:AttackTime, `Slots`=:Slots, `Premium`=:Premium, `WhiteList`=:WhiteList WHERE `id`=:ID");
		$DataBase->Bind(':AttackTime', $AttackTime);
		$DataBase->Bind(':Slots', $Slots);
		$DataBase->Bind(':Premium', $Premium);
		$DataBase->Bind(':api_key', $api_key);
		$DataBase->Bind(':WhiteList', $wl);
		$DataBase->Bind(':ID', $id);

		$return = $DataBase->Execute();

		if($return == false) {
			$rMsg = ['error', 'Error.'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['success', 'Successfully Executed.'];
			echo json_encode($rMsg);
			die();
		}
	}

	public function DeleteUsersAPI($id) {
		global $DataBase;

		// Insert in DB
		$DataBase->Query("DELETE FROM `users_api` WHERE `id`=:ID");
		$DataBase->Bind(':ID', $id);

		$return = $DataBase->Execute();

		if($return == false) {
			$rMsg = ['error', 'Error.'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['success', 'Successfully Executed.'];
			echo json_encode($rMsg);
			die();
		}
	}

	public function AddTimeAllUsers($Time) {
		global $DataBase;

		// Insert in DB
		$DataBase->Query("UPDATE `users` SET `Expire` = `Expire` + :Time WHERE `Expire` > UNIX_TIMESTAMP() - 1209600");
		$DataBase->Bind(':Time', $Time);

		$return = $DataBase->Execute();

		if($return == false) {
			$rMsg = ['error', 'Error.'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['success', 'Successfully Executed.'];
			echo json_encode($rMsg);
			die();
		}
	}

	public function ClearLogs($type) {
		global $DataBase;

		if($type == 'attack_logs') {
			$DataBase->Query("DELETE FROM `attack_logs` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'blacklist') {
			$DataBase->Query("DELETE FROM `blacklist` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'logs') {
			$DataBase->Query("DELETE FROM `logs` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'news') {
			$DataBase->Query("DELETE FROM `news` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'payments') {
			$DataBase->Query("DELETE FROM `payments` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'tickets') {
			$DataBase->Query("DELETE FROM `tickets` WHERE 1=1");
			$DataBase->Execute();

			$DataBase->Query("DELETE FROM `ticket_answ` WHERE 1=1");
			$DataBase->Execute();
		} else if($type == 'users_api') {
			$DataBase->Query("DELETE FROM `users_api` WHERE 1=1");

			$DataBase->Execute();
		} else if($type == 'users') {
			$DataBase->Query("DELETE FROM `users` WHERE `Username` != 'Jerry'");

			$DataBase->Execute();
		}

		$rMsg = ['success', 'Successfully Executed.'];
		echo json_encode($rMsg);
		die();
	}

	public function LogIn($Username, $Password) {
		global $DataBase;
		global $User;
		global $Alert;
		global $Secure;

		$DataBase->Query("SELECT * FROM `admins` WHERE `Username` = :Username");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Execute();

		$UserData 	= $DataBase->Single();

		$UserCount 	= $DataBase->RowCount();

		$Provera = $Secure->encrypt($Password) == $UserData['Password'];

		if($UserCount == true && $Provera) {
			$_SESSION['AdminLogin']['ID'] = $UserData['id'];

			if(isset($_COOKIE['accept_cookie']) && $_COOKIE['accept_cookie'] == '1') {
				// Get Current date, time
				$current_time = time();

				// Set Cookie expiration for 1 month
				$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month

				setcookie('member_login', '1', $cookie_expiration_time);
				//Set Secure Cookies -> HttpOnly
				setcookie('l0g1n', $UserData['Token'].'_'.$UserData['id'], $cookie_expiration_time, '/', null, null, TRUE);
			}

			@$_SESSION['attemp']['num'] = 0;

			$Alert->SaveAlert('Welcome back!', 'success');
			header('Location: index.php');
			die();
		} else {
			@$_SESSION['attemp']['num'] = @$_SESSION['attemp']['num'] + 1;
	
			$Alert->SaveAlert('This account doesnt exist.', 'error');
			header('Location: login.php');
			die();
		}
	}

	public function IsLoged() {
		global $Admin;

		if(isset($_SESSION['AdminLogin'])) {
			return true;
		} else {
			return false;
		}
	}

}

?>
