<?php
	define('allow', TRUE);

	include_once('inc.php');
	// Get Current date, time
	$current_time = time();
	// Set Cookie expiration for 1 hour
	$cookie_expiration_time = $current_time - (60 * 60);  // for 1 hour
	setcookie('l0g1n', $_SESSION['UserLogin']['ID'], $cookie_expiration_time);
	session_unset();
	session_destroy();

    header('Location: login');

    die();
?>