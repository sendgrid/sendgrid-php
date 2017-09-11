<?php

namespace Test\Header;

use SendGrid\Mail\Optional\Collection\HeaderCollection;
use SendGrid\Mail\Optional\Header;

final class HeaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $key
     * @param string $value
     * @return void
     * @test
     * @dataProvider keyValueProvider
     */
    public function itShouldSerializeSuccessfully($key, $value)
    {
        $this->assertSame(
            json_encode(new Header($key, $value)),
            $this->getExpectedDecodedFrom($key, $value)
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $contents = new HeaderCollection([
            new Header('key', 'value'),
            new Header('otherKey', 'otherValue'),
            new Header('thirdKey', 'thirdValue')
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
        $customArguments = new HeaderCollection([
            new Header('key', 'value'),
        ]);
        $this->assertSame(1, $customArguments->count());

        $customArguments->add(new Header('otherKey', 'otherValue'));
        $this->assertSame(2, $customArguments->count());

        $customArguments->addMany([
            new Header('keyFromMany', 'valueFromMany'),
            new Header('aKey', 'aValue')
        ]);
        $this->assertSame(4, $customArguments->count());
    }

    /**
     * @return void
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function itShouldValidateScalar()
    {
        new Header(1, false);
    }

    /**
     * @return array
     */
    public function keyValueProvider()
    {
        return [
            [
                'X-Test1',
                '1'
            ],
            [
                'X-Test2',
                '2'
            ]
        ];
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    private function getExpectedDecodedFrom($key, $value)
    {
        return json_encode(
            json_decode($this->getExpectedJsonFrom($key, $value))
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
     * @param string $key
     * @param string $value
     * @return string
     */
    public function getExpectedJsonFrom($key, $value)
    {
        return <<<JSON
        {
           "{$key}" : "{$value}"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedJsonFromCollection()
    {
        return <<<JSON
        {
           "key"      : "value",
           "otherKey" : "otherValue",
           "thirdKey" : "thirdValue"
        }
JSON;
    }
}
