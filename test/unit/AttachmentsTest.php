<?php
/**
 * This file tests Attachments.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Attachment;

/**
 * This file tests Attachments.
 *
 * @package SendGrid\Tests\Unit
 */
class AttachmentsTest extends TestCase
{
    public function testWillEncodeNonBase64String()
    {
        $attachment = new Attachment();
        $testString = 'Twilio SendGrid is awesome!';

        $attachment->setContent($testString);

        $this->assertEquals(base64_encode($testString), $attachment->getContent());
    }

    public function testWillNotEncodeBase64String()
    {
        $attachment = new Attachment();
        $testString = base64_encode('Twilio SendGrid is awesome!');

        $attachment->setContent($testString);

        $this->assertEquals($testString, $attachment->getContent());
    }
}
