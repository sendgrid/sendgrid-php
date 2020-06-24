<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve a list of scopes for which this user has access. #
// GET /scopes #

try {
    $response = $sg->client->scopes()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
