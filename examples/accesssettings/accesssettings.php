<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all recent access attempts #
// GET /access_settings/activity #

$query_params = json_decode('{"limit": 1}');

try {
    $response = $sg->client->access_settings()->activity()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add one or more IPs to the whitelist #
// POST /access_settings/whitelist #

$request_body = json_decode('{
  "ips": [
    {
      "ip": "192.168.1.1"
    }, 
    {
      "ip": "192.*.*.*"
    }, 
    {
      "ip": "192.168.1.3/32"
    }
  ]
}');

try {
    $response = $sg->client->access_settings()->whitelist()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a list of currently whitelisted IPs #
// GET /access_settings/whitelist #

try {
    $response = $sg->client->access_settings()->whitelist()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Remove one or more IPs from the whitelist #
// DELETE /access_settings/whitelist #

$request_body = json_decode('{
  "ids": [
    1,
    2,
    3
  ]
}');

try {
    $response = $sg->client->access_settings()->whitelist()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific whitelisted IP #
// GET /access_settings/whitelist/{rule_id} #

$rule_id = "test_url_param";

try {
    $response = $sg->client->access_settings()->whitelist()->_($rule_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Remove a specific IP from the whitelist #
// DELETE /access_settings/whitelist/{rule_id} #

$rule_id = "test_url_param";

try {
    $response = $sg->client->access_settings()->whitelist()->_($rule_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
