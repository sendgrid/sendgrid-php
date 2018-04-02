<?php

namespace SendGridPhp\Tests\helpers\mail;

use PHPUnit\Framework\TestCase;
use SendGrid\ASM;
use SendGrid\Attachment;
use SendGrid\BccSettings;
use SendGrid\BypassListManagement;
use SendGrid\ClickTracking;
use SendGrid\Content;
use SendGrid\Email;
use SendGrid\Footer;
use SendGrid\Ganalytics;
use SendGrid\Mail;
use SendGrid\MailSettings;
use SendGrid\OpenTracking;
use SendGrid\Personalization;
use SendGrid\ReplyTo;
use SendGrid\SandBoxMode;
use SendGrid\SpamCheck;
use SendGrid\SubscriptionTracking;
use SendGrid\TrackingSettings;

class MailHelperTest extends TestCase
{
    public function testBaseLineExample()
    {
        $from = new Email(null, "test@example.com");
        $to = new Email(null, "test@example.com");
        $subject = "Hello World from the SendGrid PHP Library";
        $content = new Content("text/plain", "some text here");
        $mail = new Mail($from, $subject, $to, $content);

        $content = new Content("text/html", "<html><body>some text here</body></html>");
        $mail->addContent($content);

        $json = json_encode($mail);

        $this->assertEquals($json, '{"from":{"email":"test@example.com"},"personalizations":[{"to":[{"email":"test@example.com"}]}],"subject":"Hello World from the SendGrid PHP Library","content":[{"type":"text\/plain","value":"some text here"},{"type":"text\/html","value":"<html><body>some text here<\/body><\/html>"}]}');
    }

    public function testKitchenSinkExample()
    {
        $from = new Email("DX", "test@example.com");
        $subject = "Hello World from the SendGrid PHP Library";
        $to = new Email("Example User", "test@example.com");
        $content = new Content("text/plain", "some text here");
        $mail = new Mail($from, $subject, $to, $content);

        $email = new Email("Example User", "test@example.com");
        $mail->personalization[0]->addTo($email);
        $email = new Email("Example User", "test@example.com");
        $mail->personalization[0]->addCc($email);
        $email = new Email("Example User", "test@example.com");
        $mail->personalization[0]->addCc($email);
        $email = new Email("Example User", "test@example.com");
        $mail->personalization[0]->addBcc($email);
        $email = new Email("Example User", "test@example.com");
        $mail->personalization[0]->addBcc($email);
        $mail->personalization[0]->setSubject("Hello World from the SendGrid PHP Library");
        $mail->personalization[0]->addHeader("X-Test", "test");
        $mail->personalization[0]->addHeader("X-Mock", "true");
        $mail->personalization[0]->addSubstitution("%name%", "Example User");
        $mail->personalization[0]->addSubstitution("%city%", "Denver");
        $mail->personalization[0]->addCustomArg("user_id", "343");
        $mail->personalization[0]->addCustomArg("type", "marketing");
        $mail->personalization[0]->setSendAt(1443636843);

        $personalization1 = new Personalization();
        $email = new Email("Example User", "test@example.com");
        $personalization1->addTo($email);
        $email = new Email("Example User", "test@example.com");
        $personalization1->addTo($email);
        $email = new Email("Example User", "test@example.com");
        $personalization1->addCc($email);
        $email = new Email("Example User", "test@example.com");
        $personalization1->addCc($email);
        $email = new Email("Example User", "test@example.com");
        $personalization1->addBcc($email);
        $email = new Email("Example User", "test@example.com");
        $personalization1->addBcc($email);
        $personalization1->setSubject("Hello World from the SendGrid PHP Library");
        $personalization1->addHeader("X-Test", "test");
        $personalization1->addHeader("X-Mock", "true");
        $personalization1->addSubstitution("%name%", "Example User");
        $personalization1->addSubstitution("%city%", "Denver");
        $personalization1->addCustomArg("user_id", "343");
        $personalization1->addCustomArg("type", "marketing");
        $personalization1->setSendAt(1443636843);
        $mail->addPersonalization($personalization1);

        $content = new Content("text/html", "<html><body>some text here</body></html>");
        $mail->addContent($content);

        $attachment = new Attachment();
        $attachment->setContent("TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12");
        $attachment->setType("application/pdf");
        $attachment->setFilename("balance_001.pdf");
        $attachment->setDisposition("attachment");
        $attachment->setContentId("Balance Sheet");
        $mail->addAttachment($attachment);

        $attachment2 = new Attachment();
        $attachment2->setContent("BwdW");
        $attachment2->setType("image/png");
        $attachment2->setFilename("banner.png");
        $attachment2->setDisposition("inline");
        $attachment2->setContentId("Banner");
        $mail->addAttachment($attachment2);

        $attachment3 = new Attachment();
        $attachment3->setContentPath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'test.txt');
        $attachment3->setType('text/plain');
        $attachment3->setDisposition('attachment');
        $attachment3->setContentID('My text');
        $mail->addAttachment($attachment3);

