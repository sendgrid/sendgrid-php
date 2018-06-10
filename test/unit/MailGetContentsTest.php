<?php

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Content;
use SendGrid\Mail\EmailAddress;
use SendGrid\Mail\From;

/**
 * This class tests the getContents() function in SendGrid\Mail\Mail
 *
 * @package SendGrid\Tests
 */
class MailGetContentsTest extends TestCase
{

    /**
     * This method tests that array from Mail getContents() returns with
     * text/plain Content object first when Mail instantiated with text/html
     * content before text/plain
     *
     * @return null
     */
    public function testWillReturnPlainContentFirst()
    {
        $from = new From(null, "test@example.com");
        $subject = "Hello World from the SendGrid PHP Library";
        $to = new EmailAddress("Test Person", "test@example.com");

        $plain_content = new Content("text/plain", "some text here");
        $html_content = new Content("text/html", "<p>some text here</p>");

        $mail = new Mail($from, [$to], $subject, $html_content, $plain_content);

        $this->assertEquals('text/plain', $mail->getContents()[0]->getType());
    }
}