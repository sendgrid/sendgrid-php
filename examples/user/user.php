<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Get a user's account information. #
// GET /user/account #

try {
    $response = $sg->client->user()->account()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve your credit balance #
// GET /user/credits #

try {
    $response = $sg->client->user()->credits()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update your account email address #
// PUT /user/email #

$request_body = json_decode('{
  "email": "example@example.com"
}');

try {
    $response = $sg->client->user()->email()->put($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve your account email address #
// GET /user/email #

try {
    $response = $sg->client->user()->email()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update your password #
// PUT /user/password #

$request_body = json_decode('{
  "new_password": "new_password", 
  "old_password": "old_password"
}');

try {
    $response = $sg->client->user()->password()->put($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a user's profile #
// PATCH /user/profile #

$request_body = json_decode('{
  "city": "Orange", 
  "first_name": "Example", 
  "last_name": "User"
}');

try {
    $response = $sg->client->user()->profile()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Get a user's profile #
// GET /user/profile #


try {
    $response = $sg->client->user()->profile()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Cancel or pause a scheduled send #
// POST /user/scheduled_sends #

$request_body = json_decode('{
  "batch_id": "YOUR_BATCH_ID", 
  "status": "pause"
}');

try {
    $response = $sg->client->user()->scheduled_sends()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all scheduled sends #
// GET /user/scheduled_sends #

try {
    $response = $sg->client->user()->scheduled_sends()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update user scheduled send information #
// PATCH /user/scheduled_sends/{batch_id} #

$request_body = json_decode('{
  "status": "pause"
}');
$batch_id = "test_url_param";

try {
    $response = $sg->client->user()->scheduled_sends()->_($batch_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve scheduled send #
// GET /user/scheduled_sends/{batch_id} #

$batch_id = "test_url_param";

try {
    $response = $sg->client->user()->scheduled_sends()->_($batch_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a cancellation or pause of a scheduled send #
// DELETE /user/scheduled_sends/{batch_id} #

$batch_id = "test_url_param";

try {
    $response = $sg->client->user()->scheduled_sends()->_($batch_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Enforced TLS settings #
// PATCH /user/settings/enforced_tls #

$request_body = json_decode('{
  "require_tls": true, 
  "require_valid_cert": false
}');

try {
    $response = $sg->client->user()->settings()->enforced_tls()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve current Enforced TLS settings. #
// GET /user/settings/enforced_tls #

try {
    $response = $sg->client->user()->settings()->enforced_tls()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update your username #
// PUT /user/username #

$request_body = json_decode('{
  "username": "test_username"
}');

try {
    $response = $sg->client->user()->username()->put($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve your username #
// GET /user/username #

try {
    $response = $sg->client->user()->username()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Event Notification Settings #
// PATCH /user/webhooks/event/settings #

$request_body = json_decode('{
  "bounce": true, 
  "click": true, 
  "deferred": true, 
  "delivered": true, 
  "dropped": true, 
  "enabled": true, 
  "group_resubscribe": true, 
  "group_unsubscribe": true, 
  "open": true, 
  "processed": true, 
  "spam_report": true, 
  "unsubscribe": true, 
  "url": "url"
}');

try {
    $response = $sg->client->user()->webhooks()->event()->settings()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve Event Webhook settings #
// GET /user/webhooks/event/settings #

try {
    $response = $sg->client->user()->webhooks()->event()->settings()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Test Event Notification Settings  #
// POST /user/webhooks/event/test #

$request_body = json_decode('{
  "url": "url"
}');

try {
    $response = $sg->client->user()->webhooks()->event()->test()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Create a parse setting #
// POST /user/webhooks/parse/settings #

$request_body = json_decode('{
  "hostname": "myhostname.com", 
  "send_raw": false, 
  "spam_check": true, 
  "url": "http://email.myhosthame.com"
}');

try {
    $response = $sg->client->user()->webhooks()->parse()->settings()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all parse settings #
// GET /user/webhooks/parse/settings #

try {
    $response = $sg->client->user()->webhooks()->parse()->settings()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a parse setting #
// PATCH /user/webhooks/parse/settings/{hostname} #

$request_body = json_decode('{
  "send_raw": true, 
  "spam_check": false, 
  "url": "http://newdomain.com/parse"
}');
$hostname = "test_url_param";

try {
    $response = $sg->client->user()->webhooks()->parse()->settings()->_($hostname)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific parse setting #
// GET /user/webhooks/parse/settings/{hostname} #

$hostname = "test_url_param";

try {
    $response = $sg->client->user()->webhooks()->parse()->settings()->_($hostname)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a parse setting #
// DELETE /user/webhooks/parse/settings/{hostname} #

$hostname = "test_url_param";

try {
    $response = $sg->client->user()->webhooks()->parse()->settings()->_($hostname)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieves Inbound Parse Webhook statistics. #
// GET /user/webhooks/parse/stats #

$query_params = json_decode('{"aggregated_by": "day", "limit": "test_string", "start_date": "2016-01-01", "end_date": "2016-04-01", "offset": "test_string"}');

try {
    $response = $sg->client->user()->webhooks()->parse()->stats()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
