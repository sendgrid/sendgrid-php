<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all blocks #
// GET /suppression/blocks #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');

try {
    $response = $sg->client->suppression()->blocks()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete blocks #
// DELETE /suppression/blocks #

$request_body = json_decode('{
  "delete_all": false, 
  "emails": [
    "example1@example.com", 
    "example2@example.com"
  ]
}');

try {
    $response = $sg->client->suppression()->blocks()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific block #
// GET /suppression/blocks/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->blocks()->_($email)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a specific block #
// DELETE /suppression/blocks/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->blocks()->_($email)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all bounces #
// GET /suppression/bounces #

$query_params = json_decode('{"start_time": 1, "end_time": 1}');

try {
    $response = $sg->client->suppression()->bounces()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete bounces #
// DELETE /suppression/bounces #

$request_body = json_decode('{
  "delete_all": true, 
  "emails": [
    "example@example.com", 
    "example2@example.com"
  ]
}');

try {
    $response = $sg->client->suppression()->bounces()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a Bounce #
// GET /suppression/bounces/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->bounces()->_($email)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a bounce #
// DELETE /suppression/bounces/{email} #

$query_params = json_decode('{"email_address": "example@example.com"}');
$email = "test_url_param";

try {
    $response = $sg->client->suppression()->bounces()->_($email)->delete(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all invalid emails #
// GET /suppression/invalid_emails #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');

try {
    $response = $sg->client->suppression()->invalid_emails()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete invalid emails #
// DELETE /suppression/invalid_emails #

$request_body = json_decode('{
  "delete_all": false, 
  "emails": [
    "example1@example.com", 
    "example2@example.com"
  ]
}');

try {
    $response = $sg->client->suppression()->invalid_emails()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific invalid email #
// GET /suppression/invalid_emails/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->invalid_emails()->_($email)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a specific invalid email #
// DELETE /suppression/invalid_emails/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->invalid_emails()->_($email)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific spam report #
// GET /suppression/spam_report/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->spam_reports()->_($email)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a specific spam report #
// DELETE /suppression/spam_report/{email} #

$email = "test_url_param";

try {
    $response = $sg->client->suppression()->spam_reports()->_($email)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all spam reports #
// GET /suppression/spam_reports #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');

try {
    $response = $sg->client->suppression()->spam_reports()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete spam reports #
// DELETE /suppression/spam_reports #

$request_body = json_decode('{
  "delete_all": false, 
  "emails": [
    "example1@example.com", 
    "example2@example.com"
  ]
}');

try {
    $response = $sg->client->suppression()->spam_reports()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all global suppressions #
// GET /suppression/unsubscribes #

$query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');

try {
    $response = $sg->client->suppression()->unsubscribes()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
