<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Support {

	/* Ticket List */
	public function ticketsList() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` ORDER by `id` ASC");
		$DataBase->Execute();

		$Return = Array(
			'Response' 	=> $DataBase->ResultSet(),
			'Count' 	=> $DataBase->RowCount(),
		);
		return $Return;
	}

	/* Ticket List */
	public function ticketsToday() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `created` > :time");
		$DataBase->Bind(":time", time() - 86400);
		$DataBase->Execute();

		$Return = Array(
			'Response' 	=> $DataBase->ResultSet(),
			'Count' 	=> $DataBase->RowCount(),
		);
		return $Return;
	}

	/* Ticket List */
	public function ticketsListByUserID($userID, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `userID`=:userID ORDER BY `id` DESC");
		$DataBase->Bind(':userID', $userID);
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

	/* Ticket List Opened */
	public function ticketsListByUserIDOpen($userID, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `userID`=:userID AND `Status`='1' OR `userID`=:userID AND `Status`='2' OR `userID`=:userID AND `Status`='3' ORDER BY `id` DESC");
		$DataBase->Bind(':userID', $userID);
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

	/* Ticket List Opened */
	public function ticketsListByUserIDAnswered($userID, $num) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `userID`=:userID AND `Status`='3' ORDER BY `id` DESC");
		$DataBase->Bind(':userID', $userID);
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

	/* Ticket Counter */
	public function ticketsByUser($userID, $num) {
		global $DataBase;

		if($num == 0) {
			$DataBase->Query("SELECT * FROM `tickets` WHERE `userID`=:userID AND `Status`='1' OR `Status`='2' OR `Status`='3'");
			$DataBase->Bind(':userID', $userID);
			$DataBase->Execute();
		} else {
			$DataBase->Query("SELECT * FROM `tickets` WHERE `userID`=:userID AND `Status`='0'");
			$DataBase->Bind(':userID', $userID);
			$DataBase->Execute();
		}

		return $DataBase->RowCount();
	}

	/* New Ticket */
	public function newTicket($Subject, $Message, $userID) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `tickets` (`id`, `Subject`, `Message`, `Status`, `userID`, `lastactivity`, `created`) VALUES (NULL, :Subject, :Message, :Status, :userID, :lastactivity, :created);");
		$DataBase->Bind(':Subject', $Subject);
		$DataBase->Bind(':Message', $Message);
		$DataBase->Bind(':Status', '1');
		$DataBase->Bind(':userID', $userID);
		$DataBase->Bind(':lastactivity', time());
		$DataBase->Bind(':created', time());

		return $DataBase->Execute();
	}

	/* Ticket By ID */
	public function ticketByID($tID, $userID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `id` = :tID AND `userID` = :userID");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();

		$Return = Array(
			'Response' 	=> $DataBase->ResultSet(),
			'Count' 	=> $DataBase->RowCount(),
		);
		return $Return;
	}


	/* Ticket By ID */
	public function ticketByIDAdmin($tID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `id` = :tID");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Execute();

		$Return = Array(
			'Response' 	=> $DataBase->ResultSet(),
			'Count' 	=> $DataBase->RowCount(),
		);
		return $Return;
	}

	/* Ticket By ID */
	public function ticketByIDSingle($tID, $userID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `tickets` WHERE `id` = :tID AND `userID` = :userID");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	/* Add Answer */
	public function answOnTicket($tID, $userID, $supportID, $Message) {
		global $DataBase;
		global $Support;

		$DataBase->Query("INSERT INTO `ticket_answ` (`id`, `tID`, `userID`, `supportID`, `Message`, `Date`, `lastactivity`) VALUES (NULL, :tID, :userID, :supportID, :Message, :Date, :lastactivity);");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Bind(':supportID', $supportID);
		$DataBase->Bind(':Message', $Message);
		$DataBase->Bind(':Date', date('d/m/Y, H:ia'));
		$DataBase->Bind(':lastactivity', time());

		return $DataBase->Execute();
	}

	/* Add Answer Admin */
	public function answOnTicketAdmin($tID, $AdminID, $supportID, $Message) {
		global $DataBase;
		global $Support;

		$DataBase->Query("INSERT INTO `ticket_answ` (`id`, `tID`, `userID`, `supportID`, `Message`, `Date`, `lastactivity`) VALUES (NULL, :tID, :userID, :supportID, :Message, :Date, :lastactivity);");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Bind(':supportID', $supportID);
		$DataBase->Bind(':Message', $Message);
		$DataBase->Bind(':Date', date('d/m/Y, H:ia'));
		$DataBase->Bind(':lastactivity', time());

		return $DataBase->Execute();
	}

	/* Update Ticket */
	public function upStatusOnTicket($tID, $Status) {
		global $DataBase;
		
		$DataBase->Query("UPDATE `tickets` SET `Status` = :Status WHERE `id` = :tID;");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':Status', $Status);

		return $DataBase->Execute();
	}

	/* Update LastActivity */
	public function upActivityOnTicket($tID) {
		global $DataBase;
		
		$DataBase->Query("UPDATE `tickets` SET `lastactivity` = :LA WHERE `id` = :tID;");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Bind(':LA', time());

		return $DataBase->Execute();
	}

	/* Answer on Ticket list */
	public function answOnTicketList($tID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `ticket_answ` WHERE `tID` = :tID ORDER by id ASC");
		$DataBase->Bind(':tID', $tID);
		$DataBase->Execute();

		return $DataBase->ResultSet();
	}

}