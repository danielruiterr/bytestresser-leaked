<?php

$GetPage = explode('/', @$_SERVER['REQUEST_URI']);

if(@$GetPage[2] == 'functions') {
    @include_once 'pages/functions.php?'.@$GetPage[3];
} else {
    if(empty(@$GetPage[3])) {
        @include_once 'pages/'.@$GetPage[2].'.php';
    } else if(@$GetPage[2] == 'invoice') {
        @include_once 'pages/invoice.php';
    } else if(!empty(@$GetPage[3])) {
        @include_once 'pages/'.@$GetPage[3].'.php';
    }
}

?>