<?php

/**
 * ClickTracking Test. Tests JSON serialization of ClickTracking class.
 *
 * @author Aleksey Lavrinenko <okneloper@gmail.com>
 * @covers \SendGrid\ClickTracking
 */
class ClickTrackingTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultSerializesToEmptyArray()
    {
        $clickTracking = new \SendGrid\ClickTracking();

        $this->assertEquals([], $clickTracking->jsonSerialize());
    }

    public function testSerializesTrueValues()
    {
        $clickTracking = new \SendGrid\ClickTracking();
        $clickTracking->setEnable(true);
        $clickTracking->setEnableText(true);

        $this->assertEquals([
            'enable' => true,
            'enable_text' => true,
        ], $clickTracking->jsonSerialize());
    }

    public function testSerializesFalseValues()
    {
        $clickTracking = new \SendGrid\ClickTracking();
        $clickTracking->setEnable(false);
        $clickTracking->setEnableText(false);

        $this->assertEquals([
            'enable' => false,
            'enable_text' => false,
        ], $clickTracking->jsonSerialize());
    }

    public function testSerializesVariousValues()
    {
        $clickTracking = new \SendGrid\ClickTracking();
        $clickTracking->setEnable(false);
        $clickTracking->setEnableText(true);

        $this->assertEquals([
            'enable' => false,
            'enable_text' => true,
        ], $clickTracking->jsonSerialize());
    }
}
