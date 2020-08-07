<?php
/**
 * GroupsToDisplay class unit tests.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\GroupsToDisplay;
use SendGrid\Mail\TypeException;

class GroupsToDisplayTest extends TestCase
{
    public function testSetGroupsToDisplayWithExceededElementsCount()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');

        $data = range(1, 30);
        $groups = new GroupsToDisplay();
        $groups->setGroupsToDisplay($data);
    }

    public function testAddGroupToDisplayWithAlready()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');

        $data = range(1, 25);
        $groups = new GroupsToDisplay($data);
        $groups->addGroupToDisplay(1);
    }
}
