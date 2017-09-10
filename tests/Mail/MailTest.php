<?php

namespace Test\Mail;

use SendGrid\Mail\Optional\Asm;
use SendGrid\Mail\Optional\Attachment;
use SendGrid\Mail\Optional\Collection\AttachmentCollection;
use SendGrid\Content;
use SendGrid\Mail\Essential\Collection\ContentCollection;
use SendGrid\Mail\Optional\Collection\CustomArgumentCollection;
use SendGrid\Mail\Optional\CustomArgument;
use SendGrid\Mail\Optional\Collection\HeaderCollection;
use SendGrid\Mail\Optional\Header;
use SendGrid\Mail\Optional\Collection\CategoryCollection;
use SendGrid\Mail\Optional\Collection\ReplyToCollection;
use SendGrid\Mail\Essential\Collection\ToCollection;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Setting\BccSettings;
use SendGrid\Mail\Setting\ByPassListManagement;
use SendGrid\Mail\Setting\ClickTracking;
use SendGrid\Mail\Setting\Footer;
use SendGrid\Mail\Setting\GoogleAnalytics;
use SendGrid\Mail\Setting\MailSettings;
use SendGrid\Mail\Setting\OpenTracking;
use SendGrid\Mail\Setting\SandBoxMode;
use SendGrid\Mail\Setting\SpamCheck;
use SendGrid\Mail\Setting\SubscriptionTracking;
use SendGrid\Mail\Optional\Category;
use SendGrid\Mail\ValueObject\EmailAddress;
use SendGrid\Mail\Essential\From;
use SendGrid\Mail\Optional\Subject;
use SendGrid\Mail\Essential\To;
use SendGrid\Mail\Optional\Collection\BccCollection;
use SendGrid\Mail\Optional\Collection\CcCollection;
use SendGrid\Mail\Optional\Collection\PersonalizationCollection;
use SendGrid\Mail\Optional\Bcc;
use SendGrid\Mail\Optional\Cc;
use SendGrid\ReplyTo;
use SendGrid\Mail\Optional\Collection\SectionCollection;
use SendGrid\Mail\Optional\Section;
use SendGrid\Mail\Optional\Collection\SubstitutionCollection;
use SendGrid\Mail\Optional\Substitution;
use SendGrid\Mail\Setting\TrackingSettings;

