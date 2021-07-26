<?php

	if(!defined('allow')) {
   		die('Direct access not permitted');
	}

	if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
		die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
	}

	// Database for my localhost
	define("DB_HOST", "localhost"); 	// MySQL Database Host
	define("DB_USER", "sales_waf_se_usr");			// MySQL Username
	define("DB_PASS", "BsE96C8l5W44b9gX");  			// MySQL Password
	define("DB_NAME", "sales_waf_ser_db");  		// Database Name
	
	// // Database for public
	// define("DB_HOST", "localhost");	// MySQL Database Host
	// define("DB_USER", "root");		// MySQL Username
	// define("DB_PASS", "13121312!");  // MySQL Password
	// define("DB_NAME", "gari_stress");  	// Database Name
?>