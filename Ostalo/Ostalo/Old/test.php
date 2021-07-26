<?php

$load = '3.3333';
echo number_format($load, 2);

// echo time();

// $brojevi = array(10, 50, 20, 70);

// $najveci  = $brojevi[0];
// $najmanji = $brojevi[0];

// foreach($brojevi as $broj){
//     if($broj > $najveci){
//         $najveci = $broj;
//     }
//     else if($broj < $najmanji){
//         $najmanji = $broj;
//     }
// }

// echo "najveci $najveci <br />";
// echo "najmanji $najmanji";

// echo urldecode(urlencode('1=2'));

// $test = 'Test|Kita|NesJace';

// $Expl = explode('|', $test);

// foreach ($Expl as $t) {
//     // echo $t."<br>";
//     if($t)
// }

// echo gethostbyname('http://google.com');

// Start Function
// function GetProtection($targeted, $TargetedSource) {
//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//     curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/".$targeted);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);  
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//     $ipinfo = curl_exec($ch);

//     if(curl_errno($ch)) {
//         $rMsg = ['error', 'Error. Example: 1.1.1 OR domain.com'];
//         echo json_encode($rMsg);
//         die();
//     }

//     curl_close($ch);

//     if ($ipinfo === FALSE) {
//         $rMsg = ['error', 'Error. Example: 1.1.1 OR domain.com'];
//         echo json_encode($rMsg);
//         die();
//     }

//     $ipinfo_json = json_decode($ipinfo, true);

//     $Lookup = array(array("Cloudflare", "CF"), array("DDOS-GUARD", "DDG"));

//     // print_r($Lookup);
//     foreach ($Lookup as $lookupKey){
//         if(strpos($ipinfo_json['org'], $lookupKey[0]) == true) {
//             $test = $TargetedSource." - ".$lookupKey[1];
//         }
//     }

//     if(empty($test)) {
//         $Protection = explode(' ',$ipinfo_json['org']);

//         return '5.2.18.7 - '.$Protection[1];
//     } else {
//         return $test;
//     }
// }

// echo GetProtection('212.200.61.8', '212.200.61.8');

// $Target = 'http://test.com/';
// $Target = str_replace(';', "", $Target);
// $Target = str_replace('https://', "", $Target);
// $Target = str_replace('http://', "", $Target);
// $Target = str_replace('/', ".", $Target);
// // Is valid Target
// if(!filter_var($Target, FILTER_VALIDATE_IP)) {
//     $TargetIP = gethostbyname($Target);

//     $IpExplode = explode('.',$Target);

//     $Targeter = $IpExplode[0].".".$IpExplode[1];
// } else {
//     $TargetIP = $Target;
//     $Targeter = $Target;
// }

// echo $Targeter;


// die();
// function getIpInfo($ip) {
//     $ipinfo = file_get_contents("https://ipinfo.io/" . $ip);
//     $ipinfo_json = json_decode($ipinfo, true);
//     return $ipinfo_json;
// }

// echo getIpInfo('186.2.163.99')['org'];

// die();

?>