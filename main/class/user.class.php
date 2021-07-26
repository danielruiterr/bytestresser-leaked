<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class User {

	public function UserDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function UserDataPaid() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `Plan` != '0' AND `Expire` > :time");
		$DataBase->Bind(':time', time());
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function UserData() {
		global $DataBase;

		if(isset($_SESSION['UserLogin'])) {
			$DataBase->Query("SELECT * FROM `users` WHERE `id` = :ID");
			$DataBase->Bind(':ID', $_SESSION['UserLogin']['ID']);
			$DataBase->Execute();

			return $DataBase->Single();
		} else {
			return false;
		}
	}

	public function UserDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `id` = :ID");
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

	public function UserIP() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
    }

	public function ChangePassword($Password, $User) {
		global $DataBase;
		global $Logs;

		$DataBase->Query("UPDATE `users` SET `Password`=:Pass WHERE `id`=:uID");
		$DataBase->Bind(':Pass', $Password);
		$DataBase->Bind(':uID', $User);

		$DataBase->Execute();

		// Log
		$Logs->CreateLog($User, 'User Changed Password.');
	}

	public function LogIn($Username, $Password) {
		global $DataBase;
		global $Alert;
		global $Logs;
		global $User;

		$DataBase->Query("SELECT * FROM `users` WHERE `Username` = :Username");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Execute();

		$UserData 	= $DataBase->Single();
		$UserCount 	= $DataBase->RowCount();

        @$Provera = $Password == $UserData['Password'];

		if($UserCount == true && $Provera) {
			if ($UserData['Status'] == '0') {
				$rMsg = ['error', 'Account Suspended.'];
				echo json_encode($rMsg);
				die();
			} else {
				$_SESSION['UserLogin']['ID'] = $UserData['id'];
				$_SESSION['token'] = bin2hex(random_bytes(32));
				@$_SESSION['attemp']['num'] = 0;

				// Log
				$Logs->CreateLog($User->UserData()['id'], 'Logged in');

                // Log
				$rMsg = ['success', 'Success.'];
				echo json_encode($rMsg);
				die();
			}
		} else {
			@$_SESSION['attemp']['num'] = @$_SESSION['attemp']['num'] + 1;

			$rMsg = ['error', 'Account not found.'];
			echo json_encode($rMsg);
			die();
		}
	}

	public function Register($Username, $Pass) {
		global $DataBase;
		global $Secure;
		global $Alert;
		global $Logs;

		$DataBase->Query("SELECT * FROM `users` WHERE `Username` = :Username");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Execute();

		$UsernameE 		= $DataBase->RowCount();

		// If Username exist
		if ($UsernameE == true) {
			$rMsg = ['error', 'This username is already taken.'];
			echo json_encode($rMsg);
			die();
		}

		// Insert in Base
		$DataBase->Query("INSERT INTO `users` (`id`, `Username`, `Password`, `Plan`, `Expire`, `Money`, `Status`, `Addons`) VALUES (NULL, :Username, :Pass, '0', '0', '0', '1', '0|0|0|0');");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Bind(':Pass', $Pass);

		$DataBase->Execute();

		// Generate CSRF
		$_SESSION['token'] = bin2hex(random_bytes(32));

		// Send Message
		$rMsg = ['success', 'Success.'];
		echo json_encode($rMsg);
		die();
	}

	public function IsLoged() {
		global $User;

		if(isset($_SESSION['UserLogin'])) {
			return true;
		} else {
			return false;
		}
	}

}

?>