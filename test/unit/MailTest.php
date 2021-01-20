<?php
/**
 * This file tests Mail.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use PHPUnit\Framework\TestCase;

/**
 * This class tests Mail.
 *
 * @package SendGrid\Tests
 */
class MailTest extends TestCase
{
    public function testConstructor()
    {
        $mail = new Mail();

        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame(1, $mail->getPersonalizationCount());
    }
}
