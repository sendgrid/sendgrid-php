<?php
/**
 * This file tests SpamCheck.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\SpamCheck;
use SendGrid\Mail\TypeException;

/**
 * This class tests SpamCheck.
 *
 * @package SendGrid\Tests
 */
class SpamCheckTest extends TestCase
{
    public function testConstructor()
    {
        $spamCheck = new SpamCheck(true, 1, 'http://post-to.url');

        $this->assertInstanceOf(SpamCheck::class, $spamCheck);
        $this->assertTrue($spamCheck->getEnable());
        $this->assertSame(1, $spamCheck->getThreshold());
        $this->assertSame('http://post-to.url', $spamCheck->getPostToUrl());
    }

    public function testSetEnable()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setEnable(true);

        $this->assertTrue($spamCheck->getEnable());
    }

    public function testSetEnableOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$enable" must be a boolean/');

        $spamCheck = new SpamCheck();
        $spamCheck->setEnable('invalid_bool_type');
    }

    public function testSetThreshold()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setThreshold(1);

        $this->assertSame(1, $spamCheck->getThreshold());
    }

    public function testSetThresholdOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$threshold" must be an integer/');

        $spamCheck = new SpamCheck();
        $spamCheck->setThreshold('invalid_int_type');
    }

    public function testSetPostToUrl()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setPostToUrl('http://post-to.url');

        $this->assertSame('http://post-to.url', $spamCheck->getPostToUrl());
    }

    public function testSetPostToUrlOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$post_to_url" must be a string/');

        $spamCheck = new SpamCheck();
        $spamCheck->setPostToUrl(true);
    }
}
