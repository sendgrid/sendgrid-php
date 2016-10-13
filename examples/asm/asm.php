<?php
// If you are using Composer
require 'vendor/autoload.php';

use SendGrid\SendGrid;

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a new suppression group #
// POST /asm/groups #

$request_body = json_decode('{
  "description": "Suggestions for products our users might like.", 
  "is_default": true, 
  "name": "Product Suggestions"
}');
$response = $sg->client->asm()->groups()->post($request_body);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve information about multiple suppression groups #
// GET /asm/groups #

$query_params = json_decode('{"id": 1}');
$response = $sg->client->asm()->groups()->get(null, $query_params);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Update a suppression group. #
// PATCH /asm/groups/{group_id} #

$request_body = json_decode('{
  "description": "Suggestions for items our users might like.", 
  "id": 103, 
  "name": "Item Suggestions"
}');
$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->patch($request_body);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Get information on a single suppression group. #
// GET /asm/groups/{group_id} #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->get();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Delete a suppression group. #
// DELETE /asm/groups/{group_id} #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->delete();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

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
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->post($request_body);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve all suppressions for a suppression group #
// GET /asm/groups/{group_id}/suppressions #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->get();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

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
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->search()->post($request_body);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Delete a suppression from a suppression group #
// DELETE /asm/groups/{group_id}/suppressions/{email} #

$group_id = "test_url_param";
$email = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->_($email)->delete();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve all suppressions #
// GET /asm/suppressions #

$response = $sg->client->asm()->suppressions()->get();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Add recipient addresses to the global suppression group. #
// POST /asm/suppressions/global #

$request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com", 
    "test2@example.com"
  ]
}');
$response = $sg->client->asm()->suppressions()->global()->post($request_body);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve a Global Suppression #
// GET /asm/suppressions/global/{email} #

$email = "test_url_param";
$response = $sg->client->asm()->suppressions()->global()->_($email)->get();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Delete a Global Suppression #
// DELETE /asm/suppressions/global/{email} #

$email = "test_url_param";
$response = $sg->client->asm()->suppressions()->global()->_($email)->delete();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve all suppression groups for an email address #
// GET /asm/suppressions/{email} #

$email = "test_url_param";
$response = $sg->client->asm()->suppressions()->_($email)->get();
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

