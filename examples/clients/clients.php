<?php
// If you are using Composer
require 'vendor/autoload.php';

use SendGrid\SendGrid;

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve email statistics by client type. #
// GET /clients/stats #

$query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');
$response = $sg->client->clients()->stats()->get(null, $query_params);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve stats by a specific client type. #
// GET /clients/{client_type}/stats #

$query_params = json_decode('{"aggregated_by": "day", "start_date": "2016-01-01", "end_date": "2016-04-01"}');
$client_type = "test_url_param";
$response = $sg->client->clients()->_($client_type)->stats()->get(null, $query_params);
echo $response->statusCode();
echo print_r($response->headers());
echo $response->body();

