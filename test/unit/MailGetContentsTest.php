<?php

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;

/**
 * This class tests the getContents() function in SendGrid\Mail\Mail.
 *
 * @package SendGrid\Tests\Unit
 */
class MailGetContentsTest extends TestCase
{
    /**
     * This method tests that array from Mail getContents() returns with
     * text/plain Content object first when Mail instantiated with text/html
     * content before text/plain
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function testWillReturnPlainContentFirst()
    {
        $email = new Mail();
        $email->setFrom("test@example.com", null);
        $email->setSubject("Hello World from the Twilio SendGrid PHP Library");
        $email->addTo("test@example.com", "Test Person");

        $email->addContent("text/html", "<p>some text here</p>");
        $email->addContent("text/plain", "some text here");

        $this->assertEquals('text/plain', $email->getContents()[0]->getType());
    }
}
