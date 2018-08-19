<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a transactional template. #
// POST /templates #

$request_body = json_decode('{
  "name": "example_name"
}');

try {
    $response = $sg->client->templates()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all transactional templates. #
// GET /templates #


try {
    $response = $sg->client->templates()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Edit a transactional template. #
// PATCH /templates/{template_id} #

$request_body = json_decode('{
  "name": "new_example_name"
}');
$template_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a single transactional template. #
// GET /templates/{template_id} #

$template_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a template. #
// DELETE /templates/{template_id} #

$template_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


////////////////////////////////////////////////////
// Create a new transactional template version. #
// POST /templates/{template_id}/versions #

$request_body = json_decode('{
  "active": 1, 
  "html_content": "<%body%>", 
  "name": "example_version_name", 
  "plain_content": "<%body%>", 
  "subject": "<%subject%>", 
  "template_id": "ddb96bbc-9b92-425e-8979-99464621b543"
}');
$template_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->versions()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Edit a transactional template version. #
// PATCH /templates/{template_id}/versions/{version_id} #

$request_body = json_decode('{
  "active": 1, 
  "html_content": "<%body%>", 
  "name": "updated_example_name", 
  "plain_content": "<%body%>", 
  "subject": "<%subject%>"
}');
$template_id = "test_url_param";
$version_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->versions()->_($version_id)->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a specific transactional template version. #
// GET /templates/{template_id}/versions/{version_id} #

$template_id = "test_url_param";
$version_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->versions()->_($version_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a transactional template version. #
// DELETE /templates/{template_id}/versions/{version_id} #

$template_id = "test_url_param";
$version_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->versions()->_($version_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Activate a transactional template version. #
// POST /templates/{template_id}/versions/{version_id}/activate #

$template_id = "test_url_param";
$version_id = "test_url_param";

try {
    $response = $sg->client->templates()->_($template_id)->versions()->_($version_id)->activate()->post();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
