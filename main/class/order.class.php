<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

if(defined('before')) {
	require_once 'main/lib/coinpayments.inc.php';
} else if(defined('admin')) {
	require_once '../main/lib/coinpayments.inc.php';
} else if(defined('api')) {
	require_once '../main/lib/coinpayments.inc.php';
} else if(defined('pages')) {
	require_once '../../main/lib/coinpayments.inc.php';
} else {
	require('main/lib/coinpayments.inc.php');
}

$cps = new CoinPaymentsAPI();
$cps->Setup('5edd292a7b01fA013DCdA3db055c013741Eefceb0b920abB64421B1007fc330e', 'ad527259b7ea6b9677322904eebfcea864c1e8efc657c5601fa93326ba27d2cb');

class Order {

	public function OrderDataAll($number) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments`");
		$DataBase->Execute();

        if($number == 0) {
            $Return = array(
                'Count' => $DataBase->RowCount(),
                'Response' => $DataBase->ResultSet()
            );
        } else {
            $Return = $DataBase->Single();
        }

		return $Return;
	}

	public function OrderDataPaidToday() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `invoice_status` = '1' AND `timestamp` > :time");
		$DataBase->Bind(':time', time()-86400);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function OrderDataToday() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `timestamp` > :time");
		$DataBase->Bind(':time', time()-86400);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function TotalSales() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `invoice_status` = '1'");
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function TotalIncome() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `invoice_status` = '1'");
		$DataBase->Bind(':time', time()-86400);
		$DataBase->Execute();

		$Return = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $Return;
	}

	public function OrderDataUser($userID, $number) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `userID` = :userID ORDER BY `order_id` DESC");
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();

        if($number == 0) {
            $Return = array(
                'Count' => $DataBase->RowCount(),
                'Response' => $DataBase->ResultSet()
            );
        } else {
            $Return = $DataBase->Single();
        }

		return $Return;
    }

	public function OrderDataID($ID, $userID, $number) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `order_id` = :ID AND `userID` = :userID");
		$DataBase->Bind(':ID', $ID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();


        if($number == 0) {
            $Return = array(
                'Count' => $DataBase->RowCount(),
                'Response' => $DataBase->ResultSet()
            );
        } else {
            $Return = $DataBase->Single();
        }

		return $Return;
	}

	public function LastOrderID() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` ORDER BY `order_id` DESC LIMIT 1");
		$DataBase->Execute();

        return $DataBase->Single();
    }

	public function LastUserOrder($userID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `payments` WHERE `userID` = :userID ORDER BY `order_id` DESC LIMIT 1");
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();

        return $DataBase->Single();
    }

    public function NewOrder($invoice_id, $checkout_address, $checkut_amount, $price, $checkout_currency, $invoice_created, $invoice_expires, $checkout_url, $status_url) {
		global $DataBase;
		global $User;

		$userID = $User->UserData()['id'];

		$DataBase->Query("INSERT INTO `payments` (`order_id`, `invoice_id`, `userID`, `timestamp`, `checkout_address`, `checkout_amount`, `price`, `checkout_currency`, `invoice_created`, `invoice_expires`, `checkout_url`, `status_url`, `invoice_status`) VALUES (NULL, :invoice_id, :userID, :timestamp, :checkout_address, :checkut_amount, :price, :checkout_currency, :invoice_created, :invoice_expires, :checkout_url, :status_url, :invoice_status);");
		$DataBase->Bind(':invoice_id', $invoice_id);
        $DataBase->Bind(':userID', $userID);
        $DataBase->Bind(':timestamp', time());
        $DataBase->Bind(':checkout_address', $checkout_address);
        $DataBase->Bind(':checkut_amount', $checkut_amount);
        $DataBase->Bind(':price', $price);
		$DataBase->Bind(':checkout_currency', $checkout_currency);
		$DataBase->Bind(':invoice_created', $invoice_created);
		$DataBase->Bind(':invoice_expires', $invoice_expires);
		$DataBase->Bind(':checkout_url', $checkout_url);
		$DataBase->Bind(':status_url', $status_url);
		$DataBase->Bind(':invoice_status', '0');

        return $DataBase->Execute();
	}

	public function CancelOrder($ID) {
		global $DataBase;
		global $User;

		$userID = $User->UserData()['id'];

		$DataBase->Query("UPDATE `payments` SET `invoice_status` = '2' WHERE `order_id` = :ID;");
		$DataBase->Bind(':ID', $ID);

        return $DataBase->Execute();
	}

	public function createInvoice($OrderCC, $OrderAmount) {
		global $User;
		global $cps;

		// create invoice
		$invoice = $cps->CreateTransactionSimple($OrderAmount, $OrderCC, 'empty@gmail.com', '', 'https://stresser.pro/.g0ASF8923ksfalgg/.f249-g2fk23i9f.phpok&user='.$User->UserData()['id']."&amount=".$OrderAmount);

		return $invoice;
	}

	public function GetTransactionInfo($txid) {
		global $cps;

		return $cps->GetTransactionInfo($txid);
	}

}

?>