final class MailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return void
     * @test
     */
    public function itShouldSerializeSuccessfully()
    {
        $mail = $this->createBaseMailConfig();
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedBaseMailJson())
        );

        $mail->addCcs(new CcCollection([
            new Cc("test@example.com", "Test User"),
            new Cc('other@example.com', "Other Test User")
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedCcJson())
        );

        $mail->addBccs(new BccCollection([
            new Bcc("test@example.com", "Test User"),
            new Bcc('other@example.com', "Other Test User")
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedBccJson())
        );

        $mail->addHeadersToBasePersonalization(new HeaderCollection([
            new Header('X-Test', 'test'),
            new Header('X-Mock', 'true')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedHeaderPersonalizationJson())
        );

        $mail->addSubstitutions(new SubstitutionCollection([
            new Substitution('%name%', 'Example User'),
            new Substitution('%city%', 'Denver')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedSubstitutionJson())
        );

        $mail->addCustomArgumentsToBasePersonalization(new CustomArgumentCollection([
            new CustomArgument('user_id', '343'),
            new CustomArgument('type', 'marketing')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedCustomArgumentPersonalization())
        );
        $mail->addAttachments(new AttachmentCollection([
            new Attachment('content', 'type', 'name', 'disposition', 'anId'),
            new Attachment('otherContent', 'otherType', 'otherName', 'otherDisposition', 'otherId')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedAttachmentJson())
        );
        $mail->addTemplateId('439b6d66-4408-4ead-83de-5c83c2ee313a');
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedTemplateIdJson())
        );

        $mail->addSections(new SectionCollection([
            new Section('%section1%', 'Substitution Text for Section 1'),
            new Section('%section1%', 'Substitution Text for Section 2')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedSectionJson())
        );

        $mail->addHeaders(new HeaderCollection([
            new Header('X-Test1', '1'),
            new Header('X-Test2', '2')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedHeaderJson())
        );

        $mail->addCategories(new CategoryCollection([
            new Category('May'),
            new Category('2016')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedCategoryJson())
        );

        $mail->addCustomArguments(new CustomArgumentCollection([
            new CustomArgument('campaign', 'welcome'),
            new CustomArgument('weekday', 'morning')
        ]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedCustomArgumentJson())
        );

        $mail->addAsm(new Asm(99, [4,5,6,7,8]));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedAsmJson())
        );

        $mail->addIpPoolName('23');
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedIpPoolNameJson())
        );

        $mail->addBccSettings(new BccSettings(true, new EmailAddress('test@example.com')));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedBccSettingsJson())
        );

        $mail->addByPassListManagement(new ByPassListManagement(true));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedByPassListManagementJson())
        );

        $mail->addFooter(new Footer(true, 'Footer Text', '<html><body>Footer Text</body></html>'));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedFooterJson())
        );

        $mail->addSandBoxMode(new SandBoxMode(true));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getSandBoxModeExpectedJson())
        );

        $mail->addSpamCheck(new SpamCheck(true, 1, 'https://spamcatcher.sendgrid.com'));
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedSpamCheckJson())
        );
        $clickTracking = new ClickTracking(true, true);
        $openTracking = new OpenTracking(true, 'Optional tag to replace');
        $googleAnalytics = new GoogleAnalytics(true, 'source', 'medium', 'term', 'content', 'name');
        $subscriptionTracking = new SubscriptionTracking(
            true,
            'text to insert into the text/plain portion of the message',
            '<html><body>html to insert into the text/html portion of the message</body></html>',
            'Optional tag to replace with the open image in the body of the message'
        );

        $trackingSettings = (new TrackingSettings)->addClickTracking($clickTracking)
                                                  ->addOpenTracking($openTracking)
                                                  ->addGoogleAnalytics($googleAnalytics)
                                                  ->addSubscriptionTracking($subscriptionTracking);

        $mail->addTrackingSettings($trackingSettings);
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedTrackingSettingsJson())
        );

        $repliesTo = new ReplyToCollection([
            new ReplyTo('test@example.com'),
            new ReplyTo('other@example.com'),
            new ReplyTo('last@example.com')
        ]);
        $mail->addRepliesTo($repliesTo);
        $this->assertSame(
            json_encode($mail),
            $this->getEncoded($this->getExpectedRepliesToJson())
        );
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\PersonalizationCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyPersonalizationCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addPersonalizations(new PersonalizationCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\AttachmentCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyAttachmentCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addAttachments(new AttachmentCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Essential\Exception\ContentCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyContentCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addContents(new ContentCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\SectionCollectionIsEmptyException
     */
    public function itShouldFailIfEmptySectionCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addSections(new SectionCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\HeaderCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyHeaderCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addHeaders(new HeaderCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\CategoryCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyCategoryCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addCategories(new CategoryCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\CustomArgumentCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyCustomArgumentCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addCustomArguments(new CustomArgumentCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add an empty collection it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Optional\Exception\ReplyToCollectionIsEmptyException
     */
    public function itShouldFailIfEmptyReplyToCollectionIsAdded()
    {
        $this->createBaseMailConfig()
             ->addRepliesTo(new ReplyToCollection);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add empty settings it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\MailSettingsIsEmptyException
     */
    public function itShouldFailIfEmptyMailSettingsIsAdded()
    {
        $this->createBaseMailConfig()
             ->addMailSettings(new MailSettings);
    }

    /**
     * Library should be strict and Mail should always be in a valid state,
     * therefore, if we try to add empty settings it should throw an exception
     *
     * @return void
     * @test
     * @expectedException \SendGrid\Mail\Setting\Exception\TrackingSettingsIsEmptyException
     */
    public function itShouldFailIfEmptyTrackingSettingsIsAdded()
    {
        $this->createBaseMailConfig()
             ->addTrackingSettings(new TrackingSettings);
    }

    /**
     * @return Mail
     */
    private function createBaseMailConfig()
    {
        $from = new From('sendgrid@sendgrid.com', 'SendGrid PHP');
        $subject = new Subject('Hello World from the SendGrid PHP Library');
        $tos = new ToCollection([
            new To("test@example.com", "Test User"),
            new To('other@example.com', "Other Test User")
        ]);
        $content = new ContentCollection([
            new Content('text/plain', 'some text here'),
            new Content('text/html', '<html><body>some text here</body></html>')
        ]);

        return new Mail($from, $tos, $content, $subject);
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
    private function getExpectedBaseMailJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedCcJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedBccJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedHeaderPersonalizationJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedSubstitutionJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedCustomArgumentPersonalization()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library"
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedAttachmentJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ]
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedTemplateIdJson()
    {
        return <<<JSOn
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a"
        }
JSOn;
    }

    /**
     * @return string
     */
    private function getExpectedSectionJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedHeaderJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedCategoryJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text\/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ]
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedCustomArgumentJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text\/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedAsmJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           }
        }
JSON;
    }


    private function getExpectedIpPoolNameJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23"
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedBccSettingsJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text\/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
              "bcc":{
                 "enable":true,
                 "email":"test@example.com"
              }
           }
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedByPassListManagementJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text\/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
              "bcc":{
                 "enable":true,
                 "email":"test@example.com"
              },
              "bypass_list_management":{
                 "enable":true
              }
           }
        }
