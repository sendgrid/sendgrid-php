<?php
require 'vendor/autoload.php';


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

##################################################
# Create a Group #
# POST /asm/groups #

$request_body = json_decode('{
  "description": "A group description", 
  "is_default": false, 
  "name": "A group name"
}');
$response = $sg->client->asm()->groups()->post($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Retrieve all suppression groups associated with the user. #
# GET /asm/groups #

$response = $sg->client->asm()->groups()->get();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Update a suppression group. #
# PATCH /asm/groups/{group_id} #

$request_body = json_decode('{
  "description": "Suggestions for items our users might like.", 
  "id": 103, 
  "name": "Item Suggestions"
}');
$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->patch($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Get information on a single suppression group. #
# GET /asm/groups/{group_id} #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->get();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Delete a suppression group. #
# DELETE /asm/groups/{group_id} #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->delete();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Add suppressions to a suppression group #
# POST /asm/groups/{group_id}/suppressions #

$request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com", 
    "test2@example.com"
  ]
}');
$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->post($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Retrieve all suppressions for a suppression group #
# GET /asm/groups/{group_id}/suppressions #

$group_id = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->get();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Delete a suppression from a suppression group #
# DELETE /asm/groups/{group_id}/suppressions/{email} #

$group_id = "test_url_param";
        $email = "test_url_param";
$response = $sg->client->asm()->groups()->_($group_id)->suppressions()->_($email)->delete();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Add recipient addresses to the global suppression group. #
# POST /asm/suppressions/global #

$request_body = json_decode('{
  "recipient_emails": [
    "test1@example.com", 
    "test2@example.com"
  ]
}');
$response = $sg->client->asm()->suppressions()->global()->post($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Retrieve a Global Suppression #
# GET /asm/suppressions/global/{email} #

$email = "test_url_param";
$response = $sg->client->asm()->suppressions()->global()->_($email)->get();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

##################################################
# Delete a Global Suppression #
# DELETE /asm/suppressions/global/{email} #

$email = "test_url_param";
$response = $sg->client->asm()->suppressions()->global()->_($email)->delete();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

