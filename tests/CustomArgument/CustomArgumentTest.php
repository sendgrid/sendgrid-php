<?php

namespace Test\CustomArgument;

use SendGrid\Mail\Optional\Collection\CustomArgumentCollection;
use SendGrid\Mail\Optional\CustomArgument;

final class CustomArgumentTest extends \PHPUnit_Framework_TestCase
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
            json_encode(new CustomArgument($key, $value)),
            $this->getExpectedDecodedFrom($key, $value)
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $contents = new CustomArgumentCollection([
            new CustomArgument('key', 'value'),
            new CustomArgument('otherKey', 'otherValue'),
            new CustomArgument('thirdKey', 'thirdValue')
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
        $customArguments = new CustomArgumentCollection([
            new CustomArgument('key', 'value'),
        ]);
        $this->assertSame(1, $customArguments->count());

        $customArguments->add(new CustomArgument('otherKey', 'otherValue'));
        $this->assertSame(2, $customArguments->count());

        $customArguments->addMany([
            new CustomArgument('keyFromMany', 'valueFromMany'),
            new CustomArgument('aKey', 'aValue')
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
        new CustomArgument(1, false);
    }

    /**
     * @return array
     */
    public function keyValueProvider()
    {
        return [
            [
                'campaign',
                'welcome'
            ],
            [
                'weekday',
                'morning'
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
