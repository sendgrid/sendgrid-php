<?php
/**
 * This file tests SendAt.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\SendAt;
use SendGrid\Mail\TypeException;

/**
 * This class tests SendAt.
 *
 * @package SendGrid\Tests
 */
class SendAtTest extends TestCase
{
    public function testConstructor()
    {
        $sendAt = new SendAt(1539368762);

        $this->assertInstanceOf(SendAt::class, $sendAt);
        $this->assertSame(1539368762, $sendAt->getSendAt());
    }

    public function testSendAt()
    {
        $sendAt = new SendAt();
        $sendAt->setSendAt(1539368762);

        $this->assertSame(1539368762, $sendAt->getSendAt());
    }

    public function testSendAtOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$send_at" must be an integer/');

        $sendAt = new SendAt();
        $sendAt->setSendAt('invalid_int_type');
    }
}
