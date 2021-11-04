<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../../sendgrid-php.php';

use SendGrid\Mail\To;
use SendGrid\Mail\Cc;
use SendGrid\Mail\Bcc;
use SendGrid\Mail\From;
use SendGrid\Mail\Content;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\Subject;
use SendGrid\Mail\Header;
use SendGrid\Mail\CustomArg;
use SendGrid\Mail\SendAt;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\Asm;
use SendGrid\Mail\MailSettings;
use SendGrid\Mail\BccSettings;
use SendGrid\Mail\SandBoxMode;
use SendGrid\Mail\BypassBounceManagement;
use SendGrid\Mail\BypassListManagement;
use SendGrid\Mail\BypassSpamManagement;
use SendGrid\Mail\BypassUnsubscribeManagement;
use SendGrid\Mail\Footer;
use SendGrid\Mail\SpamCheck;
use SendGrid\Mail\TrackingSettings;
use SendGrid\Mail\ClickTracking;
use SendGrid\Mail\OpenTracking;
use SendGrid\Mail\SubscriptionTracking;
use SendGrid\Mail\Ganalytics;
use SendGrid\Mail\ReplyTo;


function helloEmail()
{
    try {
        $from = new From("test@example.com", "Twilio Sendgrid");
        $subject = "Hello World from the Twilio SendGrid PHP Library";
        $to = new To("test@example.com");
        $content = new Content("text/plain", "some text here");
        $mail = new Mail($from, $to, $subject, $content);

        $personalization = new Personalization();
        $personalization->addTo(new To("test2@example.com"));
        $personalization->addFrom(new From("test3@example.com", "Twilio Sendgrid"));
        $mail->addPersonalization($personalization);

        //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
        return $mail;
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    return null;
}

function kitchenSink()
{
    try {
        $from = new From("test@example.com", "Twilio SendGrid");
        $subject = "Hello World from the Twilio SendGrid PHP Library";
        $to = new To("test1@example.com", "Example User");
        $content = new Content("text/plain", "some text here");

        $mail = new Mail($from, $to, $subject, $content);

        $personalization0 = new Personalization();
        $personalization0->addTo(new To("test2@example.com", "Example User"));
        $personalization0->addFrom(new From("test3@example.com", "Twilio SendGrid"));
        $personalization0->addCc(new Cc("test4@example.com", "Example User"));
        $personalization0->addCc(new Cc("test5@example.com", "Example User"));
        $personalization0->addBcc(new Bcc("test6@example.com", "Example User"));
        $personalization0->addBcc(new Bcc("test7@example.com", "Example User"));
        $personalization0->setSubject(new Subject("Hello World from the Twilio SendGrid PHP Library"));
        $personalization0->addHeader(new Header("X-Test", "test"));
        $personalization0->addHeader(new Header("X-Mock", "true"));
        $personalization0->addSubstitution("%name%", "Example User");
        $personalization0->addSubstitution("%city%", "Denver");
        $personalization0->addSubstitution("%sec1%", "%section1%");
        $personalization0->addCustomArg(new CustomArg("user_id", "343"));
        $personalization0->addCustomArg(new CustomArg("type", "marketing"));
        $personalization0->setSendAt(new SendAt(1443636843));
        $mail->addPersonalization($personalization0);

        $personalization1 = new Personalization();
        $personalization1->addTo(new To("test8@example.com", "Example User"));
        $personalization1->addTo(new To("test9@example.com", "Example User"));
        $personalization1->addFrom(new From("test10@example.com", "Twilio SendGrid"));
        $personalization1->addCc(new Cc("test11@example.com", "Example User"));
        $personalization1->addCc(new Cc("test12@example.com", "Example User"));
        $personalization1->addBcc(new Bcc("test13@example.com", "Example User"));
        $personalization1->addBcc(new Bcc("test14@example.com", "Example User"));
        $personalization1->setSubject(new Subject("Hello World from the Twilio SendGrid PHP Library"));
        $personalization1->addHeader(new Header("X-Test", "test"));
        $personalization1->addHeader(new Header("X-Mock", "true"));
        $personalization1->addSubstitution("%name%", "Example User");
        $personalization1->addSubstitution("%city%", "Denver");
        $personalization1->addSubstitution("%sec2%", "%section2%");
        $personalization1->addCustomArg(new CustomArg("user_id", "343"));
        $personalization1->addCustomArg(new CustomArg("type", "marketing"));
        $personalization1->setSendAt(new SendAt(1443636843));
        $mail->addPersonalization($personalization1);

        // Examples of adding personalization by specifying personalization indexes
        $mail->addCc("test15@example.com", "Example User", null, 0);
        $mail->addBcc("test16@example.com", "Example User", null, 1);

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

        $mail->setTemplateId("439b6d66-4408-4ead-83de-5c83c2ee313a");

        # This must be a valid [batch ID](https://sendgrid.com/docs/API_Reference/SMTP_API/scheduling_parameters.html) to work
        # $mail->setBatchID("sendgrid_batch_id");

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
        // Note: Bypass Spam, Bounce, and Unsubscribe management cannot
        // be combined with Bypass List Management
        $bypass_bounce_management = new BypassBounceManagement();
        $bypass_bounce_management->setEnable(true);
        $mail_settings->setBypassBounceManagement($bypass_bounce_management);
        $bypass_list_management = new BypassListManagement();
        $bypass_list_management->setEnable(true);
        $mail_settings->setBypassListManagement($bypass_list_management);
        $bypass_spam_management = new BypassSpamManagement();
        $bypass_spam_management->setEnable(true);
        $mail_settings->setBypassSpamManagement($bypass_spam_management);
        $bypass_unsubscribe_management = new BypassUnsubscribeManagement();
        $bypass_unsubscribe_management->setEnable(true);
        $mail_settings->setBypassUnsubscribeManagement($bypass_unsubscribe_management);
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

        //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
        return $mail;
    } catch (\Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    return null;
}

function sendHelloEmail()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $request_body = helloEmail();

    if (!($request_body instanceof Mail)) {
        echo 'Invalid request_body to send HelloEmail', "\n";
        return;
    }

    try {
        $response = $sg->client->mail()->send()->post($request_body);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (\Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function sendKitchenSink()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $request_body = kitchenSink();

    if (!($request_body instanceof Mail)) {
        echo 'Invalid request_body to send KitchenSink', "\n";
        return;
    }

    try {
        $response = $sg->client->mail()->send()->post($request_body);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (\Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

sendHelloEmail();  // this will actually send an email
sendKitchenSink(); // this will only send an email if you set SandBox Mode to false
