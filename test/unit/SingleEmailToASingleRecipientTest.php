<?php
/**
 * This file tests the request object generation for a /mail/send API call.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Tests\BaseTestClass;


/**
 * This class tests the request object generation for a /mail/send API call.
 *
 * @package SendGrid\Tests\Unit
 */
class SingleEmailToASingleRecipientTest extends BaseTestClass
{

    private $REQUEST_OBJECT = <<<'JSON'
{
    "personalizations": [
        {
            "to": [
                {
                    "email": "test@example.com",
                    "name": "Example User"
                }
            ]
        }
    ],
    "subject": "Sending with Twilio SendGrid is Fun",
    "from": {
        "email": "test@example.com",
        "name": "Example User"
    },
    "content": [
        {
            "type": "text/plain",
            "value": "and easy to do anywhere, even with PHP"
        },
        {
            "type": "text/html",
            "value": "<strong>and easy to do anywhere, even with PHP</strong>"
        }
    ]
}
JSON;

    /**
     * Test all parameters using objects
     */
    public function testWithObjects()
    {
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $subject = new \SendGrid\Mail\Subject("Sending with Twilio SendGrid is Fun");
        $to = new \SendGrid\Mail\To("test@example.com", "Example User");
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "and easy to do anywhere, even with PHP"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $to,
            $subject,
            $plainTextContent,
            $htmlContent
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    /**
     * Test all parameters without using objects
     */
    public function testWithoutObjects()
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("test@example.com", "Example User");
        $email->setSubject("Sending with Twilio SendGrid is Fun");
        $email->addTo("test@example.com", "Example User");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }
}