        $mail->setTemplateId("439b6d66-4408-4ead-83de-5c83c2ee313a");

        $mail->addSection("%section1%", "Substitution Text for Section 1");
        $mail->addSection("%section2%", "Substitution Text for Section 2");

        $mail->addHeader("X-Test1", "1");
        $mail->addHeader("X-Test2", "2");

        $mail->addCategory("May");
        $mail->addCategory("2016");

        $mail->addCustomArg("campaign", "welcome");
        $mail->addCustomArg("weekday", "morning");

        $mail->setSendAt(1443636842);

        $asm = new ASM();
        $asm->setGroupId(99);
        $asm->setGroupsToDisplay([4,5,6,7,8]);
        $mail->setASM($asm);

        $mail->setIpPoolName("23");

        $mail_settings = new MailSettings();
        $bcc_settings = new BccSettings();
        $bcc_settings->setEnable(true);
        $bcc_settings->setEmail("test@example.com");
        $mail_settings->setBccSettings($bcc_settings);
        $sandbox_mode = new SandBoxMode();
        $sandbox_mode->setEnable(true);
        $mail_settings->setSandboxMode($sandbox_mode);
        $bypass_list_management = new BypassListManagement();
        $bypass_list_management->setEnable(true);
        $mail_settings->setBypassListManagement($bypass_list_management);
        $footer = new Footer();
        $footer->setEnable(true);
        $footer->setText("Footer Text");
        $footer->setHtml("<html><body>Footer Text</body></html>");
        $mail_settings->setFooter($footer);
        $spam_check = new SpamCheck();
        $spam_check->setEnable(true);
        $spam_check->setThreshold(1);
        $spam_check->setPostToUrl("https://spamcatcher.sendgrid.com");
        $mail_settings->setSpamCheck($spam_check);
        $mail->setMailSettings($mail_settings);

        $tracking_settings = new TrackingSettings();
        $click_tracking = new ClickTracking();
        $click_tracking->setEnable(true);
        $click_tracking->setEnableText(true);
        $tracking_settings->setClickTracking($click_tracking);
        $open_tracking = new OpenTracking();
        $open_tracking->setEnable(true);
        $open_tracking->setSubstitutionTag("Optional tag to replace with the open image in the body of the message");
        $tracking_settings->setOpenTracking($open_tracking);
        $subscription_tracking = new SubscriptionTracking();
        $subscription_tracking->setEnable(true);
        $subscription_tracking->setText("text to insert into the text/plain portion of the message");
        $subscription_tracking->setHtml("<html><body>html to insert into the text/html portion of the message</body></html>");
        $subscription_tracking->setSubstitutionTag("Optional tag to replace with the open image in the body of the message");
        $tracking_settings->setSubscriptionTracking($subscription_tracking);
        $ganalytics = new Ganalytics();
        $ganalytics->setEnable(true);
        $ganalytics->setCampaignSource("some source");
        $ganalytics->setCampaignTerm("some term");
        $ganalytics->setCampaignContent("some content");
        $ganalytics->setCampaignName("some name");
        $ganalytics->setCampaignMedium("some medium");
        $tracking_settings->setGanalytics($ganalytics);
        $mail->setTrackingSettings($tracking_settings);

