<?php

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;

class ReplyToListTest extends TestCase
{
    public function testSetReplyToListWithValidReplyToObjects()
    {
        $emailObject = new Mail();
        $replyToList = [
            new ReplyTo('test1@example.com', 'Test1'),
            new ReplyTo('test2@example.com', 'Test2')
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(2, $emailObject->reply_to_list);
        $this->assertEquals('test1@example.com', $emailObject->reply_to_list[0]->getEmail());
        $this->assertEquals('Test1', $emailObject->reply_to_list[0]->getName());
        $this->assertEquals('test2@example.com', $emailObject->reply_to_list[1]->getEmail());
        $this->assertEquals('Test2', $emailObject->reply_to_list[1]->getName());
    }

    public function testSetReplyToListWithValidReplyToArray()
    {
        $emailObject = new Mail();
        $replyToList = [
            ['email' => 'test1@example.com', 'name' => 'Test1'],
            ['email' => 'test2@example.com']
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(2, $emailObject->reply_to_list);
        $this->assertEquals('test1@example.com', $emailObject->reply_to_list[0]->getEmail());
        $this->assertEquals('Test1', $emailObject->reply_to_list[0]->getName());
        $this->assertEquals('test2@example.com', $emailObject->reply_to_list[1]->getEmail());
        $this->assertNull($emailObject->reply_to_list[1]->getName());
    }

    public function testSetReplyToListWithInvalidReplyToArray()
    {
        $emailObject = new Mail();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Email is mandatory on ReplyToList array.');

        $replyToList = [
            ['name' => 'Test1']
        ];

        $emailObject->setReplyToList($replyToList);
    }

    public function testSetReplyToListWithSingleEmailString()
    {
        $emailObject = new Mail();
        $replyToList = [
            'test1@example.com'
        ];

        $emailObject->setReplyToList($replyToList);

        $this->assertCount(1, $emailObject->reply_to_list);
        $this->assertEquals('test1@example.com', $emailObject->reply_to_list[0]->getEmail());
        $this->assertNull($emailObject->reply_to_list[0]->getName());
    }

    public function testSetReplyToListWithMoreThanMaxItems()
    {
        $emailObject = new Mail();
        $replyToList = array_fill(0, 1001, 'test@example.com');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Number of items in "replyToList" must be at most 1000.');

        $emailObject->setReplyToList($replyToList);
    }
}
