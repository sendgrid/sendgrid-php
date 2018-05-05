<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;



class SingleEmailToMulipleRecipientsTest extends BaseTestClass
{
    
    private $REQUEST_OBJECT = <<<'JSON'
{
    "personalizations": [
      {
        "to": [
          {
            "email": "test+test1@example.com",
            "name": "Example User1"
          },
          {
            "email": "test+test2@example.com",
            "name": "Example User2"
          },
          {
            "email": "test+test3@example.com",
            "name": "Example User3"
          }
        ]
      }
    ],
    "subject": "Sending with SendGrid is Fun",
    "content": [
      {
        "type": "text/plain",
        "value": "and easy to do anywhere, even with PHP"
      },
      {
        "type": "text/html",
        "value": "<strong>and easy to do anywhere, even with PHP</strong>"
      }
    ],
    "from": {
      "email": "test@example.com",
      "name": "Example User"
    }
}
JSON;

    public function testWithObjects()
    {
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $tos = [ 
            new \SendGrid\Mail\To("test+test1@example.com", "Example User1"),
            new \SendGrid\Mail\To("test+test2@example.com", "Example User2"),
            new \SendGrid\Mail\To("test+test3@example.com", "Example User3")
        ];
        $subject = new \SendGrid\Mail\Subject("Sending with SendGrid is Fun");
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "and easy to do anywhere, even with PHP"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $tos,
            $subject,
            $plainTextContent,
            $htmlContent
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    public function testWithoutObjects()
    {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("test@example.com", "Example User");
        $tos = [ 
            "test+test1@example.com" => "Example User1",
            "test+test2@example.com" => "Example User2",
            "test+test3@example.com" => "Example User3"
        ];
        $email->addTos($tos);
        $email->setSubject("Sending with SendGrid is Fun");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }
}