        $reply_to = new ReplyTo("test@example.com", "Optional Name");
        $mail->setReplyTo($reply_to);

        $json = json_encode($mail);

        $this->assertEquals($json, '{"from":{"name":"DX","email":"test@example.com"},"personalizations":[{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843},{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843}],"subject":"Hello World from the SendGrid PHP Library","content":[{"type":"text\/plain","value":"some text here"},{"type":"text\/html","value":"<html><body>some text here<\/body><\/html>"}],"attachments":[{"content":"TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12","type":"application\/pdf","filename":"balance_001.pdf","disposition":"attachment","content_id":"Balance Sheet"},{"content":"BwdW","type":"image\/png","filename":"banner.png","disposition":"inline","content_id":"Banner"},{"content":"aGVsbG8K","type":"text\/plain","filename":"test.txt","disposition":"attachment","content_id":"My text"}],"template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a","sections":{"%section1%":"Substitution Text for Section 1","%section2%":"Substitution Text for Section 2"},"headers":{"X-Test1":"1","X-Test2":"2"},"categories":["May","2016"],"custom_args":{"campaign":"welcome","weekday":"morning"},"send_at":1443636842,"asm":{"group_id":99,"groups_to_display":[4,5,6,7,8]},"ip_pool_name":"23","mail_settings":{"bcc":{"enable":true,"email":"test@example.com"},"bypass_list_management":{"enable":true},"footer":{"enable":true,"text":"Footer Text","html":"<html><body>Footer Text<\/body><\/html>"},"sandbox_mode":{"enable":true},"spam_check":{"enable":true,"threshold":1,"post_to_url":"https:\/\/spamcatcher.sendgrid.com"}},"tracking_settings":{"click_tracking":{"enable":true,"enable_text":true},"open_tracking":{"enable":true,"substitution_tag":"Optional tag to replace with the open image in the body of the message"},"subscription_tracking":{"enable":true,"text":"text to insert into the text\/plain portion of the message","html":"<html><body>html to insert into the text\/html portion of the message<\/body><\/html>","substitution_tag":"Optional tag to replace with the open image in the body of the message"},"ganalytics":{"enable":true,"utm_source":"some source","utm_medium":"some medium","utm_term":"some term","utm_content":"some content","utm_campaign":"some name"}},"reply_to":{"email":"test@example.com","name":"Optional Name"}}');
        $reply_to = new ReplyTo("test@example.com");
        $mail->setReplyTo($reply_to);

        $json = json_encode($mail);

        $this->assertEquals($json, '{"from":{"name":"DX","email":"test@example.com"},"personalizations":[{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843},{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843}],"subject":"Hello World from the SendGrid PHP Library","content":[{"type":"text\/plain","value":"some text here"},{"type":"text\/html","value":"<html><body>some text here<\/body><\/html>"}],"attachments":[{"content":"TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12","type":"application\/pdf","filename":"balance_001.pdf","disposition":"attachment","content_id":"Balance Sheet"},{"content":"BwdW","type":"image\/png","filename":"banner.png","disposition":"inline","content_id":"Banner"},{"content":"aGVsbG8K","type":"text\/plain","filename":"test.txt","disposition":"attachment","content_id":"My text"}],"template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a","sections":{"%section1%":"Substitution Text for Section 1","%section2%":"Substitution Text for Section 2"},"headers":{"X-Test1":"1","X-Test2":"2"},"categories":["May","2016"],"custom_args":{"campaign":"welcome","weekday":"morning"},"send_at":1443636842,"asm":{"group_id":99,"groups_to_display":[4,5,6,7,8]},"ip_pool_name":"23","mail_settings":{"bcc":{"enable":true,"email":"test@example.com"},"bypass_list_management":{"enable":true},"footer":{"enable":true,"text":"Footer Text","html":"<html><body>Footer Text<\/body><\/html>"},"sandbox_mode":{"enable":true},"spam_check":{"enable":true,"threshold":1,"post_to_url":"https:\/\/spamcatcher.sendgrid.com"}},"tracking_settings":{"click_tracking":{"enable":true,"enable_text":true},"open_tracking":{"enable":true,"substitution_tag":"Optional tag to replace with the open image in the body of the message"},"subscription_tracking":{"enable":true,"text":"text to insert into the text\/plain portion of the message","html":"<html><body>html to insert into the text\/html portion of the message<\/body><\/html>","substitution_tag":"Optional tag to replace with the open image in the body of the message"},"ganalytics":{"enable":true,"utm_source":"some source","utm_medium":"some medium","utm_term":"some term","utm_content":"some content","utm_campaign":"some name"}},"reply_to":{"email":"test@example.com"}}');

