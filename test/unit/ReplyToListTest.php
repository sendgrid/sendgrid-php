<?php

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;
use SendGrid\Mail\ReplyTo;

class ReplyToListTest extends TestCase
{
    public function testSetReplyToListWithValidReplyToObjects()
    {
        $emailObject = new Mail();
        $replyToList = [
            new ReplyTo('test1@example.com', 'Test1'),
            new ReplyTo('test2@example.com', 'Test2'),
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(2, $emailObject->getReplyToList());
        $this->assertEquals('test1@example.com', $emailObject->getReplyToList()[0]->getEmail());
        $this->assertEquals('Test1', $emailObject->getReplyToList()[0]->getName());
        $this->assertEquals('test2@example.com', $emailObject->getReplyToList()[1]->getEmail());
        $this->assertEquals('Test2', $emailObject->getReplyToList()[1]->getName());
    }

    public function testSetReplyToListWithValidReplyToArray()
    {
        $emailObject = new Mail();
        $replyToList = [
            ['email' => 'test1@example.com', 'name' => 'Test1'],
            ['email' => 'test2@example.com'],
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(2, $emailObject->getReplyToList());
        $this->assertEquals('test1@example.com', $emailObject->getReplyToList()[0]->getEmail());
        $this->assertEquals('Test1', $emailObject->getReplyToList()[0]->getName());
        $this->assertEquals('test2@example.com', $emailObject->getReplyToList()[1]->getEmail());
        $this->assertNull($emailObject->getReplyToList()[1]->getName());
    }

    public function testSetReplyToListWithInvalidReplyToArray()
    {
        $emailObject = new Mail();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Email is mandatory on ReplyToList array.');

        $replyToList = [
            ['name' => 'Test1'],
        ];

        $emailObject->setReplyToList($replyToList);
    }

    public function testSetReplyToListWithSingleEmailString()
    {
        $emailObject = new Mail();
        $replyToList = [
            'test1@example.com',
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(1, $emailObject->getReplyToList());
        $this->assertEquals('test1@example.com', $emailObject->getReplyToList()[0]->getEmail());
        $this->assertNull($emailObject->getReplyToList()[0]->getName());
    }

    public function testSetReplyToListWithMoreThanMaxItems()
    {
        $emailObject = new \SendGrid\Mail\Mail();
        // Create a replyToList with 1001 items
        $replyToList = array_fill(0, 1001, 'test@example.com');

        // Update to expect the correct exception type
        $this->expectException(\SendGrid\Mail\TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$replyToList" can not be more than 1000.');

        // Call the method that is expected to throw the exception
        $emailObject->setReplyToList($replyToList);
    }
}
