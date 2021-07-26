<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class ALogs {

	public function LogsDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs`");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function LogsDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `id` = :ID ORDER BY `date` DESC");
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

	public function LogsDataUserID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `userID` = :ID ORDER BY `id` DESC LIMIT 25");
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

	public function LogsDataStopper($stopper, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `UID` = :stopper");
		$DataBase->Bind(':stopper', $stopper);
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

	public function LogsDataRunning() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function LogsDataRunningOnAPI($apiID, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `apiID` = :apiID");
		$DataBase->Bind(':apiID', $apiID);
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

	public function MapLogs() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE  `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function LastUserAttack($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `userID` = :userID");
		$DataBase->Bind(':userID', $id);
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

	public function UserAttacks($uID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `attack_logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `userID`  = :uID");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

    public function CreateLog($User, $UID, $Ip, $Port, $Time, $Method, $Handler, $apiID) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `attack_logs` (`id`, `UID`, `userID`, `ip`, `port`, `time`, `method`, `date`, `stopped`, `handler`, `apiID`) VALUES (NULL, :UID, :userID, :ip, :port, :time, :method, :date, '0', :handler, :apiID);");
		$DataBase->Bind(':userID', $User);
		$DataBase->Bind(':UID', $UID);
		$DataBase->Bind(':ip', $Ip);
		$DataBase->Bind(':port', $Port);
		$DataBase->Bind(':time', $Time);
		$DataBase->Bind(':method', $Method);
		$DataBase->Bind(':date', time());
		$DataBase->Bind(':handler', $Handler);
		$DataBase->Bind(':apiID', $apiID);

		return $DataBase->Execute();
	}

}

?>