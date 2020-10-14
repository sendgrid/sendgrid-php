<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../sendgrid-php.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Retrieve all mail settings #
// GET /mail_settings #

$query_params = json_decode('{"limit": 1, "offset": 1}');

try {
    $response = $sg->client->mail_settings()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update address whitelist mail settings #
// PATCH /mail_settings/address_whitelist #

$request_body = json_decode('{
  "enabled": true,
  "list": [
    "email1@example.com",
    "example.com"
  ]
}');

try {
    $response = $sg->client->mail_settings()->address_whitelist()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve address whitelist mail settings #
// GET /mail_settings/address_whitelist #

try {
    $response = $sg->client->mail_settings()->address_whitelist()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update BCC mail settings #
// PATCH /mail_settings/bcc #

$request_body = json_decode('{
  "email": "email@example.com",
  "enabled": false
}');

try {
    $response = $sg->client->mail_settings()->bcc()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all BCC mail settings #
// GET /mail_settings/bcc #

try {
    $response = $sg->client->mail_settings()->bcc()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update bounce purge mail settings #
// PATCH /mail_settings/bounce_purge #

$request_body = json_decode('{
  "enabled": true,
  "hard_bounces": 5,
  "soft_bounces": 5
}');

try {
    $response = $sg->client->mail_settings()->bounce_purge()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve bounce purge mail settings #
// GET /mail_settings/bounce_purge #

try {
    $response = $sg->client->mail_settings()->bounce_purge()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update footer mail settings #
// PATCH /mail_settings/footer #

$request_body = json_decode('{
  "enabled": true,
  "html_content": "...",
  "plain_content": "..."
}');

try {
    $response = $sg->client->mail_settings()->footer()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve footer mail settings #
// GET /mail_settings/footer #

try {
    $response = $sg->client->mail_settings()->footer()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update forward bounce mail settings #
// PATCH /mail_settings/forward_bounce #

$request_body = json_decode('{
  "email": "example@example.com",
  "enabled": true
}');

try {
    $response = $sg->client->mail_settings()->forward_bounce()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve forward bounce mail settings #
// GET /mail_settings/forward_bounce #

try {
    $response = $sg->client->mail_settings()->forward_bounce()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update forward spam mail settings #
// PATCH /mail_settings/forward_spam #

$request_body = json_decode('{
  "email": "",
  "enabled": false
}');

try {
    $response = $sg->client->mail_settings()->forward_spam()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve forward spam mail settings #
// GET /mail_settings/forward_spam #

try {
    $response = $sg->client->mail_settings()->forward_spam()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update plain content mail settings #
// PATCH /mail_settings/plain_content #

$request_body = json_decode('{
  "enabled": false
}');

try {
    $response = $sg->client->mail_settings()->plain_content()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve plain content mail settings #
// GET /mail_settings/plain_content #

try {
    $response = $sg->client->mail_settings()->plain_content()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update spam check mail settings #
// PATCH /mail_settings/spam_check #

$request_body = json_decode('{
  "enabled": true,
  "max_score": 5,
  "url": "url"
}');

try {
    $response = $sg->client->mail_settings()->spam_check()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve spam check mail settings #
// GET /mail_settings/spam_check #

try {
    $response = $sg->client->mail_settings()->spam_check()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update template mail settings #
// PATCH /mail_settings/template #

$request_body = json_decode('{
  "enabled": true,
  "html_content": "<% body %>"
}');

try {
    $response = $sg->client->mail_settings()->template()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve legacy template mail settings #
// GET /mail_settings/template #

try {
    $response = $sg->client->mail_settings()->template()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
