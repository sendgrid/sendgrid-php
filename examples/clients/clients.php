<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve email statistics by client type. #
// GET /clients/stats #

$query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');

try {
    $response = $sg->client->clients()->stats()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve stats by a specific client type. #
// GET /clients/{client_type}/stats #

$query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');
$client_type = "test_url_param";

try {
    $response = $sg->client->clients()->_($client_type)->stats()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
