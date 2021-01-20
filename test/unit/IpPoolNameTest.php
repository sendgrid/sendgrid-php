<?php
/**
 * This file tests IpPoolName.
 */
namespace SendGrid\Tests\Unit;

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
     * @expectedExceptionMessage "$ip_pool_name" must be a string.
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
