<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve a list of scopes for which this user has access. #
// GET /scopes #

$response = $sg->client->scopes()->get();
echo $response->statusCode();
echo $response->body();
print_r($response->headers());
