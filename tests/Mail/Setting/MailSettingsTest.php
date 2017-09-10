<?php

namespace Test\Mail\Setting;

use SendGrid\Mail\Setting\Footer;
use SendGrid\Mail\Setting\SpamCheck;
use SendGrid\Mail\Setting\SandBoxMode;
use SendGrid\Mail\Setting\BccSettings;
use SendGrid\Mail\Setting\MailSettings;
use SendGrid\Mail\ValueObject\EmailAddress;
use SendGrid\Mail\Setting\ByPassListManagement;

final class MailSettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfully()
    {
        $settings = new MailSettings;
        $this->assertTrue($settings->isEmpty());
        $this->assertSame('null', json_encode($settings));

        $settings->addBcc(
            new BccSettings(true, new EmailAddress('test@example.com'))
        );
        $this->assertFalse($settings->isEmpty());
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedBccJson())
        );

        $settings->addByPassListManagement(
            new ByPassListManagement(true)
        );
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedByPassListManagementJson())
        );

        $settings->addFooter(
            new Footer(true, 'Footer Text', '<html><body>Footer Text</body></html>')
        );
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedFooterJson())
        );

        $settings->addSandBoxMode(new SandBoxMode(true));
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedSandBoxModeJson())
        );

        $settings->addSpamCheck(new SpamCheck(true, 1, 'https://spamcatcher.sendgrid.com'));
        $this->assertSame(
            json_encode($settings),
            $this->getEncoded($this->getExpectedSpamCheckJson())
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
     * @expectedException \SendGrid\Mail\Setting\Exception\BccSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddBccSettingTwice()
    {
        $settings = new MailSettings;
        $settings->addBcc(
            new BccSettings(true, new EmailAddress('test@example.com'))
        );
        $settings->addBcc(
            new BccSettings(true, new EmailAddress('it_should_fail@fail.com'))
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
     * @expectedException \SendGrid\Mail\Setting\Exception\ByPassListManagementSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddByPassListManagementSettingTwice()
    {
        $settings = new MailSettings;
        $settings->addByPassListManagement(
            new ByPassListManagement(true)
        );
        /** I'm trying to break immutability but it won't work :-( */
        $settings->addByPassListManagement(
            new ByPassListManagement(true)
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
     * @expectedException \SendGrid\Mail\Setting\Exception\FooterSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddFooterSettingTwice()
    {
        $settings = new MailSettings;
        $settings->addFooter(
            new Footer(true, 'Footer Text', '<html><body>Footer Text</body></html>')
        );
        $settings->addFooter(
            new Footer(true, 'I should not break immutability', '<html><body>Text</body></html>')
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
     * @expectedException \SendGrid\Mail\Setting\Exception\SandBoxModeSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddSandBoxModeSettingTwice()
    {
        $settings = new MailSettings;
        $settings->addSandBoxMode(
            new SandBoxMode(true)
        );
        /** I'm trying to break immutability but it won't work :-( */
        $settings->addSandBoxMode(
            new SandBoxMode(false)
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
     * @expectedException \SendGrid\Mail\Setting\Exception\SpamCheckSettingIsAlreadySetException
     */
    public function itShouldFailIfUserTriesToAddSpamCheckSettingTwice()
    {
        $settings = new MailSettings;
        $settings->addSpamCheck(
            new SpamCheck(true, 1, 'https://spamcatcher.sendgrid.com')
        );
        $settings->addSpamCheck(
            new SpamCheck(false, 2, 'https://other-spam-checker.sendgrid.com')
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
    private function getExpectedBccJson()
    {
        return <<<JSON
        {
           "bcc":{
              "enable":true,
              "email":"test@example.com"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedByPassListManagementJson()
    {
        return <<<JSON
        {
           "bcc":{
              "enable":true,
              "email":"test@example.com"
           },
           "bypass_list_management":{
              "enable":true
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedFooterJson()
    {
        return <<<JSON
        {
           "bcc":{
              "enable":true,
              "email":"test@example.com"
           },
           "bypass_list_management":{
              "enable":true
           },
           "footer":{
              "enable":true,
              "text":"Footer Text",
              "html":"<html><body>Footer Text</body></html>"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedSandBoxModeJson()
    {
        return <<<JSON
        {
           "bcc":{
              "enable":true,
              "email":"test@example.com"
           },
           "bypass_list_management":{
              "enable":true
           },
           "footer":{
              "enable":true,
              "text":"Footer Text",
              "html":"<html><body>Footer Text</body></html>"
           },
           "sandbox_mode":{
              "enable":true
           }
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedSpamCheckJson()
    {
        return <<<JSON
        {
           "bcc":{
              "enable":true,
              "email":"test@example.com"
           },
           "bypass_list_management":{
              "enable":true
           },
           "footer":{
              "enable":true,
              "text":"Footer Text",
              "html":"<html><body>Footer Text</body></html>"
           },
           "sandbox_mode":{
              "enable":true
           },
           "spam_check":{
              "enable":true,
              "threshold":1,
              "post_to_url":"https://spamcatcher.sendgrid.com"
           }
        }
JSON;
    }
}
