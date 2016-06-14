<?php
// If you are using Composer
require 'vendor/autoload.php';


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all blocks #
// GET /suppression/blocks #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
$response = $sg->client->suppression()->blocks()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete blocks #
// DELETE /suppression/blocks #

$response = $sg->client->suppression()->blocks()->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve a specific block #
// GET /suppression/blocks/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->blocks()->_($email)->get();
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete a specific block #
// DELETE /suppression/blocks/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->blocks()->_($email)->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve all bounces #
// GET /suppression/bounces #

$query_params = json_decode('{"start_time": 0, "end_time": 0}');
$response = $sg->client->suppression()->bounces()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete bounces #
// DELETE /suppression/bounces #

$response = $sg->client->suppression()->bounces()->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve a Bounce #
// GET /suppression/bounces/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->bounces()->_($email)->get();
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete a bounce #
// DELETE /suppression/bounces/{email} #

$query_params = json_decode('{"email_address": "example@example.com"}');
$email = "test_url_param";
$response = $sg->client->suppression()->bounces()->_($email)->delete($request_body, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve all invalid emails #
// GET /suppression/invalid_emails #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
$response = $sg->client->suppression()->invalid_emails()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete invalid emails #
// DELETE /suppression/invalid_emails #

$response = $sg->client->suppression()->invalid_emails()->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve a specific invalid email #
// GET /suppression/invalid_emails/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->invalid_emails()->_($email)->get();
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete a specific invalid email #
// DELETE /suppression/invalid_emails/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->invalid_emails()->_($email)->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve a specific spam report #
// GET /suppression/spam_report/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->spam_report()->_($email)->get();
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete a specific spam report #
// DELETE /suppression/spam_report/{email} #

$email = "test_url_param";
$response = $sg->client->suppression()->spam_report()->_($email)->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve all spam reports #
// GET /suppression/spam_reports #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
$response = $sg->client->suppression()->spam_reports()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Delete spam reports #
// DELETE /suppression/spam_reports #

$response = $sg->client->suppression()->spam_reports()->delete($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

////////////////////////////////////////////////////
// Retrieve all global suppressions #
// GET /suppression/unsubscribes #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
$response = $sg->client->suppression()->unsubscribes()->get(null, $query_params);
echo $response->statusCode();
echo $response->body();
echo $response->headers();

