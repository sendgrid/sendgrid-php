<?php
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
require 'lib/Client.php';
  
Dotenv::load(__DIR__);
$sendgrid_apikey = getenv('SG_KEY');
$sendgrid = new Client($sendgrid_apikey);

/*
$response = $sendgrid->api_keys->post("Magic Key");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");


$response = $sendgrid->api_keys->patch("VlgpNJUeTSaAM8KNJ0vlLA", "Magic Key Updated");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");
*/

/*
$response = $sendgrid->api_keys->delete("VlgpNJUeTSaAM8KNJ0vlLA");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");
*/

$response = $sendgrid->api_keys->get();
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

