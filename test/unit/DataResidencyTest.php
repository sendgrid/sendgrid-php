<?php
/**
 * This file tests email address encoding.
 */

namespace SendGrid\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


/**
 * This class tests Data residency
 *
 * @package SendGrid\Tests
 */
class DataResidencyTest extends TestCase
{
    public function testSetResidencyEu()
    {
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->setDataResidency("eu");
        self::assertEquals("https://api.eu.sendgrid.com", $sendgrid->client->getHost());
    }

    public function testSetResidencyGlobal()
    {
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->setDataResidency("global");
        self::assertEquals("https://api.sendgrid.com", $sendgrid->client->getHost());
    }

    public function testSetResidencyOverrideHost()
    {
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->client->setHost("https://test.api.com");
        $sendgrid->setDataResidency("eu");
        self::assertEquals("https://api.eu.sendgrid.com", $sendgrid->client->getHost());
    }

    public function testSetResidencyOverrideDataResidency()
    {
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->setDataResidency("eu");
        $sendgrid->client->setHost("https://test.api.com");
        self::assertEquals("https://test.api.com", $sendgrid->client->getHost());
    }

    public function testSetResidencyIncorrectRegion()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("region can only be \"eu\" or \"global\"");

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->setDataResidency("foo");
    }

    public function testSetResidencyNullRegion()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("region can only be \"eu\" or \"global\"");

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->setDataResidency("");
    }

    public function testSetResidencyDefaultRegion()
    {
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        self::assertEquals("https://api.sendgrid.com", $sendgrid->client->getHost());
    }
}
