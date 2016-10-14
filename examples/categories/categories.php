<?php
// If you are using Composer
require 'vendor/autoload.php';

use SendGrid\SendGrid;

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all categories #
// GET /categories #

$query_params = json_decode('{"category": "test_string", "limit": 1, "offset": 1}');
$response = $sg->client->categories()->get(null, $query_params);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve Email Statistics for Categories #
// GET /categories/stats #

$query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01", "categories": "test_string"}');
$response = $sg->client->categories()->stats()->get(null, $query_params);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

////////////////////////////////////////////////////
// Retrieve sums of email stats for each category [Needs: Stats object defined, has category ID?] #
// GET /categories/stats/sums #

$query_params = json_decode('{"end_date": "2016-04-01", "aggregated_by": "day", "limit": 1, "sort_by_metric": "test_string", "offset": 1, "start_date": "2016-01-01", "sort_by_direction": "asc"}');
$response = $sg->client->categories()->stats()->sums()->get(null, $query_params);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

