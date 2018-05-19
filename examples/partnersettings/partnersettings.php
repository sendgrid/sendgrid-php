<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Returns a list of all partner settings. #
// GET /partner_settings #

$query_params = json_decode('{"limit": 1, "offset": 1}');
$response = $sg->client->partner_settings()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Updates New Relic partner settings. #
// PATCH /partner_settings/new_relic #

$request_body = json_decode('{
  "enable_subuser_statistics": true, 
  "enabled": true, 
  "license_key": ""
}');
$response = $sg->client->partner_settings()->new_relic()->patch($request_body);
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Returns all New Relic partner settings. #
// GET /partner_settings/new_relic #

$response = $sg->client->partner_settings()->new_relic()->get();
echo $response->statusCode();
echo $response->body();
print_r($response->headers());
