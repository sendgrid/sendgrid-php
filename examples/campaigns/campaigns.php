<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a Campaign #
// POST /campaigns #

$request_body = json_decode('{
  "categories": [
    "spring line"
  ],
  "custom_unsubscribe_url": "",
  "html_content": "<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>",
  "ip_pool": "marketing",
  "list_ids": [
    110,
    124
  ],
  "plain_content": "Check out our spring line!",
  "segment_ids": [
    110
  ],
  "sender_id": 124451,
  "subject": "New Products for Spring!",
  "suppression_group_id": 42,
  "title": "March Newsletter"
}');

try {
    $response = $sg->client->campaigns()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all Campaigns #
// GET /campaigns #

$query_params = json_decode('{"limit": 1, "offset": 1}');

try {
    $response = $sg->client->campaigns()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a Campaign #
// PATCH /campaigns/{campaign_id} #

$request_body = json_decode('{
  "categories": [
    "summer line"
  ],
  "html_content": "<html><head><title></title></head><body><p>Check out our summer line!</p></body></html>",
  "plain_content": "Check out our summer line!",
  "subject": "New Products for Summer!",
  "title": "May Newsletter"
}');
$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a single campaign #
// GET /campaigns/{campaign_id} #

$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a Campaign #
// DELETE /campaigns/{campaign_id} #

$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a Scheduled Campaign #
// PATCH /campaigns/{campaign_id}/schedules #

$request_body = json_decode('{
  "send_at": 1489451436
}');
$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Schedule a Campaign #
// POST /campaigns/{campaign_id}/schedules #

$request_body = json_decode('{
  "send_at": 1489771528
}');
$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// View Scheduled Time of a Campaign #
// GET /campaigns/{campaign_id}/schedules #

$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Unschedule a Scheduled Campaign #
// DELETE /campaigns/{campaign_id}/schedules #

$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Send a Campaign #
// POST /campaigns/{campaign_id}/schedules/now #

$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->now()->post();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Send a Test Campaign #
// POST /campaigns/{campaign_id}/schedules/test #

$request_body = json_decode('{
  "to": "your.email@example.com"
}');
$campaign_id = "test_url_param";

try {
    $response = $sg->client->campaigns()->_($campaign_id)->schedules()->test()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
