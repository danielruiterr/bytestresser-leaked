<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Plan {

	public function PlanDataAll() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `plans` ORDER BY `id` ASC");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function PlanData($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `plans` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function PlanDataID($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `plans` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function AddPlan($Name, $Price, $AttackTime, $Concurrents, $PPS, $API, $Premium, $Layer4, $Layer7) {
		global $DataBase;

		// Insert in Base
		$DataBase->Query("INSERT INTO `plans` (`id`, `Name`, `Price`, `AttackTime`, `Concurrent`, `PPS`, `Premium`, `API`, `L4`, `L7`) VALUES (NULL, :Name, :Price, :AttackTime, :Concurrent, :PPS, :Premium, :API, :L4, :L7);");
		$DataBase->Bind(':Name', $Name);
		$DataBase->Bind(':Price', $Price);
		$DataBase->Bind(':AttackTime', $AttackTime);
		$DataBase->Bind(':Concurrent', $Concurrents);
		$DataBase->Bind(':PPS', $PPS);
		$DataBase->Bind(':Premium', $API);
		$DataBase->Bind(':API', $Premium);
		$DataBase->Bind(':L4', $Layer4);
		$DataBase->Bind(':L7', $Layer7);

		return $DataBase->Execute();
	}

	public function ChangePlan($Name, $Price, $AttackTime, $Concurrents, $PPS, $API, $Premium, $Layer4, $Layer7, $id) {
		global $DataBase;

		$DataBase->Query("UPDATE `plans` SET `Name`=:Name, `Price`=:Price, `AttackTime`=:AttackTime, `Concurrent`=:Concurrent, `PPS`=:PPS, `Premium`=:Premium, `API`=:API, `L4`=:L4, `L7`=:L7 WHERE `id`=:uID");
		$DataBase->Bind(':Name', $Name);
		$DataBase->Bind(':Price', $Price);
		$DataBase->Bind(':AttackTime', $AttackTime);
		$DataBase->Bind(':Concurrent', $Concurrents);
		$DataBase->Bind(':PPS', $PPS);
		$DataBase->Bind(':Premium', $API);
		$DataBase->Bind(':API', $Premium);
		$DataBase->Bind(':L4', $Layer4);
		$DataBase->Bind(':L7', $Layer7);
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function DeletePlan($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `plans` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function BuyPlan($planID) {
		global $DataBase;
		global $User;
		global $Plan;
		global $Logs;

		// if($planMW == 'w') {
			$Price = $Plan->PlanDataID($planID)['Price'];
		// } else {
			// $Price = $Plan->PlanDataID($planID)['Price'] * 3;
		// }

		if($User->UserData()['Money'] < $Price) {
			$rMsg = ['error', 'You dont have enough money. Please add balance.', 'true'];
			echo json_encode($rMsg);
			die();
		}

		$UserID = $User->UserData()['id'];

		$NewBalance = $User->UserData()['Money'] - $Price;

		// if($planMW == 'w') {
		// 	$Expire = time() + 604800;
		// } else {
			$Expire = time() + 2592000;
		// }

		$DataBase->Query("UPDATE `users` SET `Money`=:MoneyUpdate WHERE `id`=:uID");
		$DataBase->Bind(':MoneyUpdate', $NewBalance);
		$DataBase->Bind(':uID', $UserID);

		$MoneyUpdate = $DataBase->Execute();

		if($MoneyUpdate == false) {
			$rMsg = ['error', 'Fail on Money Update!'];
			echo json_encode($rMsg);
			die();
		}

		$DataBase->Query("UPDATE `users` SET `Plan`=:Plan WHERE `id`=:uID");
		$DataBase->Bind(':Plan', $planID);
		$DataBase->Bind(':uID', $UserID);

		$PlanUpdate = $DataBase->Execute();

		if($PlanUpdate == false) {
			$rMsg = ['error', 'Fail on Plan Update!'];
			echo json_encode($rMsg);
			die();
		}

		$DataBase->Query("UPDATE `users` SET `Expire`=:Expire WHERE `id`=:uID");
		$DataBase->Bind(':Expire', $Expire);
		$DataBase->Bind(':uID', $UserID);

		$ExpireUpdate = $DataBase->Execute();

		if($ExpireUpdate == false) {
			$rMsg = ['error', 'Fail on Expire Update!'];
			echo json_encode($rMsg);
			die();
		}

		// Log Payment
		$Logs->CreateLog($User->UserData()['id'], 'User bought plan id: '.$planID);

		$rMsg = ['success', 'You have successfully purchased the plan. Enjoy!'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
		echo json_encode($rMsg);
		die();
	}

	public function AddSeconds($Seconds) {
		global $DataBase;
		global $User;
		global $Plan;
		global $Logs;

		$Price = $Seconds * 10;
		$Seconds = $Seconds * 600;

		if($User->UserData()['Money'] < $Price) {
			$rMsg = ['error', 'You dont have enough money. Please add balance.', 'true'];
			echo json_encode($rMsg);
			die();
		}

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

		$Addons = explode('|', $User->UserData()['Addons']);
		$ExtraSeconds = $Addons[0] + $Seconds;
		$NewAddons = $ExtraSeconds."|".$Addons[1]."|".$Addons[2]."|".$Addons[3];

		$DataBase->Query("UPDATE `users` SET `Addons`=:Addons WHERE `id`=:uID");
		$DataBase->Bind(':Addons', $NewAddons);
		$DataBase->Bind(':uID', $UserID);

		$AddonsUpdate = $DataBase->Execute();

		if($AddonsUpdate == false) {
			$rMsg = ['error', 'Fail on Addons Update!'];
			echo json_encode($rMsg);
			die();
		}

		// Log Payment
		$Logs->CreateLog($User->UserData()['id'], 'User bought '.$Seconds." more seconds.");

		$rMsg = ['success', 'You have successfully purchased extra seconds!'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
		echo json_encode($rMsg);
		die();
	}

	public function DeleteAPI($id) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `api` WHERE `id`=:uID");
		$DataBase->Bind(':uID', $id);

		return $DataBase->Execute();
	}

	public function AddPremium() {
		global $DataBase;
		global $User;
		global $Plan;
		global $Logs;

		$Price = 50;

		if($User->UserData()['Money'] < $Price) {
			$rMsg = ['error', 'You dont have enough money. Please add balance.', 'true'];
			echo json_encode($rMsg);
			die();
		}

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

		$Addons = explode('|', $User->UserData()['Addons']);
		$NewAddons = $Addons[0]."|".$Addons[1]."|1|".$Addons[3];

		$DataBase->Query("UPDATE `users` SET `Addons`=:Addons WHERE `id`=:uID");
		$DataBase->Bind(':Addons', $NewAddons);
		$DataBase->Bind(':uID', $UserID);

		$AddonsUpdate = $DataBase->Execute();

		if($AddonsUpdate == false) {
			$rMsg = ['error', 'Fail on Addons Update!'];
			echo json_encode($rMsg);
			die();
		}

		// Log Payment
		$Logs->CreateLog($User->UserData()['id'], "User bought Premium Addon.");

		$rMsg = ['success', 'You have successfully purchased Premium Addon!'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
		echo json_encode($rMsg);
		die();
	}

	public function AddTurbo() {
		global $DataBase;
		global $User;
		global $Plan;
		global $Logs;

		$Price = 100;

		if($User->UserData()['Money'] < $Price) {
			$rMsg = ['error', 'You dont have enough money. Please add balance.', 'true'];
			echo json_encode($rMsg);
			die();
		}

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

		$Addons = explode('|', $User->UserData()['Addons']);
		$NewAddons = $Addons[0]."|".$Addons[1]."|".$Addons[2]."|1";

		$DataBase->Query("UPDATE `users` SET `Addons`=:Addons WHERE `id`=:uID");
		$DataBase->Bind(':Addons', $NewAddons);
		$DataBase->Bind(':uID', $UserID);

		$AddonsUpdate = $DataBase->Execute();

		if($AddonsUpdate == false) {
			$rMsg = ['error', 'Fail on Addons Update!'];
			echo json_encode($rMsg);
			die();
		}

		// Log Payment
		$Logs->CreateLog($User->UserData()['id'], "User bought Turbo Addon.");

		$rMsg = ['success', 'You have successfully purchased Turbo Addon!'];
		$_SESSION['token'] = bin2hex(random_bytes(32));
		echo json_encode($rMsg);
		die();
	}
}

?>