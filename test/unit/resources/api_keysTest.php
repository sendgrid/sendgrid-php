<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_APIKeys extends baseTest
{ 
  public function testGET()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{"result": [{"name": "default", "api_key_id": "XXXXXXXXXX"}]}';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->api_keys->get();
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testPOST()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{
                "api_key": "SG.xxxxxxxx.yyyyyyyy",
                "api_key_id": "xxxxxxxx",
                "name": "My API Key"
            }';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $name = "My API Key";
    $response = $sendgrid->api_keys->post($name);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testPOST_withScope()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{
                "api_key": "SG.xxxxxxxx.yyyyyyyy",
                "api_key_id": "xxxxxxxx",
                "name": "My API Key",
                "scopes": [
                  "mail.send",
                  "alerts.create",
                  "alerts.read"
                  ]
            }';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $name = "My API Key";
    $scopes = array("mail.send", "alerts.create", "alerts.read");
    $response = $sendgrid->api_keys->post($name, $scopes);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }  
  
  public function testPATCH()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{
              "api_key_id": "qfTQ6KG0QBiwWdJ0-pCLCA",
              "name": "A New Hope"
            }';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->api_keys->patch("qfTQ6KG0QBiwWdJ0-pCLCA", "Magic Key Updated");
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testPUT()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '{
              "api_key_id": "qfTQ6KG0QBiwWdJ0-pCLCA",
              "name": "A New Hope",
              "scopes": [
                "user.profile.read",
                "user.profile.update"
              ]
             }';
    $scopes = array("user.profile.read", "user.profile.update");
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->api_keys->put("qfTQ6KG0QBiwWdJ0-pCLCA", "A New Hope", $scopes);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
  public function testDELETE()
  { 
    $code = 204;
    $headers = '';
    $body = '';
    $sendgrid = $this->buildClient($code, $headers, $body);
    $response = $sendgrid->api_keys->delete("qfTQ6KG0QBiwWdJ0-pCLCA");
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
}