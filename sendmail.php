<?php
use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\MimeType as MimeType;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;

require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line

// Send a Single Email to a Single Recipient

$from = new From("dx@example.com", "DX Team");
$to = new To("test@example.com", "Elmer Thomas");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email = new Mail(
    $from,
    $to,
    $subject,
    $plainTextContent,
    $htmlContent
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

// Send a Single Email to Multiple Recipients

// $from = new From("dx@example.com", "DX Team");
// $tos = [ 
//     new To("test+test1@example.com", "Elmer Thomas1"),
//     new To("test+test2@example.com", "Elmer Thomas2"),
//     new To("test+test3@example.com", "Elmer Thomas3")
// ];
// $subject = new Subject("Sending with SendGrid is Fun");
// $plainTextContent = new PlainTextContent(
//     "and easy to do anywhere, even with PHP"
// );
// $htmlContent = new HtmlContent(
//     "<strong>and easy to do anywhere, even with PHP</strong>"
// );
// $email = new Mail(
//     $from,
//     $tos,
//     $subject,
//     $plainTextContent,
//     $htmlContent
// );
// $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//     $response = $sendgrid->send($email);
// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
// }
// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

// Send Multiple Emails to Multiple Recipients

// $from = new From("dx@example.com", "DX Team");
// $tos = [ 
//     new To(
//         "test+test1@example.com",
//         "Elmer Thomas1",
//         [
//             '-name-' => 'Elmer 1',
//             '-github-' => 'http://github.com/elmer1'
//         ],
//         "Subject 1 -name-"
//     ),
//     new To(
//         "test+test2@example.com",
//         "Elmer Thomas2",
//         [
//             '-name-' => 'Elmer 2',
//             '-github-' => 'http://github.com/elmer2'
//         ],
//         "Subject 2 -name-"
//     ),
//     new To(
//         "test+test3@example.com",
//         "Elmer Thomas3",
//         [
//             '-name-' => 'Elmer 3',
//             '-github-' => 'http://github.com/elmer3'
//         ]
//     )
// ];
// $subject = new Subject("Hi -name-!"); // default subject 
// // Alternatively, you can pass in a collection of subjects OR
// // add a subject to the `To` object
// // $subject = [
// //     "Elmer 1.0 -name-",
// //     "Elmer 2.0 -name-",
// //     "Elmer 3.0 -name-"
// // ];
// $globalSubstitutions = [
//     '-time-' => date("Y-m-d H:i:s")
// ];
// $plainTextContent = new PlainTextContent("Hello -name-, your github is -github- sent at -time-");
// $htmlContent = new HtmlContent("<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-");
// $email = new Mail(
//     $from,
//     $tos,
//     $subject, // or array of subjects, these take precendence
//     $plainTextContent,
//     $htmlContent,
//     $globalSubstitutions
// );
// $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//     $response = $sendgrid->send($email);
// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
// }
// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

// Kitchen Sink - an example with all settings used

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

$from = new From("dx@example.com", "DX Team");
$to = new To("test@example.com", "Elmer Thomas");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email = new Mail();

// For a detailed description of each of these settings, please see the [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
$email->setSubject($subject);
// $email->setSubject("Sending with SendGrid is Fun 2");
$email->addTo($to);
$email->addTo("test+1@example.com", "Elmer Thomas 1");
$toEmails = [ 
    new To("test+2@example.com", "Elmer Thomas 2"),
    new To("test+3@example.com", "Elmer Thomas 3")
];
// $toEmails = [ 
//     "test+2@example.com" => "Elmer Thomas 2",
//     "test+3@example.com" => "Elmer Thomas 3"
// ];
$email->addTos($toEmails);
$email->addCc(new Cc("test+4@example.com", "Elmer Thomas 4"));
$email->addCc("test+5@example.com", "Elmer Thomas 5");
$ccEmails = [ 
    new Cc("test+6@example.com", "Elmer Thomas 6"),
    new Cc("test+7@example.com", "Elmer Thomas 7")
];
// $ccEmails = [ 
//     "test+6@example.com" => "Elmer Thomas 6",
//     "test+7@example.com" => "Elmer Thomas 7"
// ];
$email->addCcs($ccEmails);
$email->addBcc(new Bcc("test+8@example.com", "Elmer Thomas 8"));
$email->addBcc("test+9@example.com", "Elmer Thomas 9");
$bccEmails = [ 
    new Bcc("test+10@example.com", "Elmer Thomas 10"),
    new Bcc("test+11@example.com", "Elmer Thomas 11")
];
// $bccEmails = [ 
//     "test+10@example.com" => "Elmer Thomas 10",
//     "test+11@example.com" => "Elmer Thomas 11"
// ];
$email->addBccs($bccEmails);
$email->addHeader(new Header("X-Test1", "Test1"));
$email->addHeader(new Header("X-Test2", "Test2"));
// $email->addHeader("X-Test1", "Test1");
// $email->addHeader("X-Test2", "Test2");
$headers = [
    new Header("X-Test3", "Test3"),
    new Header("X-Test4", "Test4")
];
// $headers = [
//     "X-Test3" => "Test3",
//     "X-Test4" => "Test4",
// ];
$email->addHeaders($headers);
$email->addSubstitution(new Substitution("%name1%", "Example Name 1"));
$email->addSubstitution(new Substitution("%city1%", "Denver"));
// $email->addSubstitution("%name1%", "Example Name 1");
// $email->addSubstitution("%city1%", "Denver");
$substitutions = [
    new Substitution("%name2%", "Example Name 2"),
    new Substitution("%city2%", "Orange")
];
// $substitutions = [
//     "%name2%" => "Example Name 2",
//     "%city2%" => "Orange"
// ];
$email->addSubstitutions($substitutions);

$email->addCustomArg(new CustomArg("marketing1", "false"));
$email->addCustomArg(new CustomArg("transactional1", "true"));
$email->addCustomArg(new CustomArg("category", "name"));
// $email->addCustomArg("marketing1", "false");
// $email->addCustomArg("transactional1", "true");
// $email->addCustomArg("category", "name");

$customArgs = [
    new CustomArg("marketing2", "true"),
    new CustomArg("transactional2", "false"),
    new CustomArg("category", "name")
];
// $customArgs = [
//     "marketing2" => "true",
//     "transactional2" => "false",
//     "category" => "name"
// ];
$email->addCustomArgs($customArgs);

$email->setSendAt(1461775051);
//$email->setSendAt(new SendAt(1461775052));

// The values below this comment are global to entire message

$email->setFrom($from);
// $email->setFrom("dx+2@example.com", "DX Team 2");

$email->setGlobalSubject(new Subject("Sending with SendGrid is Fun and Global"));
// $email->setGlobalSubject("Sending with SendGrid is Fun and Global 2");

$email->addContent($plainTextContent);
$email->addContent($htmlContent);
// $email->addContent(MimeType::Text, "and easy to do anywhere, even with PHP");
// $email->addContent(MimeType::Html, "<strong>and easy to do anywhere, even with PHP</strong>");
$contents = [
    new Content("text/calendar", "Party Time!!"),
    new Content("text/calendar2", "Party Time 2!!")
];
$email->addContents($contents);

$email->addAttachment(
    new Attachment(
        "base64 encoded content 1",
        "image/png",
        "banner.png",
        "inline",
        "Banner"
    )
);

$email->addAttachment(
    "base64 encoded content 2",
    "application/pdf",
    "balance_001.pdf",
    "attachment",
    "Balance Sheet"
);

$attachments = [
    new Attachment(
        "base64 encoded content 3",
        "banner3.jpeg",
        "image/jpeg",
        "attachment",
        "Banner 3"
    ),
    new Attachment(
        "base64 encoded content 4",
        "banner4.gif",
        "image/gif",
        "inline",
        "Banner 4"
    )
];
$email->addAttachments($attachments);

$email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");
// $email->setTemplateId(new TemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f933"));

$email->addGlobalHeader("X-Day", "Monday");
// $email->addGlobalHeader(new Header("X-Day2", "Monday2"));

$globalHeaders = [
    new Header("X-Test5", "Test5"),
    new Header("X-Test6", "Test6")
];
// $globalHeaders = [
//     "X-Month" => "January",
//     "X-Year" => "2017"
// ];
$email->addGlobalHeaders($globalHeaders);

$email->addSection("%section1%", "Substitution for Section 1 Tag");
// $email->addSection(new Section("%section2%", "Substitution for Section 2 Tag"));

$sections = [
    "%section3%" => "Substitution for Section 3 Tag",
    "%section4%" => "Substitution for Section 4 Tag"
];
// $sections = [
//     new Section("%section5%", "Substitution for Section 5 Tag"),
//     new Section("%section6%", "Substitution for Section 6 Tag")
// ];
$email->addSections($sections);

// $email->addCategory("Category 1");
$email->addCategory(new Category("Category 2"));
// $categories = [
//     "Category 3",
//     "Category 4"
// ];
$categories = [
    new Category("Category 5"),
    new Category("Category 6")
];
$email->addCategories($categories);

$email->setBatchId("MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw");
// $email->setBatchId(new BatchId("MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw2"));

$email->setReplyTo(new ReplyTo("dx+replyto@example.com", "DX Team Reply To"));
// $email->setReplyTo("dx+replyto2@example.com", "DX Team Reply To 2");

// $email->setAsm(1, [1, 2, 3, 4]);
$asm = new Asm();
$asm->setGroupId(2);
$asm->setGroupsToDisplay([5,6,7,8]);
// $asm->setGroupId(new GroupId(3));
// $asm->setGroupsToDisplay(new GroupsToDisplay([9,10,11,12]));
// $asm = new Asm(
//     new GroupId(4),
//     new GroupsToDisplay([13,14,15,16])
// );
$email->setAsm($asm);

// $email->setIpPoolName("23");
$email->setIpPoolName(new IpPoolName("24"));

$mail_settings = new MailSettings();
// $mail_settings->setBccSettings(true, "bcc@example.com");
$mail_settings->setBccSettings(new BccSettings(false));
$mail_settings->setBypassListManagement(true);
// $mail_settings->setBypassListManagement(new BypassListManagement(false));
// $mail_settings->setFooter(true, "Footer", "<strong>Footer</strong>");
$mail_settings->setFooter(new Footer(false));
// $mail_settings->setSandBoxMode(true);
$mail_settings->setSandBoxMode(new SandBoxMode(false));
// $mail_settings->setSpamCheck(true, 1, "http://mydomain.com");
$mail_settings->setSpamCheck(false);
$email->setMailSettings($mail_settings);

$tracking_settings = new TrackingSettings();
// $tracking_settings->setClickTracking(true, true);
$tracking_settings->setClickTracking(new ClickTracking(false, false));
// $tracking_settings->setOpenTracking(true, "--sub--");
$tracking_settings->setOpenTracking(new OpenTracking(false));
// $tracking_settings->setSubscriptionTracking(true, "subscribe", "<bold>subscribe</bold>", "%%sub%%");
$tracking_settings->setSubscriptionTracking(new SubscriptionTracking(false));
// $tracking_settings->setGanalytics(true, "utm_source", "utm_medium", "utm_term", "utm_content", "utm_campaign");
$tracking_settings->setGanalytics(new Ganalytics(false));
$email->setTrackingSettings($tracking_settings);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
echo json_encode($email, JSON_PRETTY_PRINT);
// try {
//     $response = $sendgrid->send($email);
// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
// }
// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

$email = new Mail();
