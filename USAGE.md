```php
<?
namespace SendGrid;

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/lib/SendGrid.php';

// Configuration
$apiKey = getenv('SENDGRID_API_KEY');
$sg = new SendGrid($apiKey, array('host' => 'https://e9sk3d3bfaikbpdq7.stoplight-proxy.io'));

$query_params = array('limit' => 100, 'offset' => 0);
$request_headers = array('X-Mock: 200');
$response = $sg->client->api_keys()->get(null, $query_params, $request_headers);

print $response->statusCode();
print $response->responseHeaders();
print $response->responseBody();

// POST
$request_body = array(
        'name' => 'My PHP API Key',
        'scopes' => array(
            'mail.send',
            'alerts.create',
            'alerts.read'
        )
);
$response = $sg->client->api_keys()->post($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();
$response_body = json_decode($response->responseBody());
$api_key_id = $response_body->api_key_id;

// GET Single
$response = $sg->client->version('/v3')->api_keys()->_($api_key_id)->get();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

// PATCH
$request_body = array(
        'name' => 'A New Hope'
);
$response = $sg->client->api_keys()->_($api_key_id)->patch($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

// PUT
$request_body = array(
        'name' => 'A New Hope',
        'scopes' => array(
            'user.profile.read',
            'user.profile.update'
        )
);
$response = $sg->client->api_keys()->_($api_key_id)->put($request_body);
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();

// DELETE
$response = $sg->client->api_keys()->_($api_key_id)->delete();
echo $response->statusCode();
echo $response->responseBody();
echo $response->responseHeaders();
?>
```