        $reply_to = new ReplyTo("test@example.com", null);
        $mail->setReplyTo($reply_to);

        $json = json_encode($mail);

        $this->assertEquals($json, '{"from":{"name":"DX","email":"test@example.com"},"personalizations":[{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843},{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"cc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"bcc":[{"name":"Example User","email":"test@example.com"},{"name":"Example User","email":"test@example.com"}],"subject":"Hello World from the SendGrid PHP Library","headers":{"X-Test":"test","X-Mock":"true"},"substitutions":{"%name%":"Example User","%city%":"Denver"},"custom_args":{"user_id":"343","type":"marketing"},"send_at":1443636843}],"subject":"Hello World from the SendGrid PHP Library","content":[{"type":"text\/plain","value":"some text here"},{"type":"text\/html","value":"<html><body>some text here<\/body><\/html>"}],"attachments":[{"content":"TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12","type":"application\/pdf","filename":"balance_001.pdf","disposition":"attachment","content_id":"Balance Sheet"},{"content":"BwdW","type":"image\/png","filename":"banner.png","disposition":"inline","content_id":"Banner"},{"content":"aGVsbG8K","type":"text\/plain","filename":"test.txt","disposition":"attachment","content_id":"My text"}],"template_id":"439b6d66-4408-4ead-83de-5c83c2ee313a","sections":{"%section1%":"Substitution Text for Section 1","%section2%":"Substitution Text for Section 2"},"headers":{"X-Test1":"1","X-Test2":"2"},"categories":["May","2016"],"custom_args":{"campaign":"welcome","weekday":"morning"},"send_at":1443636842,"asm":{"group_id":99,"groups_to_display":[4,5,6,7,8]},"ip_pool_name":"23","mail_settings":{"bcc":{"enable":true,"email":"test@example.com"},"bypass_list_management":{"enable":true},"footer":{"enable":true,"text":"Footer Text","html":"<html><body>Footer Text<\/body><\/html>"},"sandbox_mode":{"enable":true},"spam_check":{"enable":true,"threshold":1,"post_to_url":"https:\/\/spamcatcher.sendgrid.com"}},"tracking_settings":{"click_tracking":{"enable":true,"enable_text":true},"open_tracking":{"enable":true,"substitution_tag":"Optional tag to replace with the open image in the body of the message"},"subscription_tracking":{"enable":true,"text":"text to insert into the text\/plain portion of the message","html":"<html><body>html to insert into the text\/html portion of the message<\/body><\/html>","substitution_tag":"Optional tag to replace with the open image in the body of the message"},"ganalytics":{"enable":true,"utm_source":"some source","utm_medium":"some medium","utm_term":"some term","utm_content":"some content","utm_campaign":"some name"}},"reply_to":{"email":"test@example.com"}}');
    }

    public function testEmailName()
    {
        $email = new Email('John Doe', 'test@example.com');
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
