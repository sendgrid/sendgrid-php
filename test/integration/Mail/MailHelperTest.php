<?php

use \SendGrid\Mail\EmailAddress as EmailAddress;
use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\MimeType as MimeType;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;
use \SendGrid\Mail\Cc as Cc;
use \SendGrid\Mail\Bcc as Bcc;
use \SendGrid\Mail\Header as Header;
use \SendGrid\Mail\Substitution as Substitution;
use \SendGrid\Mail\CustomArg as CustomArg;
use \SendGrid\Mail\SendAt as SendAt;
use \SendGrid\Mail\Content as Content;
use \SendGrid\Mail\Attachment as Attachment;
use \SendGrid\Mail\TemplateId as TemplateId;
use \SendGrid\Mail\Section as Section;
use \SendGrid\Mail\ReplyTo as ReplyTo;
use \SendGrid\Mail\Category as Category;
use \SendGrid\Mail\BatchId as BatchId;
use \SendGrid\Mail\Asm as Asm;
use \SendGrid\Mail\GroupId as GroupId;
use \SendGrid\Mail\GroupsToDisplay as GroupsToDisplay;
use \SendGrid\Mail\IpPoolName as IpPoolName;
use \SendGrid\Mail\MailSettings as MailSettings;
use \SendGrid\Mail\BccSettings as BccSettings;
use \SendGrid\Mail\BypassListManagement as BypassListManagement;
use \SendGrid\Mail\Footer as Footer;
use \SendGrid\Mail\SandBoxMode as SandBoxMode;
use \SendGrid\Mail\SpamCheck as SpamCheck;
use \SendGrid\Mail\TrackingSettings as TrackingSettings;
use \SendGrid\Mail\ClickTracking as ClickTracking;
use \SendGrid\Mail\OpenTracking as OpenTracking;
use \SendGrid\Mail\SubscriptionTracking as SubscriptionTracking;
use \SendGrid\Mail\Ganalytics as Ganalytics;

class MailTest_Mail extends \PHPUnit\Framework\TestCase
{
    public function testEmailName()
    {
        $email = new EmailAddress('test@example.com', 'John Doe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"John Doe","email":"test@example.com"}');

        $email->setName('');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"email":"test@example.com"}');

        $email->setName(null);
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"email":"test@example.com"}');

        $email->setName('Doe, John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"\\"Doe, John\\"","email":"test@example.com"}');

        $email->setName('Doe; John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"\\"Doe; John\\"","email":"test@example.com"}');

        $email->setName('John "Billy" O\'Keeffe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"John \\"Billy\\" O\'Keeffe","email":"test@example.com"}');

        $email->setName('O\'Keeffe, John "Billy"');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"\\"O\'Keeffe, John \\\\\\"Billy\\\\\\"\\"","email":"test@example.com"}');
    }
}
