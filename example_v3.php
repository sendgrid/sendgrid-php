<?php
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
require 'lib/Client.php';
  
Dotenv::load(__DIR__);
$sendgrid_apikey = getenv('SG_KEY');
$sendgrid = new Client($sendgrid_apikey);

/*

$group_id = 70;
$email = 'example@example.com';
$response = $sendgrid->asm_suppressions->delete($group_id, $email);
print("Status Code: " . $response->getStatusCode() . "\n");

$group_id = 70;
$email = 'example@example.com';
$response = $sendgrid->asm_suppressions->post($group_id, $email);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

$group_id = 70;
$email = array('example@example.com', 'example@example.com');
$response = $sendgrid->asm_suppressions->post($group_id, $email);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

$response = $sendgrid->asm_groups->get();
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

$response = $sendgrid->api_keys->post("Magic Key");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");


$response = $sendgrid->api_keys->patch("<API Key ID>", "Magic Key Updated");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

$response = $sendgrid->api_keys->delete("<API Key ID>");
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

$response = $sendgrid->api_keys->get();
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

*/