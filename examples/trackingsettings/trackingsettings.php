<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve Tracking Settings #
// GET /tracking_settings #

$query_params = json_decode('{"limit": 1, "offset": 1}');

try {
    $response = $sg->client->tracking_settings()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Click Tracking Settings #
// PATCH /tracking_settings/click #

$request_body = json_decode('{
  "enabled": true
}');

try {
    $response = $sg->client->tracking_settings()->click()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve Click Track Settings #
// GET /tracking_settings/click #

try {
    $response = $sg->client->tracking_settings()->click()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Google Analytics Settings #
// PATCH /tracking_settings/google_analytics #

$request_body = json_decode('{
  "enabled": true,
  "utm_campaign": "website",
  "utm_content": "",
  "utm_medium": "email",
  "utm_source": "sendgrid.com",
  "utm_term": ""
}');

try {
    $response = $sg->client->tracking_settings()->google_analytics()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve Google Analytics Settings #
// GET /tracking_settings/google_analytics #

try {
    $response = $sg->client->tracking_settings()->google_analytics()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Open Tracking Settings #
// PATCH /tracking_settings/open #

$request_body = json_decode('{
  "enabled": true
}');

try {
    $response = $sg->client->tracking_settings()->open()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Get Open Tracking Settings #
// GET /tracking_settings/open #

try {
    $response = $sg->client->tracking_settings()->open()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Subscription Tracking Settings #
// PATCH /tracking_settings/subscription #

$request_body = json_decode('{
  "enabled": true,
  "html_content": "html content",
  "landing": "landing page html",
  "plain_content": "text content",
  "replace": "replacement tag",
  "url": "url"
}');

try {
    $response = $sg->client->tracking_settings()->subscription()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve Subscription Tracking Settings #
// GET /tracking_settings/subscription #

try {
    $response = $sg->client->tracking_settings()->subscription()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
