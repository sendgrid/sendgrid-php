<?php
namespace SendGrid;

// If you are using Composer
require __DIR__ . '<PATH_TO>/vendor/autoload.php';

use SendGrid\SendGrid;
use SendGrid\Helper\Mail\ASM;
use SendGrid\Helper\Mail\Attachment;
use SendGrid\Helper\Mail\BccSettings;
use SendGrid\Helper\Mail\BypassListManagement;
use SendGrid\Helper\Mail\ClickTracking;
use SendGrid\Helper\Mail\Content;
use SendGrid\Helper\Mail\Email;
use SendGrid\Helper\Mail\Footer;
use SendGrid\Helper\Mail\Mail;
use SendGrid\Helper\Mail\MailSettings;
use SendGrid\Helper\Mail\OpenTracking;
use SendGrid\Helper\Mail\Personalization;
use SendGrid\Helper\Mail\ReplyTo;
use SendGrid\Helper\Mail\SandBoxMode;
use SendGrid\Helper\Mail\SpamCheck;
use SendGrid\Helper\Mail\SubscriptionTracking;
use SendGrid\Helper\Mail\TrackingSettings;
use SendGrid\Helper\Mail\Ganalytics;

function helloEmail()
{
    $from = new Email(null, "test@example.com");
    $subject = "Hello World from the SendGrid PHP Library";
    $to = new Email(null, "test@example.com");
    $content = new Content("text/plain", "some text here");
    $mail = new Mail($from, $subject, $to, $content);
    $to = new Email(null, "test2@example.com");
    $mail->personalization[0]->addTo($to);

    //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
    return $mail;
}

