<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;

class SingleEmailToASingleRecipientTest extends BaseTestClass
{
    public function testWithObjects()
    {
        $from = new \SendGrid\Mail\From("Example User", "test@example.com");
        $subject = new \SendGrid\Mail\Subject("Sending with SendGrid is Fun");
        $to = new \SendGrid\Mail\To("Example User", "test@example.com");
        $plainTextContent = new \SendGrid\Mail\PlainTextContent("and easy to do anywhere, even with PHP");
        $htmlContent = new \SendGrid\Mail\HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
        $email = new \SendGrid\Mail\Mail(
            $from,
            $to,
            $subject,
            $plainTextContent,
            $htmlContent
        );
        $json = json_encode($email->jsonSerialize());

        $this->assertEquals(
            $json,
            '{"personalizations":[{"subject":"Sending with SendGrid is Fun"},{"to":[{"name":"test@example.com","email":"Example User"}]}],"from":{"name":"test@example.com","email":"Example User"},"content":[{"type":"text\/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text\/html","value":"<strong>and easy to do anywhere, even with PHP<\/strong>"}]}'
        );
    }

    public function testWithoutObjects()
    {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("Example User", "test@example.com");
        $email->setSubject("Sending with SendGrid is Fun");
        $email->addTo("Example User", "test@example.com");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent("text/html", "<strong>and easy to do anywhere, even with PHP</strong>");

        $json = json_encode($email->jsonSerialize());

        $json1 = json_decode($json, true);
        $json2 = json_decode('{"personalizations":[{"subject":"Sending with SendGrid is Fun"},{"to":[{"name":"test@example.com","email":"Example User"}]}],"from":{"name":"test@example.com","email":"Example User"},"content":[{"type":"text\/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text\/html","value":"<strong>and easy to do anywhere, even with PHP<\/strong>"}]}', true);
        $result_array = array_diff($json1, $json2);

        $this->assertTrue(empty($result_array));
    }
}
