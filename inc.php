<?php

if(!defined('allow')) {
    header("HTTP/1.0 404 Not Found");
}

define('f2fb13944d119855993e5f7cca43f0ea', TRUE);

$errors = 0;

if ($errors == 1) {
	error_reporting(E_ALL);
	error_reporting(1); 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
} else {
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
}

ini_set('error_log', 'error_logs');
error_reporting(E_ALL | E_STRICT | E_NOTICE);

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// if(defined('admin')) {
// 	if(substr(sprintf('%o', fileperms('../includes.php')), -4) != 777) {
// 		die('Stavi 777 permisije za includes.php');
// 	}
// } else if(defined('api')) {
// 	if(substr(sprintf('%o', fileperms('../includes.php')), -4) != 777) {
// 		die('Stavi 777 permisije za includes.php');
// 	}
// } else if(defined('pages')) {
// 	if(substr(sprintf('%o', fileperms('../../includes.php')), -4) != 777) {
// 		die('Stavi 777 permisije za includes.php');
// 	}
// } else {
// 	if(substr(sprintf('%o', fileperms('includes.php')), -4) != 777) {
// 		die('Stavi 777 permisije za includes.php');
// 	}
// }

// if($_SERVER['SERVER_NAME'] == 'stresser.pro') {
// 	$assets = 'https://stresser.pro/';
// } else if($_SERVER['SERVER_NAME'] == 'stress4n6j5sr6l3etwnsrtbtutdzlkc2rufgne5ilk3fb74rixxflqd.onion') {
// 	$assets = 'http://stress4n6j5sr6l3etwnsrtbtutdzlkc2rufgne5ilk3fb74rixxflqd.onion/';
// }

$assets = '/';

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$csrftoken = $_SESSION['token'];

ob_start();

date_default_timezone_set('Europe/Belgrade');

$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

/* Change MAX upload size */
/*ini_set(post_max_size, '100M');
ini_set(upload_max_filesize, '100M');
ini_set(max_execution_time, 6000000);
ini_set(max_input_time, 6000000);
ini_set(memory_limit, '100M');*/

// SERVER HOME
//$path = $_SERVER['DOCUMENT_ROOT'];

$maintance = false;

if(defined('admin')) {
	$path = '../';
} else if(defined('api')) {
	$path = '../';
	
	if($maintance == true) {
		include_once('maintance.php');
		die();
	}
	
} else if(defined('pages')) {
	$path = '../../';
	
	if($maintance == true) {
		include_once('maintance.php');
		die();
	}
	
} else {
	$path = '.';
	
	if($maintance == true) {
		include_once('maintance.php');
		die();
	}
	
}

// Configuration Files
include_once($path.'/main/inc/config.php');         		// MySQL Config File

// Classes
include_once($path.'/main/class/db.class.php'); 			// MySQL Managment Class
include_once($path.'/main/class/user.class.php'); 			// User Managment Class
include_once($path.'/main/class/secure.class.php');    		// Secure Managment Class
include_once($path.'/main/class/alert.class.php');    		// Alert Managment Class
include_once($path.'/main/class/plan.class.php'); 			// Plan Managment Class
include_once($path.'/main/class/support.class.php'); 		// Support Managment Class
include_once($path.'/main/class/logs.class.php'); 			// Logs Managment Class
include_once($path.'/main/class/alogs.class.php'); 			// Attack Logs Managment Class
include_once($path.'/main/class/admin.class.php'); 			// Admin Managment Class
include_once($path.'/main/class/order.class.php'); 			// Order Managment Class
include_once($path.'/main/class/news.class.php'); 			// News Managment Class
include_once($path.'/main/class/api.class.php'); 			// API Managment Class
include_once($path.'/main/class/methods.class.php'); 		// Methods Managment Class
include_once($path.'/main/class/blacklist.class.php'); 		// BlackList Managment Class

// Initializing Classes
$DataBase 	= new Database();
$User 		= new User();
$Secure 	= new Secure();
$Alert 		= new Alert();
$Plan 		= new Plan();
$Support 	= new Support();
$Logs	 	= new Logs();
$ALogs	 	= new ALogs();
$Admin	 	= new Admin();
$Order	 	= new Order();
$News	 	= new News();
$Api	 	= new Api();
$Methods	= new Methods();
$BlackList	= new BlackList();

if ($User->IsLoged() == true) {
    if($User->UserData()['Status'] == '0') {
		die();
	}
}

?>