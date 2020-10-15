<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve email statistics by country and state/province. #
// GET /geo/stats #

$query_params = json_decode('{"end_date": "2016-04-01", "country": "US", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01"}');

try {
    $response = $sg->client->geo()->stats()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
