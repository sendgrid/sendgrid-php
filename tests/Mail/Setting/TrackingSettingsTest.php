<?php

namespace Test\Mail\Setting;

use SendGrid\Mail\Setting\OpenTracking;
use SendGrid\Mail\Setting\ClickTracking;
use SendGrid\Mail\Setting\GoogleAnalytics;
use SendGrid\Mail\Setting\TrackingSettings;
use SendGrid\Mail\Setting\SubscriptionTracking;

final class TrackingSettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfully()
    {
        $settings = new TrackingSettings;
        $this->assertTrue($settings->isEmpty());
        $this->assertSame('null', json_encode($settings));

        $settings->addClickTracking(new ClickTracking(true, true));
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedClickTrackingJson())
        );

        $settings->addOpenTracking(
            new OpenTracking(true, 'Optional tag to replace with the open image in the body of the message')
        );
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedOpenTrackingJson())
        );

        $settings->addSubscriptionTracking(
            new SubscriptionTracking(
                true,
                'text to insert into the text/plain portion of the message',
                '<html><body>html to insert into the text/html portion of the message</body></html>',
                'Optional tag to replace with the open image in the body of the message'
            )
        );
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedSubscriptionTrackingJson())
        );

        $settings->addGoogleAnalytics(
            new GoogleAnalytics(true, 'some source', 'some medium', 'some term', 'some content', 'some name')
        );
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedGoogleAnalyticJson())
        );
    }

    /**
     * Our objects should be immutable, by allowing the user to change its state
     * when ever a setter method is called is a bad practice, since we don't know
     * which settings the user need, we protect our properties by don't allowing the user
     * call the method twice, this way we can be sure that our objects are immutable.
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\ClickTrackingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddClickTrackingSettingTwice()
    {
        $settings = new TrackingSettings;
        $settings->addClickTracking(new ClickTracking(true, true));
        $settings->addClickTracking(new ClickTracking(false, false));
    }

    /**
     * Our objects should be immutable, by allowing the user to change its state
     * when ever a setter method is called is a bad practice, since we don't know
     * which settings the user need, we protect our properties by don't allowing the user
     * call the method twice, this way we can be sure that our objects are immutable.
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\OpenTrackingSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddOpenTrackingSettingTwice()
    {
        $settings = new TrackingSettings;
        $settings->addOpenTracking(new OpenTracking(true, 'Text'));
        $settings->addOpenTracking(new OpenTracking(false, 'I should probably not try to break immutability!'));
    }

    /**
     * Our objects should be immutable, by allowing the user to change its state
     * when ever a setter method is called is a bad practice, since we don't know
     * which settings the user need, we protect our properties by don't allowing the user
     * call the method twice, this way we can be sure that our objects are immutable.
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\SubscriptionTrackingSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddSubscriptionTrackingSettingTwice()
    {
        $settings = new TrackingSettings;
        $settings->addSubscriptionTracking(
            new SubscriptionTracking(
                true,
                'text to insert into the text/plain portion of the message',
                '<html><body>html to insert into the text/html portion of the message</body></html>',
                'Optional tag to replace with the open image in the body of the message'
            )
        );
        $settings->addSubscriptionTracking(
            new SubscriptionTracking(
                false,
                'text to insert into the text/plain portion of the message',
                '<html><body>html to insert into the text/html portion of the message</body></html>',
                'Optional tag to replace with the open image in the body of the message'
            )
        );
    }

    /**
     * Our objects should be immutable, by allowing the user to change its state
     * when ever a setter method is called is a bad practice, since we don't know
     * which settings the user need, we protect our properties by don't allowing the user
     * call the method twice, this way we can be sure that our objects are immutable.
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\GoogleAnalyticsSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddGoogleAnalyticsSettingTwice()
    {
        $settings = new TrackingSettings;
        $settings->addGoogleAnalytics(
            new GoogleAnalytics(true, 'some source', 'some medium', 'some term', 'some content', 'some name')
        );
        $settings->addGoogleAnalytics(
            new GoogleAnalytics(true, 'source', 'medium', 'term', 'content', 'name')
        );
    }

    /**
     * @param $json
     * @return string
     */
    private function getEncoded($json)
    {
        return json_encode(
            json_decode($json)
        );
    }

    /**
     * @return string
     */
    private function getExpectedClickTrackingJson()
    {
        return <<<JSON
        {
           "click_tracking":{
              "enable":true,
              "enable_text":true
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedOpenTrackingJson()
    {
        return <<<JSON
        {
           "click_tracking":{
              "enable":true,
              "enable_text":true
           },
           "open_tracking":{
              "enable":true,
              "substitution_tag":"Optional tag to replace with the open image in the body of the message"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedSubscriptionTrackingJson()
    {
        return <<<JSON
        {
           "click_tracking":{
              "enable":true,
              "enable_text":true
           },
           "open_tracking":{
              "enable":true,
              "substitution_tag":"Optional tag to replace with the open image in the body of the message"
           },
           "subscription_tracking":{
              "enable":true,
              "text":"text to insert into the text/plain portion of the message",
              "html":"<html><body>html to insert into the text/html portion of the message</body></html>",
              "substitution_tag":"Optional tag to replace with the open image in the body of the message"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedGoogleAnalyticJson()
    {
        return <<<JSOn
        {
           "click_tracking":{
              "enable":true,
              "enable_text":true
           },
           "open_tracking":{
              "enable":true,
              "substitution_tag":"Optional tag to replace with the open image in the body of the message"
           },
           "subscription_tracking":{
              "enable":true,
              "text":"text to insert into the text/plain portion of the message",
              "html":"<html><body>html to insert into the text/html portion of the message</body></html>",
              "substitution_tag":"Optional tag to replace with the open image in the body of the message"
           },
           "ganalytics":{
              "enable":true,
              "utm_source":"some source",
              "utm_medium":"some medium",
              "utm_term":"some term",
              "utm_content":"some content",
              "utm_campaign":"some content"
           }
        }
JSOn;
    }
}
