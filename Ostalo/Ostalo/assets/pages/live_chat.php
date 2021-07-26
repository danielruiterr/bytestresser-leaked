<?php 

/*----------------------------------
	============================
	Website: warzone.to
	Author: Gari
	Author URL: https://warzone.to
	============================
-----------------------------------*/

define('allow', TRUE);
define('pages', TRUE);

include_once('../../includes.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

if($_SERVER['HTTP_REFERER'] !== 'https://warzone.to/panel') {
	header("Location: /index.php?error");
	header("HTTP/1.0 404 Not Found");
}

$handle = fopen ( "../live/".$User->UserData()['Username'].".php", "r" );
$contents = fread ( $handle, filesize ( "../live/".$User->UserData()['Username'].".php" ) );
fclose ( $handle );

echo $contents;

?>