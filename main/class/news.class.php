<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class News {

	public function NewsDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `news` ORDER BY `id` DESC");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function NewsDataID($id, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `news` WHERE `id` = :ID");
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

	public function AddNews($Title, $Message) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `news` (`id`, `Title`, `Message`, `Date`, `Timestamp`) VALUES (NULL, :Title, :Message, :Date, :Timestamp);");
		$DataBase->Bind(':Title', $Title);
		$DataBase->Bind(':Message', $Message);
		$DataBase->Bind(':Date', date('d.m.Y H:i:a', time()));
		$DataBase->Bind(':Timestamp', time());

		return $DataBase->Execute();
	}

	public function ChangeNews($Title, $Message, $id) {
		global $DataBase;

		$DataBase->Query("UPDATE `news` SET `Title`=:Title, `Message`=:Message, `Date`=:Date, `Timestamp`=:Timestamp WHERE `id`=:uID");
		$DataBase->Bind(':Title', $Title);
		$DataBase->Bind(':Message', $Message);
		$DataBase->Bind(':Date', date('d.m.Y H:i:a', time()));
		$DataBase->Bind(':Timestamp', time());
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function DeleteNews($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `news` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

}

?>
