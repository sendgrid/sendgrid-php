<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create API keys #
// POST /api_keys #

$request_body = json_decode('{
  "name": "My API Key",
  "sample": "data",
  "scopes": [
    "mail.send",
    "alerts.create",
    "alerts.read"
  ]
}');

try {
    $response = $sg->client->api_keys()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all API Keys belonging to the authenticated user #
// GET /api_keys #

$query_params = json_decode('{"limit": 1}');

try {
    $response = $sg->client->api_keys()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update the name & scopes of an API Key #
// PUT /api_keys/{api_key_id} #

$request_body = json_decode('{
  "name": "A New Hope",
  "scopes": [
    "user.profile.read",
    "user.profile.update"
  ]
}');
$api_key_id = "test_url_param";

try {
    $response = $sg->client->api_keys()->_($api_key_id)->put($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update API keys #
// PATCH /api_keys/{api_key_id} #

$request_body = json_decode('{
  "name": "A New Hope"
}');
$api_key_id = "test_url_param";

try {
    $response = $sg->client->api_keys()->_($api_key_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve an existing API Key #
// GET /api_keys/{api_key_id} #

$api_key_id = "test_url_param";

try {
    $response = $sg->client->api_keys()->_($api_key_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete API keys #
// DELETE /api_keys/{api_key_id} #

$api_key_id = "test_url_param";

try {
    $response = $sg->client->api_keys()->_($api_key_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
