<?php
/**
 * This file tests IpPoolName.
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

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\IpPoolName;

/**
 * This file tests IpPoolName.
 *
 * @package SendGrid\Tests
 */
class IpPoolNameTest extends TestCase
{
    public function testConstructor()
    {
        $ipPoolName = new IpPoolName('127.0.0.1');

        $this->assertInstanceOf(IpPoolName::class, $ipPoolName);
        $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
    }

    public function testSetIpPoolNme()
    {
        $ipPoolName = new IpPoolName();
        $ipPoolName->setIpPoolName('127.0.0.1');

        $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $ip_pool_name must be of type string.
     */
    public function testSetIpPoolNmeOnInvalidType()
    {
        $ipPoolName = new IpPoolName();
        $ipPoolName->setIpPoolName(['127.0.0.1']);
    }

    public function testJsonSerialize()
    {
        $ipPoolName = new IpPoolName();
        $ipPoolName->setIpPoolName('127.0.0.1');

        $this->assertSame('127.0.0.1', $ipPoolName->jsonSerialize());
    }
}
