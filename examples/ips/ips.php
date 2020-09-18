<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all IP addresses #
// GET /ips #

$query_params = json_decode('{"subuser": "test_string", "ip": "test_string", "limit": 1, "exclude_whitelabels": "true", "offset": 1}');

try {
    $response = $sg->client->ips()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all assigned IPs #
// GET /ips/assigned #

try {
    $response = $sg->client->ips()->assigned()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Create an IP pool. #
// POST /ips/pools #

$request_body = json_decode('{
  "name": "marketing"
}');

try {
    $response = $sg->client->ips()->pools()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all IP pools. #
// GET /ips/pools #

try {
    $response = $sg->client->ips()->pools()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update an IP pools name. #
// PUT /ips/pools/{pool_name} #

$request_body = json_decode('{
  "name": "new_pool_name"
}');
$pool_name = "test_url_param";

try {
    $response = $sg->client->ips()->pools()->_($pool_name)->put($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all IPs in a specified pool. #
// GET /ips/pools/{pool_name} #

$pool_name = "test_url_param";

try {
    $response = $sg->client->ips()->pools()->_($pool_name)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete an IP pool. #
// DELETE /ips/pools/{pool_name} #

$pool_name = "test_url_param";

try {
    $response = $sg->client->ips()->pools()->_($pool_name)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add an IP address to a pool #
// POST /ips/pools/{pool_name}/ips #

$request_body = json_decode('{
  "ip": "0.0.0.0"
}');
$pool_name = "test_url_param";

try {
    $response = $sg->client->ips()->pools()->_($pool_name)->ips()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Remove an IP address from a pool. #
// DELETE /ips/pools/{pool_name}/ips/{ip} #

$pool_name = "test_url_param";
$ip = "test_url_param";

try {
    $response = $sg->client->ips()->pools()->_($pool_name)->ips()->_($ip)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add an IP to warmup #
// POST /ips/warmup #

$request_body = json_decode('{
  "ip": "0.0.0.0"
}');

try {
    $response = $sg->client->ips()->warmup()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all IPs currently in warmup #
// GET /ips/warmup #

try {
    $response = $sg->client->ips()->warmup()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve warmup status for a specific IP address #
// GET /ips/warmup/{ip_address} #

$ip_address = "test_url_param";

try {
    $response = $sg->client->ips()->warmup()->_($ip_address)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Remove an IP from warmup #
// DELETE /ips/warmup/{ip_address} #

$ip_address = "test_url_param";

try {
    $response = $sg->client->ips()->warmup()->_($ip_address)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all IP pools an IP address belongs to #
// GET /ips/{ip_address} #

$ip_address = "test_url_param";

try {
    $response = $sg->client->ips()->_($ip_address)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
