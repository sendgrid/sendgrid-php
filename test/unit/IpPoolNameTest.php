<?php
/**
 * This file tests IpPoolName.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\IpPoolName;
use SendGrid\Mail\TypeException;

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

    public function testSetIpPoolNmeOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$ip_pool_name" must be a string/');

        $ipPoolName = new IpPoolName();
        $ipPoolName->setIpPoolName(123);
    }

    public function testJsonSerialize()
    {
        $ipPoolName = new IpPoolName();
        $ipPoolName->setIpPoolName('127.0.0.1');

        $this->assertSame('127.0.0.1', $ipPoolName->jsonSerialize());
    }
}
