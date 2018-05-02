<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;
use Swaggest\JsonDiff\JsonDiff;
use Swaggest\JsonDiff\JsonPatch;

class SingleEmailToASingleRecipientTest extends BaseTestClass
{
    private $REQUEST_OBJECT = '{"content":[{"type":"text/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text/html","value":"<strong>and easy to do anywhere, even with PHP</strong>"}],"from":{"email":"Example User","name":"test@example.com"},"personalizations":[{"subject":"Sending with SendGrid is Fun","to":[{"email":"Example User","name":"test@example.com"}]}]}';

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
        $json = json_encode($email->jsonSerialize($this->REQUEST_OBJECT));

        $diff = new JsonDiff(json_decode($json), json_decode($this->REQUEST_OBJECT), JsonDiff::REARRANGE_ARRAYS);
        $patch = $diff->getPatch();
        $patch_array = JsonPatch::export($patch);
        $this->assertTrue(empty($patch_array));
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

        $diff = new JsonDiff(json_decode($json), json_decode($this->REQUEST_OBJECT), JsonDiff::REARRANGE_ARRAYS);
        $patch = $diff->getPatch();
        $patch_array = JsonPatch::export($patch);
        $this->assertTrue(empty($patch_array));
    }
}
