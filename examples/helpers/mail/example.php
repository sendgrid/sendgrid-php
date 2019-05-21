<?php
namespace SendGrid;

// If you are using Composer
require __DIR__ . '/../../../vendor/autoload.php';
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line

use SendGrid\Mail\To;
use SendGrid\Mail\From;
use SendGrid\Mail\Content;
use SendGrid\Mail\Mail;


function helloEmail()
{
    try {
        $from = new From(null, "test@example.com");
        $subject = "Hello World from the Twilio SendGrid PHP Library";
        $to = new To(null, "test@example.com");
        $content = new Content("text/plain", "some text here");
        $mail = new Mail($from, $to, $subject, $content);

        $to = new To(null, "test2@example.com");
        $mail->addPersonalization($to);

        //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
        return $mail;
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    return null;
}

function kitchenSink()
{
    $from = new Email("DX", "test@example.com");
    $subject = "Hello World from the Twilio SendGrid PHP Library";
    $to = new Email("Example User", "test1@example.com");
    $content = new Content("text/plain", "some text here");

    $mail = new Mail($from, $subject, $to, $content);

    $email2 = new Email("Example User", "test2@example.com");
    $mail->personalization[0]->addTo($email2);
    $email3 = new Email("Example User", "test3@example.com");
    $mail->personalization[0]->addCc($email3);
    $email4 = new Email("Example User", "test4@example.com");
    $mail->personalization[0]->addCc($email4);
    $email5 = new Email("Example User", "test5@example.com");
    $mail->personalization[0]->addBcc($email5);
    $email6 = new Email("Example User", "test6@example.com");
    $mail->personalization[0]->addBcc($email6);
    $mail->personalization[0]->setSubject("Hello World from the Twilio SendGrid PHP Library");
    $mail->personalization[0]->addHeader("X-Test", "test");
    $mail->personalization[0]->addHeader("X-Mock", "true");
    $mail->personalization[0]->addSubstitution("%name%", "Example User");
    $mail->personalization[0]->addSubstitution("%city%", "Denver");
    $mail->personalization[0]->addSubstitution("%sec1%", "%section1%");
    $mail->personalization[0]->addCustomArg("user_id", "343");
    $mail->personalization[0]->addCustomArg("type", "marketing");
    $mail->personalization[0]->setSendAt(1443636843);

    $personalization1 = new Personalization();
    $email7 = new Email("Example User", "test7@example.com");
    $personalization1->addTo($email7);
    $email8 = new Email("Example User", "test8@example.com");
    $personalization1->addTo($email8);
    $email9 = new Email("Example User", "test9@example.com");
    $personalization1->addCc($email9);
    $email10 = new Email("Example User", "test10@example.com");
    $personalization1->addCc($email10);
    $email11 = new Email("Example User", "test11@example.com");
    $personalization1->addBcc($email11);
    $email12 = new Email("Example User", "test12@example.com");
    $personalization1->addBcc($email12);
    $personalization1->setSubject("Hello World from the Twilio SendGrid PHP Library");
    $personalization1->addHeader("X-Test", "test");
    $personalization1->addHeader("X-Mock", "true");
    $personalization1->addSubstitution("%name%", "Example User");
    $personalization1->addSubstitution("%city%", "Denver");
    $personalization1->addSubstitution("%sec2%", "%section2%");
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

    //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
    return $mail;
}

function sendHelloEmail()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $request_body = helloEmail();
    
    try {
        $response = $sg->client->mail()->send()->post($request_body);    
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function sendKitchenSink()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $request_body = kitchenSink();
    
    try {
        $response = $sg->client->mail()->send()->post($request_body);    
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

sendHelloEmail();  // this will actually send an email
sendKitchenSink(); // this will only send an email if you set SandBox Mode to false
?>


