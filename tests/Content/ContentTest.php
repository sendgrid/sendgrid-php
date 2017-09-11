<?php

namespace Test\Content;

use SendGrid\Mail\Essential\Content;
use SendGrid\Mail\Essential\Collection\ContentCollection;

final class ContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $type
     * @param string $value
     * @return void
     * @test
     * @dataProvider keyValueProvider
     */
    public function itShouldSerializeSuccessfully($type, $value)
    {
        $this->assertSame(
            json_encode(new Content($type, $value)),
            $this->getExpectedDecodedFrom($type, $value)
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $contents = new ContentCollection([
            new Content('type', 'value'),
            new Content('otherType', 'otherValue')
        ]);
        $this->assertSame(
            json_encode($contents),
            $this->getExpectedDecodedFromCollection()
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldAddAttachmentSuccessfully()
    {
        $contents = new ContentCollection([
            new Content('type', 'value'),
        ]);
        $this->assertSame(1, $contents->count());

        $contents->add(new Content('otherType', 'otherValue'));
        $this->assertSame(2, $contents->count());

        $contents->addMany([
            new Content('typeFromMany', 'valueFromMany'),
            new Content('I am a Type', 'I am a Value')
        ]);
        $this->assertSame(4, $contents->count());
    }

    /**
     * @return void
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function itShouldValidateScalar()
    {
        new Content(1, true);
    }

    /**
     * @return array
     */
    public function keyValueProvider()
    {
        return [
            [
                'text/plain',
                'Some text here'
            ],
            [
                'text/html',
                '<html><body>some text here</body></html>'
            ]
        ];
    }

    /**
     * @param string $type
     * @param string $value
     * @return string
     */
    private function getExpectedDecodedFrom($type, $value)
    {
        return json_encode(
            json_decode($this->getExpectedJsonFrom($type, $value))
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
     * @param string $type
     * @param string $value
     * @return string
     */
    public function getExpectedJsonFrom($type, $value)
    {
        return <<<JSON
        {
           "type"  : "{$type}",
           "value" : "{$value}"
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedJsonFromCollection()
    {
        return <<<JSON
        [
           {
              "type"  : "type",
              "value" : "value"
           },
           {
              "type"  : "otherType",
              "value" : "otherValue"
           }
        ]
JSON;
    }
}
