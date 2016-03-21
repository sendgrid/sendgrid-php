<?php
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
require 'lib/Client.php';
  
Dotenv::load(__DIR__);
$sendgrid_apikey = getenv('SG_KEY');
$sendgrid = new Client($sendgrid_apikey);

$api_key = "My API Key";
$scopes = array("mail.send", "alerts.create", "alerts.read");
$response = $sendgrid->api_keys->post($api_key, $scopes);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n");

/*

$start_date = "2015-12-01";
$response = $sendgrid->global_stats->get($start_date);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n\n");

$end_date = "2015-12-14";
$response = $sendgrid->global_stats->get($start_date, $end_date);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n\n");

$aggregated_by = "day";
$response = $sendgrid->global_stats->get($start_date, $end_date, $aggregated_by);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n\n");

$aggregated_by = "week";
$response = $sendgrid->global_stats->get($start_date, $end_date, $aggregated_by);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n\n");

$aggregated_by = "month";
$response = $sendgrid->global_stats->get($start_date, $end_date, $aggregated_by);
print("Status Code: " . $response->getStatusCode() . "\n");
print("Body: " . $response->getBody() . "\n\n");

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

$api_key_id = "Q5xdErWiSO6b8fYUgtYY8g";
$name = "My API Key 2";
$scopes = array("user.profile.read", "user.profile.update");
$response = $sendgrid->api_keys->put($api_key_id, $name, $scopes);
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