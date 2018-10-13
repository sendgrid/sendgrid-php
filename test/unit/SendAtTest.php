<?php
/**
 * This file tests SendAt
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

use SendGrid\Mail\SendAt;
use PHPUnit\Framework\TestCase;

/**
 * This class tests SendAt
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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $send_at must be of type int.
     */
    public function testSendAtOnInvalidType()
    {
        $sendAt = new SendAt();
        $sendAt->setSendAt('invalid_int_type');
    }
}
