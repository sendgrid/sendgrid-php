<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a new Alert #
// POST /alerts #

$request_body = json_decode('{
  "email_to": "example@example.com", 
  "frequency": "daily", 
  "type": "stats_notification"
}');
$response = $sg->client->alerts()->post($request_body);
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Retrieve all alerts #
// GET /alerts #

$response = $sg->client->alerts()->get();
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Update an alert #
// PATCH /alerts/{alert_id} #

$request_body = json_decode('{
  "email_to": "example@example.com"
}');
$alert_id = "test_url_param";
$response = $sg->client->alerts()->_($alert_id)->patch($request_body);
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Retrieve a specific alert #
// GET /alerts/{alert_id} #

$alert_id = "test_url_param";
$response = $sg->client->alerts()->_($alert_id)->get();
echo $response->statusCode();
echo $response->body();
print_r($response->headers());

////////////////////////////////////////////////////
// Delete an alert #
// DELETE /alerts/{alert_id} #

$alert_id = "test_url_param";
$response = $sg->client->alerts()->_($alert_id)->delete();
echo $response->statusCode();
echo $response->body();
print_r($response->headers());
