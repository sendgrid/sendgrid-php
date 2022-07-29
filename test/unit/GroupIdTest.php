<?php
/**
 * This file tests GroupId.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\GroupId;
use SendGrid\Mail\TypeException;

/**
 * This file tests GroupId.
 *
 * @package SendGrid\Tests
 */
class GroupIdTest extends TestCase
{
    public function testConstructor()
    {
        $groupId = new GroupId(123456);

        $this->assertSame(123456, $groupId->getGroupId());
    }

    public function testSetGroupId()
    {
        $groupId = new GroupId(123456);
        $groupId->setGroupId(123456);

        $this->assertSame(123456, $groupId->getGroupId());
    }

    public function testSetGroupIdOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$group_id" must be an integer/');

        $groupId = new GroupId();
        $groupId->setGroupId('invalid_group_id');
    }

    public function testJsonSerialize()
    {
        $groupId = new GroupId();
        $groupId->setGroupId(123456);

        $this->assertSame(123456, $groupId->jsonSerialize());
    }
}
