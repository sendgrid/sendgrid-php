<?php
/**
 * This file tests Asm.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Asm;
use SendGrid\Mail\GroupId;
use SendGrid\Mail\GroupsToDisplay;
use SendGrid\Mail\TypeException;

/**
 * This file tests Asm.
 *
 * @package SendGrid\Tests
 */
class AsmTest extends TestCase
{
    public function testConstructorWithIntGroupId()
    {
        $asm = new Asm(123456, [1, 2, 3, 4]);

        $this->assertInstanceOf(Asm::class, $asm);
        $this->assertSame(123456, $asm->getGroupId()->getGroupId());
    }

    public function testConstructorWithGroupIdInstance()
    {
        $asm = new Asm(new GroupId(123456), [1, 2, 3, 4]);

        $this->assertSame(123456, $asm->getGroupId());
    }

    public function testSetGroupsToDisplay()
    {
        $asm = new Asm(123456, [1, 2, 3, 4]);
        $asm->setGroupsToDisplay(new GroupsToDisplay([1, 2, 3, 4]));

        $this->assertSame([1, 2, 3, 4], $asm->getGroupsToDisplay());
    }

    public function testSetGroupToDisplayOnInvalidValue()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$groups_to_display" must be an instance of SendGrid\\\Mail\\\GroupsToDisplay or an array/');

        $asm = new Asm(123456, [1, 2, 3, 4]);
        $asm->setGroupsToDisplay('invalid_array');
    }

    public function testSetGroupIdOnInvalidGroupId()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$group_id" must be an instance of SendGrid\\\Mail\\\GroupId or an integer/');

        $asm = new Asm(123456, [1, 2, 3, 4]);
        $asm->setGroupId('invalid_group_id');
    }
}
