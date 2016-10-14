<?php
// If you are using Composer
require 'vendor/autoload.php';

use SendGrid\SendGrid;

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve a list of scopes for which this user has access. #
// GET /scopes #

$response = $sg->client->scopes()->get();
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

