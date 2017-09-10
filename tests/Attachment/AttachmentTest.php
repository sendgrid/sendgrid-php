<?php

namespace Test\Attachment;

use SendGrid\Mail\Optional\Attachment;
use SendGrid\Mail\Optional\Collection\AttachmentCollection;

final class AttachmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $content
     * @param string $type
     * @param string $name
     * @param string $disposition
     * @param string|null$id
     * @return void
     * @dataProvider attachmentProvider
     * @test
     */
    public function itShouldSerializeSuccessfully($content, $type, $name, $disposition, $id)
    {
        $this->assertSame(
            json_encode(new Attachment($content, $type, $name, $disposition, $id)),
            $this->getExpectedDecodedFrom($content, $type, $name, $disposition, $id)
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $attachments = new AttachmentCollection([
            new Attachment('content', 'type', 'name', 'disposition', 'anId'),
            new Attachment('otherContent', 'otherType', 'otherName', 'otherDisposition', 'otherId')
        ]);
        $this->assertSame(
            json_encode($attachments),
            $this->getExpectedDecodedFromCollection()
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldAddAttachmentSuccessfully()
    {
        $attachments = new AttachmentCollection([
            new Attachment('content', 'type', 'name', 'disposition', 'anId'),
        ]);
        $this->assertSame(1, $attachments->count());

        $attachments->add(new Attachment('otherContent', 'otherType', 'otherName', 'otherDisposition', 'otherId'));
        $this->assertSame(2, $attachments->count());

        $attachments->addMany([
            new Attachment('fromMany', 'typeFromMany', 'nameFromMany', 'dispositionFromMany', 'idFromMany'),
            new Attachment('I', 'Am', 'a', 'new', 'attachment')
        ]);
        $this->assertSame(4, $attachments->count());
    }

    /**
     * @return void
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function itShouldValidateScalar()
    {
        new Attachment(1, 2, 3, null);
    }

    /**
     * @return array
     */
    public function attachmentProvider()
    {
        return [
            [
                'TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12',
                'application/pdf',
                'balance_001.pdf',
                'attachment',
                'Balance Sheet'
            ],
            [
                'TG9yZW0gad8sa9dad90a7sd08as7da89d6as89d6as98d6as9d86asd79as6d98a6d8as9d7as8dada',
                'application/vnd.ms-excel',
                'test.xlx',
                'attachment',
                null
            ]
        ];
    }

    /**
     * @param string $content
     * @param string $type
     * @param string $name
     * @param string $disposition
     * @param string|null $id
     * @return string
     */
    private function getExpectedDecodedFrom($content, $type, $name, $disposition, $id)
    {
        return json_encode(
            json_decode($this->getExpectedJsonFrom($content, $type, $name, $disposition, $id))
        );
    }

    /**
     * @return string
     */
    private function getExpectedDecodedFromCollection()
    {
        return json_encode(
            json_decode($this->getExpectedJsonFromCollection())
        );
    }

    /**
     * @param string $content
     * @param string $type
     * @param string $name
     * @param string $disposition
     * @param string|null $id
     * @return string
     */
    private function getExpectedJsonFrom($content, $type, $name, $disposition, $id)
    {
        if (null === $id) {
            return <<<JSON
            {
                "content"     : "{$content}",
                "type"        : "{$type}",
                "filename"    : "{$name}",
                "disposition" : "{$disposition}"
            }
JSON;
        }
        return <<<JSON
        {
            "content"     : "{$content}",
            "type"        : "{$type}",
            "filename"    : "{$name}",
            "disposition" : "{$disposition}",
            "content_id"  : "{$id}"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedJsonFromCollection()
    {
        return <<<JSON
        [
           {
              "content"     :"content",
              "type"        :"type",
              "filename"    :"name",
              "disposition" :"disposition",
              "content_id"  :"anId"
           },
           {
              "content"     :"otherContent",
              "type"        :"otherType",
              "filename"    :"otherName",
              "disposition" :"otherDisposition",
              "content_id"  :"otherId"
           }
        ]
JSON;
    }
}
