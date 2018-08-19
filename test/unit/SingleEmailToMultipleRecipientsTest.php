<?php
/**
 * This file tests the request object generation for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;


/**
 * This class tests the request object generation for a /mail/send API call
 *
 * @package SendGrid\Tests
 */
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


    /**
     * Test when we are using objects
     */
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

    /**
     * Test when we are not using objects
     */
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
