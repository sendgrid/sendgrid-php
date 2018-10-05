<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a new suppression group #
// POST /asm/groups #

$request_body = json_decode('{
  "description": "Suggestions for products our users might like.", 
  "is_default": true, 
  "name": "Product Suggestions"
}');

try {
    $response = $sg->client->asm()->groups()->post($request_body);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve information about multiple suppression groups #
// GET /asm/groups #

$query_params = json_decode('{"id": 1}');

try {
    $response = $sg->client->asm()->groups()->get(null, $query_params);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a suppression group. #
// PATCH /asm/groups/{group_id} #

$request_body = json_decode('{
  "description": "Suggestions for items our users might like.", 
  "id": 103, 
  "name": "Item Suggestions"
}');
$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->patch($request_body);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Get information on a single suppression group. #
// GET /asm/groups/{group_id} #

$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->get();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a suppression group. #
// DELETE /asm/groups/{group_id} #

$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->delete();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add suppressions to a suppression group #
// POST /asm/groups/{group_id}/suppressions #

$request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com", 
    "test2@example.com"
  ]
}');
$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->suppressions()->post($request_body);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all suppressions for a suppression group #
// GET /asm/groups/{group_id}/suppressions #

$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->suppressions()->get();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Search for suppressions within a group #
// POST /asm/groups/{group_id}/suppressions/search #

$request_body = json_decode('{
  "recipient_emails": [
    "exists1@example.com", 
    "exists2@example.com", 
    "doesnotexists@example.com"
  ]
}');
$group_id = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->suppressions()->search()->post($request_body);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a suppression from a suppression group #
// DELETE /asm/groups/{group_id}/suppressions/{email} #

$group_id = "test_url_param";
$email = "test_url_param";

try {
    $response = $sg->client->asm()->groups()->_($group_id)->suppressions()->_($email)->delete();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all suppressions #
// GET /asm/suppressions #


try {
    $response = $sg->client->asm()->suppressions()->get();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add recipient addresses to the global suppression group. #
// POST /asm/suppressions/global #

$request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com", 
    "test2@example.com"
  ]
}');

try {
    $response = $sg->client->asm()->suppressions()->global()->post($request_body);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a Global Suppression #
// GET /asm/suppressions/global/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->asm()->suppressions()->global()->_($email)->get();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a Global Suppression #
// DELETE /asm/suppressions/global/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->asm()->suppressions()->global()->_($email)->delete();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all suppression groups for an email address #
// GET /asm/suppressions/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->asm()->suppressions()->_($email)->get();    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