JSON;
    }

    /**
     * @return string
     */
    public function getExpectedFooterJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
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
        }
JSON;
    }

    /**
     * @return string
     */
    public function getSandBoxModeExpectedJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text\/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
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
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
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
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedTrackingSettingsJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
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
           },
           "tracking_settings":{
              "click_tracking":{
                 "enable":true,
                 "enable_text":true
              },
              "open_tracking":{
                 "enable":true,
                 "substitution_tag":"Optional tag to replace"
              },
              "subscription_tracking":{
                 "enable":true,
                 "text":"text to insert into the text/plain portion of the message",
                 "html":"<html><body>html to insert into the text/html portion of the message</body></html>",
                 "substitution_tag":"Optional tag to replace with the open image in the body of the message"
              },
              "ganalytics":{
                 "enable":true,
                 "utm_source":"source",
                 "utm_medium":"medium",
                 "utm_term":"term",
                 "utm_content":"content",
                 "utm_campaign":"content"
              }
           }
        }
JSON;
    }

    /**
     * @return string
     */
    private function getExpectedRepliesToJson()
    {
        return <<<JSON
        {
           "from":{
              "name":"SendGrid PHP",
              "email":"sendgrid@sendgrid.com"
           },
           "personalizations":[
              {
                 "to":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "cc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "bcc":[
                    {
                       "name":"Test User",
                       "email":"test@example.com"
                    },
                    {
                       "name":"Other Test User",
                       "email":"other@example.com"
                    }
                 ],
                 "subject":"Hello World from the SendGrid PHP Library",
                 "headers":{
                    "X-Test":"test",
                    "X-Mock":"true"
                 },
                 "substitutions":{
                    "%name%":"Example User",
                    "%city%":"Denver"
                 },
                 "custom_args":{
                    "user_id":"343",
                    "type":"marketing"
                 },
                 "send_at":{$this->getSendAt()}
              }
           ],
           "content":[
              {
                 "type":"text\/plain",
                 "value":"some text here"
              },
              {
                 "type":"text/html",
                 "value":"<html><body>some text here</body></html>"
              }
           ],
           "subject":"Hello World from the SendGrid PHP Library",
           "attachments":[
              {
                 "content":"content",
                 "type":"type",
                 "filename":"name",
                 "disposition":"disposition",
                 "content_id":"anId"
              },
              {
                 "content":"otherContent",
                 "type":"otherType",
                 "filename":"otherName",
                 "disposition":"otherDisposition",
                 "content_id":"otherId"
              }
           ],
           "template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a",
           "sections":{
              "%section1%":"Substitution Text for Section 2"
           },
           "headers":{
              "X-Test1":"1",
              "X-Test2":"2"
           },
           "categories":[
              "May",
              "2016"
           ],
           "custom_args":{
              "campaign":"welcome",
              "weekday":"morning"
           },
           "asm":{
              "group_id":99,
              "groups_to_display":[
                 4,
                 5,
                 6,
                 7,
                 8
              ]
           },
           "ip_pool_name":"23",
           "mail_settings":{
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
           },
           "tracking_settings":{
              "click_tracking":{
                 "enable":true,
                 "enable_text":true
              },
              "open_tracking":{
                 "enable":true,
                 "substitution_tag":"Optional tag to replace"
              },
              "subscription_tracking":{
                 "enable":true,
                 "text":"text to insert into the text/plain portion of the message",
                 "html":"<html><body>html to insert into the text/html portion of the message</body></html>",
                 "substitution_tag":"Optional tag to replace with the open image in the body of the message"
              },
              "ganalytics":{
                 "enable":true,
                 "utm_source":"source",
                 "utm_medium":"medium",
                 "utm_term":"term",
                 "utm_content":"content",
                 "utm_campaign":"content"
              }
           },
           "reply_to":[
              {
                 "email":"test@example.com"
              },
              {
                 "email":"other@example.com"
              },
              {
                 "email":"last@example.com"
              }
           ]
        }
JSON;
    }

    /**
     * @return false|int
     */
    private function getSendAt()
    {
        return strtotime((new \DateTime)->format('Y-m-d H:i:s'));
    }
}
