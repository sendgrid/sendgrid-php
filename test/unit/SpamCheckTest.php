<?php
/**
 * This file tests SpamCheck
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

use SendGrid\Mail\SpamCheck;
use PHPUnit\Framework\TestCase;

/**
 * This class tests SpamCheck
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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $enable must be of type bool.
     */
    public function testSetEnableOnInvalidType()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setEnable('invalid_bool_type');
    }

    public function testSetThreshold()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setThreshold(1);

        $this->assertSame(1, $spamCheck->getThreshold());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $threshold must be of type int.
     */
    public function testSetThresholdOnInvalidType()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setThreshold('invalid_int_type');
    }

    public function testSetPostToUrl()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setPostToUrl('http://post-to.url');

        $this->assertSame('http://post-to.url', $spamCheck->getPostToUrl());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $post_to_url must be of type string.
     */
    public function testSetPostToUrlOnInvalidType()
    {
        $spamCheck = new SpamCheck();
        $spamCheck->setPostToUrl(true);
    }
}
