<?php

namespace Test\Section;

use SendGrid\Mail\Optional\Collection\SectionCollection;
use SendGrid\Mail\Optional\Section;

final class SectionTest extends \PHPUnit_Framework_TestCase
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
            json_encode(new Section($key, $value)),
            $this->getExpectedDecodedFrom($key, $value)
        );
    }

    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfullyFromCollection()
    {
        $contents = new SectionCollection([
            new Section('key', 'value'),
            new Section('otherKey', 'otherValue'),
            new Section('thirdKey', 'thirdValue')
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
        $customArguments = new SectionCollection([
            new Section('key', 'value'),
        ]);
        $this->assertSame(1, $customArguments->count());

        $customArguments->add(new Section('otherKey', 'otherValue'));
        $this->assertSame(2, $customArguments->count());

        $customArguments->addMany([
            new Section('keyFromMany', 'valueFromMany'),
            new Section('aKey', 'aValue')
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
        new Section(1, false);
    }

    /**
     * @return array
     */
    public function keyValueProvider()
    {
        return [
            [
                '%section1%',
                'Substitution Text for Section 1'
            ],
            [
                '%section2%',
                'Substitution Text for Section 2'
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
