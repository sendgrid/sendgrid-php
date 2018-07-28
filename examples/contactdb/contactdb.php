<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a Custom Field #
// POST /contactdb/custom_fields #

$request_body = json_decode('{
  "name": "pet", 
  "type": "text"
}');

try {
    $response = $sg->client->contactdb()->custom_fields()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all custom fields #
// GET /contactdb/custom_fields #

try {
    $response = $sg->client->contactdb()->custom_fields()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a Custom Field #
// GET /contactdb/custom_fields/{custom_field_id} #

$custom_field_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->custom_fields()->_($custom_field_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a Custom Field #
// DELETE /contactdb/custom_fields/{custom_field_id} #

$custom_field_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->custom_fields()->_($custom_field_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Create a List #
// POST /contactdb/lists #

$request_body = json_decode('{
  "name": "your list name"
}');

try {
    $response = $sg->client->contactdb()->lists()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all lists #
// GET /contactdb/lists #

try {
    $response = $sg->client->contactdb()->lists()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete Multiple lists #
// DELETE /contactdb/lists #

$request_body = json_decode('[
  1, 
  2, 
  3, 
  4
]');

try {
    $response = $sg->client->contactdb()->lists()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a List #
// PATCH /contactdb/lists/{list_id} #

$request_body = json_decode('{
  "name": "newlistname"
}');
$query_params = json_decode('{"list_id": 1}');
$list_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->patch($request_body, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a single list #
// GET /contactdb/lists/{list_id} #

$query_params = json_decode('{"list_id": 1}');
$list_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a List #
// DELETE /contactdb/lists/{list_id} #

$query_params = json_decode('{"delete_contacts": "true"}');
$list_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->delete(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add Multiple Recipients to a List #
// POST /contactdb/lists/{list_id}/recipients #

$request_body = json_decode('[
  "recipient_id1", 
  "recipient_id2"
]');
$list_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all recipients on a List #
// GET /contactdb/lists/{list_id}/recipients #

$query_params = json_decode('{"page": 1, "page_size": 1, "list_id": 1}');
$list_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add a Single Recipient to a List #
// POST /contactdb/lists/{list_id}/recipients/{recipient_id} #

$list_id = "test_url_param";
$recipient_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->_($recipient_id)->post();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a Single Recipient from a Single List #
// DELETE /contactdb/lists/{list_id}/recipients/{recipient_id} #

$query_params = json_decode('{"recipient_id": 1, "list_id": 1}');
$list_id = "test_url_param";
$recipient_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->recipients()->_($recipient_id)->delete(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update Recipient #
// PATCH /contactdb/recipients #

$request_body = json_decode('[
  {
    "email": "jones@example.com", 
    "first_name": "Guy", 
    "last_name": "Jones"
  }
]');

try {
    $response = $sg->client->contactdb()->recipients()->patch($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Add recipients #
// POST /contactdb/recipients #

$request_body = json_decode('[
  {
    "age": 25, 
    "email": "example@example.com", 
    "first_name": "", 
    "last_name": "User"
  }, 
  {
    "age": 25, 
    "email": "example2@example.com", 
    "first_name": "Example", 
    "last_name": "User"
  }
]');

try {
    $response = $sg->client->contactdb()->recipients()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve recipients #
// GET /contactdb/recipients #

$query_params = json_decode('{"page": 1, "page_size": 1}');

try {
    $response = $sg->client->contactdb()->recipients()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete Recipient #
// DELETE /contactdb/recipients #

$request_body = json_decode('[
  "recipient_id1", 
  "recipient_id2"
]');

try {
    $response = $sg->client->contactdb()->recipients()->delete($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve the count of billable recipients #
// GET /contactdb/recipients/billable_count #

try {
    $response = $sg->client->contactdb()->recipients()->billable_count()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a Count of Recipients #
// GET /contactdb/recipients/count #

try {
    $response = $sg->client->contactdb()->recipients()->count()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve recipients matching search criteria #
// GET /contactdb/recipients/search #

$query_params = json_decode('{"{field_name}": "test_string"}');

try {
    $response = $sg->client->contactdb()->recipients()->search()->get(null, $query_params);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a single recipient #
// GET /contactdb/recipients/{recipient_id} #

$recipient_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->recipients()->_($recipient_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a Recipient #
// DELETE /contactdb/recipients/{recipient_id} #

$recipient_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->recipients()->_($recipient_id)->delete();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve the lists that a recipient is on #
// GET /contactdb/recipients/{recipient_id}/lists #

$recipient_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->recipients()->_($recipient_id)->lists()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve reserved fields #
// GET /contactdb/reserved_fields #

try {
    $response = $sg->client->contactdb()->reserved_fields()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Create a Segment #
// POST /contactdb/segments #

$request_body = json_decode('{
  "conditions": [
    {
      "and_or": "", 
      "field": "last_name", 
      "operator": "eq", 
      "value": "Miller"
    }, 
    {
      "and_or": "and", 
      "field": "last_clicked", 
      "operator": "gt", 
      "value": "01/02/2015"
    }, 
    {
      "and_or": "or", 
      "field": "clicks.campaign_identifier", 
      "operator": "eq", 
      "value": "513"
    }
  ], 
  "list_id": 4, 
  "name": "Last Name Miller"
}');

try {
    $response = $sg->client->contactdb()->segments()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve all segments #
// GET /contactdb/segments #

try {
    $response = $sg->client->contactdb()->segments()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Update a segment #
// PATCH /contactdb/segments/{segment_id} #

$request_body = json_decode('{
  "conditions": [
    {
      "and_or": "", 
      "field": "last_name", 
      "operator": "eq", 
      "value": "Miller"
    }
  ], 
  "list_id": 5, 
  "name": "The Millers"
}');
$query_params = json_decode('{"segment_id": "test_string"}');
$segment_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->segments()->_($segment_id)->patch($request_body, $query_params);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve a segment #
// GET /contactdb/segments/{segment_id} #

$query_params = json_decode('{"segment_id": 1}');
$segment_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->segments()->_($segment_id)->get(null, $query_params);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Delete a segment #
// DELETE /contactdb/segments/{segment_id} #

$query_params = json_decode('{"delete_contacts": "true"}');
$segment_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->segments()->_($segment_id)->delete(null, $query_params);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Retrieve recipients on a segment #
// GET /contactdb/segments/{segment_id}/recipients #

$query_params = json_decode('{"page": 1, "page_size": 1}');
$segment_id = "test_url_param";

try {
    $response = $sg->client->contactdb()->segments()->_($segment_id)->recipients()->get(null, $query_params);    
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
