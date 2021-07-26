<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Logs {

	public function LogsDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `logs`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function LoginsToday() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `logs` WHERE `timestamp` > :time AND `action` = 'Logged in'");
		$DataBase->Bind(":time", time() - 86400);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function LogsDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `logs` WHERE `userID` = :ID");
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

    public function CreateLog($userID, $Text) {
		global $DataBase;
		global $User;
		global $Secure;

		$Ip = $Secure->encrypt($User->UserIP());

		// if($User->UserData()['id'] == 1) {
		// 	return true;
		// } else {
			$DataBase->Query("INSERT INTO `logs` (`id`, `userID`, `action`, `timestamp`, `ip`) VALUES (NULL, :userID, :action, :timestamp, :ip);");
			$DataBase->Bind(':userID', $userID);
			$DataBase->Bind(':action', $Text);
			$DataBase->Bind(':timestamp', time());
			$DataBase->Bind(':ip', $Ip);

			return $DataBase->Execute();
		// }
	}

}

?>