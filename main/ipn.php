<?php 

if(!isset($GET['ok'])) {
	header("Location: /");
	die();
}

if(isset($_SERVER['HTTP_REFERER'])) {
	header("Location: /");
	die();
}

define('admin', TRUE);
define('allow', TRUE);

include_once('../inc.php');

set_time_limit(0);

$merchant_id = '8fc7473486d1a3e9d496fc362bef97a5';
$secret = 'f-o4wkh3402ikfijaefposdgmhg-pe49';

if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
  die("No HMAC signature sent");
}

$merchant = isset($_POST['merchant']) ? $_POST['merchant']:'';
if (empty($merchant)) {
  die("No Merchant ID passed");
}

if ($merchant != $merchant_id) {
  die("Invalid Merchant ID");
}

$request = file_get_contents('php://input');
if ($request === FALSE || empty($request)) {
  die("Error reading POST data");
}

$hmac = hash_hmac("sha512", $request, $secret);
if ($hmac != $_SERVER['HTTP_HMAC']) {
  	die("HMAC signature does not match");
}

// Defines
$Money = $_POST['amount1'];
$invoice_id = $_POST['txn_id'];
$status = intval($_POST['status']);

$DataBase->Query("SELECT * FROM `payments` WHERE `invoice_id` = :invoice_id");
$DataBase->Bind(':invoice_id', $invoice_id);
$DataBase->Execute();

if($DataBase->RowCount() != 1){
	error_log("Invoice doesnt exists ".date("d.m.Y H:i:s",time())." \n", 3, "error_log");
	header("Location: /");
	die();
}

$InvoiceInfo = $DataBase->Single();
$userID = $InvoiceInfo['userID'];

if($InvoiceInfo['invoice_status'] == 1) {
	error_log("Invoice $invoice_id is already marked as paid.\n", 3, "error_log");
	header("Location: /");
	die();
}

if ($status >= 100 || $status == 2) {

	$MoneyNew = $Money + $User->UserDataID($userID, 1)['Money'];

	// Update Payment
	$DataBase->Query("UPDATE `payments` SET `invoice_status`=:Status WHERE `invoice_id`=:invoice_id");
	$DataBase->Bind(':Status', '1');
	$DataBase->Bind(':invoice_id', $invoice_id);
	$DataBase->Execute();

	// Update Users money
	$DataBase->Query("UPDATE `users` SET `Money`=:Money WHERE `id`=:uID");
	$DataBase->Bind(':Money', $MoneyNew);
	$DataBase->Bind(':uID', $userID);
	$DataBase->Execute();

	// Log
	$Logs->CreateLog($userID, 'User added money: '.$Money);
} else {
	die('Its just a prenk');
}

error_log("Invoice $invoice_id is marked as paid.\n", 3, "error_log");
header("Location: /");
die();

?>