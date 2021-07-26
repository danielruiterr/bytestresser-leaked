<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Methods {

	public function MethodsDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `methods` ORDER BY `id` ASC");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function MethodsData($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `methods` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function MethodsDataID($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `methods` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function MethodsDataName($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `methods` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function AddMethod($Name, $Layer, $Type, $Premium, $Description) {
		global $DataBase;

		// Insert in Base
		$DataBase->Query("INSERT INTO `methods` (`id`, `name`, `type`, `premium`, `layer`, `description`) VALUES (NULL, :Name, :Type, :Premium, :Layer, :Description);");
		$DataBase->Bind(':Name', $Name);
		$DataBase->Bind(':Type', $Type);
		$DataBase->Bind(':Premium', $Premium);
		$DataBase->Bind(':Description', $Description);
		$DataBase->Bind(':Layer', $Layer);

		return $DataBase->Execute();
	}

	public function ChangeMethod($Name, $Layer, $Type, $Premium, $Description, $id) {
		global $DataBase;

		$DataBase->Query("UPDATE `methods` SET `name`=:Name, `layer`=:Layer, `Type`=:Type, `Premium`=:Premium, `description`=:Description WHERE `id`=:uID");
		$DataBase->Bind(':Name', $Name);
		$DataBase->Bind(':Layer', $Layer);
		$DataBase->Bind(':Type', $Type);
		$DataBase->Bind(':Premium', $Premium);
		$DataBase->Bind(':Description', $Description);
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function DeleteMethod($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `methods` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

}

?>
