7<?php
// If you are using Composer
require 'vendor/autoload.php';


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve email statistics by browser.  #
// GET /browsers/stats #

$query_params = json_decode('{"end_date": "2017-04-01", "aggregated_by": "day", "browsers": "test_string", "limit": "test_string", "offset": "test_string", "start_date": "2017-01-01"}');
$response = $sg->client->browsers()->stats()->get(null, $query_params);
print_r($response->statusCode();
print_r($response->body();
print_r($response->headers());
