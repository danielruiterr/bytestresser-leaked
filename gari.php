<?php

// Includes
define('allow', true);
include_once('inc.php');

$Kita = $BlackList->BlackListDataAll()['Response'];

// $ch = curl_init( 'https://api.github.com/search/repositories?q=marko' );
// curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
// curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
// // curl_setopt( $ch, CURLOPT_POST, 1);
// // curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
// curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt( $ch, CURLOPT_HEADER, 0);
// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
// $response = curl_exec( $ch );
// curl_close($ch);

// $res = json_decode($response);
// var_dump($res);

// die();



echo '{
    "total_count": 2,
    "incomplete_results": false,
    "items": [';

    // foreach ($Plan->PlanDataAll()['Response'] as $Kv => $Vv) {
    //     echo '{
    //         "id": '.$Vv['id'].',
    //         "node_id": "MDEwOlJlcG9zaXRvcnkxNTcyMDQ0NQ==",
    //         "name": "marko",
    //         "full_name": "marko-js/marko",
    //         "private": false
    //       },';
    // }   
    echo '{
        "id": 5,
        "node_id": "MDEwOlJlcG9zaXRvcnkxNTcyMDQ0NQ==",
        "name": "marko",
        "full_name": "marko-js/marko",
        "private": false
      }';
      echo '
    ]
  }';

die();