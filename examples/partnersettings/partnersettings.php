<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Returns a list of all partner settings. #
// GET /partner_settings #

$query_params = json_decode('{"limit": 1, "offset": 1}');

try {
    $response = $sg->client->partner_settings()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Updates New Relic partner settings. #
// PATCH /partner_settings/new_relic #

$request_body = json_decode('{
  "enable_subuser_statistics": true,
  "enabled": true,
  "license_key": ""
}');

try {
    $response = $sg->client->partner_settings()->new_relic()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Returns all New Relic partner settings. #
// GET /partner_settings/new_relic #


try {
    $response = $sg->client->partner_settings()->new_relic()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
