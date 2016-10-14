<?php
// If you are using Composer
require 'vendor/autoload.php';

use SendGrid\SendGrid;

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve email statistics by mailbox provider. #
// GET /mailbox_providers/stats #

$query_params = json_decode('{"end_date": "2016-04-01", "mailbox_providers": "test_string", "aggregated_by": "day", "limit": 1, "offset": 1, "start_date": "2016-01-01"}');
$response = $sg->client->mailbox_providers()->stats()->get(null, $query_params);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

