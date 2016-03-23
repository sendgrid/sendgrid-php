<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_Templates extends baseTest
{
    public function testGET()
    {
        $code = 200;
        $headers = array('Content-Type' => 'application/json');
        $body = '{
                  "templates": [
                    {
                      "id": "e8ac01d5-a07a-4a71-b14c-4721136fe6aa",
                      "name": "example template name",
                      "versions": [
                        {
                          "id": "5997fcf6-2b9f-484d-acd5-7e9a99f0dc1f",
                          "template_id": "9c59c1fb-931a-40fc-a658-50f871f3e41c",
                          "active": 1,
                          "name": "example version name",
                          "updated_at": "2014-03-19 18:56:33"
                        }
                      ]
                    }
                  ]
                }';
        $sendgrid = $this->buildClient($code, $headers, $body);
        $response = $sendgrid->templates->get();
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($body, $response->getBody());
    }

    public function testGET_individual()
    {
        $code = 200;
        $headers = array('Content-Type' => 'application/json');
        $body = '{
                  "id": "e8ac01d5-a07a-4a71-b14c-4721136fe6aa",
                  "name": "example template name",
                  "versions": [
                    {
                      "id": "de37d11b-082a-42c0-9884-c0c143015a47",
                      "user_id": 1234,
                      "template_id": "d51480ba-ca3f-465c-bc3e-ceb71d73c38d",
                      "active": 1,
                      "name": "example version",
                      "html_content": "<%body%><strong>Click to Reset</strong>",
                      "plain_content": "Click to Reset<%body%>",
                      "subject": "<%subject%>",
                      "updated_at": "2014-05-22 20:05:21"
                    }
                  ]
                }';
        $sendgrid = $this->buildClient($code, $headers, $body);
        $response = $sendgrid->templates->get('e8ac01d5-a07a-4a71-b14c-4721136fe6aa');
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($body, $response->getBody());
    }

    public function testPOST()
    {
        $code = 200;
        $headers = array('Content-Type' => 'application/json');
        $body = '{
                  "id": "733ba07f-ead1-41fc-933a-3976baa23716",
                  "name": "example_name",
                  "versions": []
                }';
        $sendgrid = $this->buildClient($code, $headers, $body);
        $name = "example_name";
        $response = $sendgrid->templates->post($name);
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($body, $response->getBody());
    }

    public function testPATCH()
    {
        $code = 200;
        $headers = array('Content-Type' => 'application/json');
        $body = '{
                  "id": "733ba07f-ead1-41fc-933a-3976baa23716",
                  "name": "new_example_name",
                  "versions": []
                }';
        $sendgrid = $this->buildClient($code, $headers, $body);
        $response = $sendgrid->templates->patch("733ba07f-ead1-41fc-933a-3976baa23716", "new_example_name");
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($body, $response->getBody());
    }

    public function testDELETE()
    {
        $code = 204;
        $headers = '';
        $body = '';
        $sendgrid = $this->buildClient($code, $headers, $body);
        $response = $sendgrid->templates->delete("733ba07f-ead1-41fc-933a-3976baa23716");
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($body, $response->getBody());
    }
}