function kitchenSink()
{
    $mail = new Mail();

    $email = new Email("DX", "test@example.com");
    $mail->setFrom($email)
        ->setSubject("Hello World from the SendGrid PHP Library");

    $personalization = new Personalization();
    $email1 = new Email("Example User", "test1@example.com");
    $personalization->addTo($email1);
    $email2 = new Email("Example User", "test2@example.com");
    $personalization->addTo($email2);
    $email3 = new Email("Example User", "test3@example.com");
    $personalization->addCc($email3);
    $email4 = new Email("Example User", "test4@example.com");
    $personalization->addCc($email4);
    $email5 = new Email("Example User", "test5@example.com");
    $personalization->addBcc($email5);
    $email6 = new Email("Example User", "test6@example.com");
    $personalization->addBcc($email6)
        ->setSubject("Hello World from the SendGrid PHP Library")
        ->addHeader("X-Test", "test")
        ->addHeader("X-Mock", "true")
        ->addSubstitution("%name%", "Example User")
        ->addSubstitution("%city%", "Denver")
        ->addCustomArg("user_id", "343")
        ->addCustomArg("type", "marketing")
        ->setSendAt(1443636843);
    $mail->addPersonalization($personalization);

    $personalization2 = new Personalization();
    $email7 = new Email("Example User", "test7@example.com");
    $personalization2->addTo($email7);
    $email8 = new Email("Example User", "test8@example.com");
    $personalization2->addTo($email8);
    $email9 = new Email("Example User", "test9@example.com");
    $personalization2->addCc($email9);
    $email10 = new Email("Example User", "test10@example.com");
    $personalization2->addCc($email10);
    $email11 = new Email("Example User", "test11@example.com");
    $personalization2->addBcc($email11);
    $email12 = new Email("Example User", "test12@example.com");
    $personalization2->addBcc($email12)
        ->setSubject("Hello World from the SendGrid PHP Library")
        ->addHeader("X-Test", "test")
        ->addHeader("X-Mock", "true")
        ->addSubstitution("%name%", "Example User")
        ->addSubstitution("%city%", "Denver")
        ->addCustomArg("user_id", "343")
        ->addCustomArg("type", "marketing")
        ->setSendAt(1443636843);
    $mail->addPersonalization($personalization2);

    $content = new Content("text/plain", "some text here");
    $mail->addContent($content);
    $content = new Content("text/html", "<html><body>some text here</body></html>");
    $mail->addContent($content);

    $attachment = new Attachment();
    $attachment->setContent("TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12")
        ->setType("application/pdf")
        ->setFilename("balance_001.pdf")
        ->setDisposition("attachment")
        ->setContentId("Balance Sheet");
    $mail->addAttachment($attachment);

    $attachment2 = new Attachment();
    $attachment2->setContent("BwdW")
        ->setType("image/png")
        ->setFilename("banner.png")
        ->setDisposition("inline")
        ->setContentId("Banner");
    $mail->addAttachment($attachment2);

    $mail->setTemplateId("439b6d66-4408-4ead-83de-5c83c2ee313a");

    # This must be a valid [batch ID](https://sendgrid.com/docs/API_Reference/SMTP_API/scheduling_parameters.html) to work
    # $mail->setBatchID("sengrid_batch_id");

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
    $bcc_settings->setEnable(true)
        ->setEmail("test@example.com");
    $mail_settings->setBccSettings($bcc_settings);
    $sandbox_mode = new SandBoxMode();
    $sandbox_mode->setEnable(true);
    $mail_settings->setSandboxMode($sandbox_mode);
    $bypass_list_management = new BypassListManagement();
    $bypass_list_management->setEnable(true);
    $mail_settings->setBypassListManagement($bypass_list_management);
    $footer = new Footer();
    $footer->setEnable(true)
        ->setText("Footer Text")
        ->setHtml("<html><body>Footer Text</body></html>");
    $mail_settings->setFooter($footer);
    $spam_check = new SpamCheck();
    $spam_check->setEnable(true)
        ->setThreshold(1)
        ->setPostToUrl("https://spamcatcher.sendgrid.com");
    $mail_settings->setSpamCheck($spam_check);
    $mail->setMailSettings($mail_settings);

    $tracking_settings = new TrackingSettings();
    $click_tracking = new ClickTracking();
    $click_tracking->setEnable(true)
        ->setEnableText(true);
    $tracking_settings->setClickTracking($click_tracking);
    $open_tracking = new OpenTracking();
    $open_tracking->setEnable(true)
        ->setSubstitutionTag("Optional tag to replace with the open image in the body of the message");
    $tracking_settings->setOpenTracking($open_tracking);
    $subscription_tracking = new SubscriptionTracking();
    $subscription_tracking->setEnable(true)
        ->setText("text to insert into the text/plain portion of the message")
        ->setHtml("<html><body>html to insert into the text/html portion of the message</body></html>")
        ->setSubstitutionTag("Optional tag to replace with the open image in the body of the message");
    $tracking_settings->setSubscriptionTracking($subscription_tracking);
    $ganalytics = new Ganalytics();
    $ganalytics->setEnable(true)
        ->setCampaignSource("some source")
        ->setCampaignTerm("some term")
        ->setCampaignContent("some content")
        ->setCampaignName("some name")
        ->setCampaignMedium("some medium");
    $tracking_settings->setGanalytics($ganalytics);
    $mail->setTrackingSettings($tracking_settings);

    $reply_to = new ReplyTo("test@example.com");
    $mail->setReplyTo($reply_to);

    //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
    return $mail;
}

function sendHelloEmail()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new SendGrid($apiKey);

    $request_body = helloEmail();
    $response = $sg->client->mail()->send()->post($request_body);
    echo $response->statusCode();
    echo $response->body();
    print_r($response->headers());
}

function sendKitchenSink()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new SendGrid($apiKey);

    $request_body = kitchenSink();
    $response = $sg->client->mail()->send()->post($request_body);
    echo $response->statusCode();
    echo $response->body();
    print_r($response->headers());
}

sendHelloEmail();  // this will actually send an email
sendKitchenSink(); // this will only send an email if you set SandBox Mode to false
?>


