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

try {
    $response = $sg->client->alerts()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all alerts #
// GET /alerts #

try {
    $response = $sg->client->alerts()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update an alert #
// PATCH /alerts/{alert_id} #

$request_body = json_decode('{
  "email_to": "example@example.com"
}');
$alert_id = "test_url_param";

try {
    $response = $sg->client->alerts()->_($alert_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific alert #
// GET /alerts/{alert_id} #

$alert_id = "test_url_param";

try {
    $response = $sg->client->alerts()->_($alert_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete an alert #
// DELETE /alerts/{alert_id} #

$alert_id = "test_url_param";

try {
    $response = $sg->client->alerts()->_($alert_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
