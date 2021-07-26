<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class BlackList {

	public function BlackListDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `blacklist` ORDER BY `id` ASC");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function BlackListData($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `blacklist` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function BlackListDataID($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `blacklist` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function AddBlackList($Word, $Expires) {
		global $DataBase;

		// Insert in Base
		$DataBase->Query("INSERT INTO `blacklist` (`id`, `word`, `expires`) VALUES (NULL, :Word, :Expires);");
		$DataBase->Bind(':Word', $Word);
		$DataBase->Bind(':Expires', $Expires);

		return $DataBase->Execute();
	}

	public function ChangeBlackList($Word, $Expires, $id) {
		global $DataBase;

		$DataBase->Query("UPDATE `blacklist` SET `word`=:Word, `expires`=:Expires WHERE `id`=:uID");
		$DataBase->Bind(':Word', $Word);
		$DataBase->Bind(':Expires', $Expires);
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function DeleteBlackList($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `blacklist` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function BuyBlackList($Word, $Price, $Expires) {
		global $DataBase;
		global $User;
		global $BlackList;
		global $Logs;

		// Check do he have enough money
		if($User->UserData()['Money'] < $Price) {
			$rMsg = ['error', 'You dont have enough money.'];
			echo json_encode($rMsg);
			die();
		}

		// Update Money
		$UserID = $User->UserData()['id'];
		$NewBalance = $User->UserData()['Money'] - $Price;

		$DataBase->Query("UPDATE `users` SET `Money`=:MoneyUpdate WHERE `id`=:uID");
		$DataBase->Bind(':MoneyUpdate', $NewBalance);
		$DataBase->Bind(':uID', $UserID);

		$MoneyUpdate = $DataBase->Execute();

		if($MoneyUpdate == false) {
			$rMsg = ['error', 'Fail on Money Update!'];
			echo json_encode($rMsg);
			die();
		}

		// foreach ($BlackList->BlackListDataAll()['Response'] as $BLk => $BLv) {
		// 	if(strpos($Word, $BLv['word'])) {
		// 		if($BLv['expires'] > time()) {
		// 			$rMsg = ['error', 'This domain is blacklisted.'];
		// 			echo json_encode($rMsg);
		// 			die();
		// 		}
		// 	}
		// }

		// Insert in Base
		$DataBase->Query("INSERT INTO `blacklist` (`id`, `word`, `expires`) VALUES (NULL, :Word, :Expires);");
		$DataBase->Bind(':Word', $Word);
		$DataBase->Bind(':Expires', $Expires);

		$AddBlacklist = $DataBase->Execute();

		if($AddBlacklist == false) {
			$rMsg = ['error', 'Error. Please contact support!'];
			echo json_encode($rMsg);
			die();
		}

		// Log Payment
		$Logs->CreateLog($User->UserData()['id'], 'User bought blcaklist on '.$Word);

		$rMsg = ['success', 'You have successfully purchased the blacklist on '.$Word.'!'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
		echo json_encode($rMsg);
		die();
	}

}

?>
