This documentation provides examples for specific use cases. Please [open an issue](https://github.com/sendgrid/sendgrid-php/issues) or make a pull request for any use cases you would like us to document here. Thank you!

# Table of Contents
- [Table of Contents](#table-of-contents)
- [Attachments](#attachments)
- [Kitchen Sink - an example with all settings used](#kitchen-sink)
- [Send an Email to a Single Recipient](#send-an-email-to-a-single-recipient)
- [Send an Email to Multiple Recipients](#send-an-email-to-multiple-recipients)
- [Send Multiple Emails to Multiple Recipients](#send-multiple-emails-to-multiple-recipients)
- [Transactional Templates](#transactional-templates)
- [Legacy Templates](#legacy-templates)
- [How to Setup a Domain Whitelabel](#how-to-setup-a-domain-whitelabel)
- [How to View Email Statistics](#how-to-view-email-statistics)
- [Deploying to Heroku](#deploying-to-heroku)
- [Google App Engine Installation](#google-app-engine-installation)

<a name="attachments"></a>
# Attachments

Here is an example of attaching a text file to your email, assuming that text file `my_file.txt` is located in the same directory. You can use the `addAttachments` method to add an array attachments.

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);

$file_encoded = base64_encode(file_get_contents('my_file.txt'));
$email->addAttachment(
    $file_encoded,
    "application/text",
    "my_file.txt",
    "attachment"
);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="kitchen-sink"></a>
# Kitchen Sink -  an example with all settings used

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();

// For a detailed description of each of these settings, 
// please see the 
// [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
$email->setSubject("Sending with SendGrid is Fun 2");

$email->addTo("test@example.com", "Example User");
$email->addTo("test+1@example.com", "Example User1");
$toEmails = [
    "test+2@example.com" => "Example User2",
    "test+3@example.com" => "Example User3"
];
$email->addTos($toEmails);

$email->addCc("test+4@example.com", "Example User4");
$ccEmails = [
    "test+5@example.com" => "Example User5",
    "test+6@example.com" => "Example User6"
];
$email->addCcs($ccEmails);

$email->addBcc("test+7@example.com", "Example User7");
$bccEmails = [
    "test+8@example.com" => "Example User8",
    "test+9@example.com" => "Example User9"
];
$email->addBccs($bccEmails);

$email->addHeader("X-Test1", "Test1");
$email->addHeader("X-Test2", "Test2");
$headers = [
    "X-Test3" => "Test3",
    "X-Test4" => "Test4",
];
$email->addHeaders($headers);

$email->addDynamicTemplateData("subject1", "Example Subject 1");
$email->addDynamicTemplateData("name1", "Example Name 1");
$email->addDynamicTemplateData("city1", "Denver");
$substitutions = [
    "subject2" => "Example Subject 2",
    "name2" => "Example Name 2",
    "city2" => "Orange"
];
$email->addDynamicTemplateDatas($substitutions);

$email->addCustomArg("marketing1", "false");
$email->addCustomArg("transactional1", "true");
$email->addCustomArg("category", "name");
$customArgs = [
    "marketing2" => "true",
    "transactional2" => "false",
    "category" => "name"
];
$email->addCustomArgs($customArgs);

$email->setSendAt(1461775051);

// You can add a personalization index or personalization parameter to the above
// methods to add and update multiple personalizations. You can learn more about 
// personalizations [here](https://sendgrid.com/docs/Classroom/Send/v3_Mail_Send/personalizations.html).

// The values below this comment are global to entire message

$email->setFrom("test@example.com", "DX");

$email->setGlobalSubject("Sending with SendGrid is Fun and Global 2");

$email->addContent(
    "text/plain",
    "and easy to do anywhere, even with PHP"
);
$email->addContent(
    "text/html",
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$contents = [
    "text/calendar" => "Party Time!!",
    "text/calendar2" => "Party Time 2!!"
];
$email->addContents($contents);

$email->addAttachment(
    "base64 encoded content1",
    "image/png",
    "banner.png",
    "inline",
    "Banner"
);
$attachments = [
    [   
        "base64 encoded content2",
        "banner2.jpeg",
        "image/jpeg",
        "attachment",
        "Banner 3"
    ],
    [
        "base64 encoded content3",
        "banner3.gif",
        "image/gif",
        "inline",
        "Banner 3"
    ]
];
$email->addAttachments($attachments);

$email->setTemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932");

$email->addGlobalHeader("X-Day", "Monday");
$globalHeaders = [
    "X-Month" => "January",
    "X-Year" => "2017"
];
$email->addGlobalHeaders($globalHeaders);

$email->addSection("%section1%", "Substitution for Section 1 Tag");
$sections = [
    "%section3%" => "Substitution for Section 3 Tag",
    "%section4%" => "Substitution for Section 4 Tag"
];
$email->addSections($sections);

$email->addCategory("Category 1");
$categories = [
    "Category 2",
    "Category 3"
];
$email->addCategories($categories);

$email->setBatchId(
    "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
);

$email->setReplyTo("dx+replyto2@example.com", "DX Team Reply To 2");

$email->setAsm(1, [1, 2, 3, 4]);

$email->setIpPoolName("23");

// Mail Settings
$email->setBccSettings(true, "bcc@example.com");
$email->enableBypassListManagement();
//$email->disableBypassListManagement();
$email->setFooter(true, "Footer", "<strong>Footer</strong>");
$email->enableSandBoxMode();
//$email->disableSandBoxMode();
$email->setSpamCheck(true, 1, "http://mydomain.com");

// Tracking Settings
$email->setClickTracking(true, true);
$email->setOpenTracking(true, "--sub--");
$email->setSubscriptionTracking(
    true,
    "subscribe",
    "<bold>subscribe</bold>",
    "%%sub%%"
);
$email->setGanalytics(
    true,
    "utm_source",
    "utm_medium",
    "utm_term",
    "utm_content",
    "utm_campaign"
);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();

// For a detailed description of each of these settings, 
// please see the 
// [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
$email->setSubject(
    new \SendGrid\Mail\Subject("Sending with SendGrid is Fun 2")
);

$email->addTo(new \SendGrid\Mail\To("test@example.com", "Example User"));
$email->addTo(new \SendGrid\Mail\To("test+1@example.com", "Example User1"));
$toEmails = [ 
    new \SendGrid\Mail\To("test+2@example.com", "Example User2"),
    new \SendGrid\Mail\To("test+3@example.com", "Example User3")
];
$email->addTos($toEmails);

$email->addCc(new \SendGrid\Mail\Cc("test+4@example.com", "Example User4"));
$ccEmails = [ 
    new \SendGrid\Mail\Cc("test+5@example.com", "Example User5"),
    new \SendGrid\Mail\Cc("test+6@example.com", "Example User6")
];
$email->addCcs($ccEmails);

$email->addBcc(
    new \SendGrid\Mail\Bcc("test+7@example.com", "Example User7")
);
$bccEmails = [ 
    new \SendGrid\Mail\Bcc("test+8@example.com", "Example User8"),
    new \SendGrid\Mail\Bcc("test+9@example.com", "Example User9")
];
$email->addBccs($bccEmails);

$email->addHeader(new \SendGrid\Mail\Header("X-Test1", "Test1"));
$email->addHeader(new \SendGrid\Mail\Header("X-Test2", "Test2"));
$headers = [
    new \SendGrid\Mail\Header("X-Test3", "Test3"),
    new \SendGrid\Mail\Header("X-Test4", "Test4")
];
$email->addHeaders($headers);

$email->addDynamicTemplateData(
    new \SendGrid\Mail\Substitution("subject1", "Example Subject 1")
);
$email->addDynamicTemplateData(
    new \SendGrid\Mail\Substitution("name", "Example Name 1")
);
$email->addDynamicTemplateData(
    new \SendGrid\Mail\Substitution("city1", "Denver")
);
$substitutions = [
    new \SendGrid\Mail\Substitution("subject2", "Example Subject 2"),
    new \SendGrid\Mail\Substitution("name2", "Example Name 2"),
    new \SendGrid\Mail\Substitution("city2", "Orange")
];
$email->addDynamicTemplateDatas($substitutions);

$email->addCustomArg(new \SendGrid\Mail\CustomArg("marketing1", "false"));
$email->addCustomArg(new \SendGrid\Mail\CustomArg("transactional1", "true"));
$email->addCustomArg(new \SendGrid\Mail\CustomArg("category", "name"));
$customArgs = [
    new \SendGrid\Mail\CustomArg("marketing2", "true"),
    new \SendGrid\Mail\CustomArg("transactional2", "false"),
    new \SendGrid\Mail\CustomArg("category", "name")
];
$email->addCustomArgs($customArgs);

$email->setSendAt(new \SendGrid\Mail\SendAt(1461775051));

// You can add a personalization index or personalization parameter to the above
// methods to add and update multiple personalizations. You can learn more about 
// personalizations [here](https://sendgrid.com/docs/Classroom/Send/v3_Mail_Send/personalizations.html).

// The values below this comment are global to entire message

$email->setFrom(new \SendGrid\Mail\From("test@example.com", "DX"));

$email->setGlobalSubject(
    new \SendGrid\Mail\Subject("Sending with SendGrid is Fun and Global 2")
);

$plainTextContent = new \SendGrid\Mail\PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new \SendGrid\Mail\HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email->addContent($plainTextContent);
$email->addContent($htmlContent);
$contents = [
    new \SendGrid\Mail\Content("text/calendar", "Party Time!!"),
    new \SendGrid\Mail\Content("text/calendar2", "Party Time 2!!")
];
$email->addContents($contents);

$email->addAttachment(
    new \SendGrid\Mail\Attachment(
        "base64 encoded content1",
        "image/png",
        "banner.png",
        "inline",
        "Banner"
    )
);
$attachments = [
    new \SendGrid\Mail\Attachment(
        "base64 encoded content2",
        "banner2.jpeg",
        "image/jpeg",
        "attachment",
        "Banner 3"
    ),
    new \SendGrid\Mail\Attachment(
        "base64 encoded content3",
        "banner3.gif",
        "image/gif",
        "inline",
        "Banner 3"
    )
];
$email->addAttachments($attachments);

$email->setTemplateId(
    new \SendGrid\Mail\TemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932")
);

$email->addGlobalHeader(new \SendGrid\Mail\Header("X-Day", "Monday"));
$globalHeaders = [
    new \SendGrid\Mail\Header("X-Month", "January"),
    new \SendGrid\Mail\Header("X-Year", "2017")
];
$email->addGlobalHeaders($globalHeaders);

$email->addSection(
    new \SendGrid\Mail\Section(
        "%section1%",
        "Substitution for Section 1 Tag"
    )
);

$sections = [
    new \SendGrid\Mail\Section(
        "%section3%",
        "Substitution for Section 3 Tag"
    ),
    new \SendGrid\Mail\Section(
        "%section4%",
        "Substitution for Section 4 Tag"
    )
];
$email->addSections($sections);

$email->addCategory(new \SendGrid\Mail\Category("Category 1"));
$categories = [
    new \SendGrid\Mail\Category("Category 2"),
    new \SendGrid\Mail\Category("Category 3")
];
$email->addCategories($categories);

$email->setBatchId(
    new \SendGrid\Mail\BatchId(
        "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
    )
);

$email->setReplyTo(
    new \SendGrid\Mail\ReplyTo(
        "dx+replyto2@example.com",
        "DX Team Reply To 2"
    )
);

$asm = new \SendGrid\Mail\Asm(
    new \SendGrid\Mail\GroupId(1),
    new \SendGrid\Mail\GroupsToDisplay([1,2,3,4])
);
$email->setAsm($asm);

$email->setIpPoolName(new \SendGrid\Mail\IpPoolName("23"));

$mail_settings = new \SendGrid\Mail\MailSettings();
$mail_settings->setBccSettings(
    new \SendGrid\Mail\BccSettings(true, "bcc@example.com")
);
$mail_settings->setBypassListManagement(
    new \SendGrid\Mail\BypassListManagement(true)
);
$mail_settings->setFooter(
    new \SendGrid\Mail\Footer(true, "Footer", "<strong>Footer</strong>")
);
$mail_settings->setSandBoxMode(new \SendGrid\Mail\SandBoxMode(true));
$mail_settings->setSpamCheck(
    new \SendGrid\Mail\SpamCheck(true, 1, "http://mydomain.com")
);
$email->setMailSettings($mail_settings);

$tracking_settings = new \SendGrid\Mail\TrackingSettings();
$tracking_settings->setClickTracking(
    new \SendGrid\Mail\ClickTracking(true, true)
);
$tracking_settings->setOpenTracking(
    new \SendGrid\Mail\OpenTracking(true, "--sub--")
);
$tracking_settings->setSubscriptionTracking(
    new \SendGrid\Mail\SubscriptionTracking(
        true,
        "subscribe",
        "<bold>subscribe</bold>",
        "%%sub%%"
    )
);
$tracking_settings->setGanalytics(
    new \SendGrid\Mail\Ganalytics(
        true,
        "utm_source",
        "utm_medium",
        "utm_term",
        "utm_content",
        "utm_campaign"
    )
);
$email->setTrackingSettings($tracking_settings);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="single-email-single-recipient"></a>
# Send an Email to a Single Recipient

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$from = new \SendGrid\Mail\From("test@example.com", "Example User");
$subject = new \SendGrid\Mail\Subject("Sending with SendGrid is Fun");
$to = new \SendGrid\Mail\To("test@example.com", "Example User");
$plainTextContent = new \SendGrid\Mail\PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new \SendGrid\Mail\HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email = new \SendGrid\Mail\Mail(
    $from,
    $to,
    $subject,
    $plainTextContent,
    $htmlContent
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="single-email-multiple-recipients"></a>
# Send an Email to Multiple Recipients

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@example.com", "Example User");
$tos = [ 
    "test+test1@example.com" => "Example User1",
    "test+test2@example.com" => "Example User2",
    "test+test3@example.com" => "Example User3"
];
$email->addTos($tos);
$email->setSubject("Sending with SendGrid is Fun");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR 

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
$from = new \SendGrid\Mail\From("test@example.com", "Example User");
$tos = [ 
    new \SendGrid\Mail\To("test+test1@example.com", "Example User1"),
    new \SendGrid\Mail\To("test+test2@example.com", "Example User2"),
    new \SendGrid\Mail\To("test+test3@example.com", "Example User3")
];
$subject = new \SendGrid\Mail\Subject("Sending with SendGrid is Fun");
$plainTextContent = new \SendGrid\Mail\PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new \SendGrid\Mail\HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email = new \SendGrid\Mail\Mail(
    $from,
    $tos,
    $subject,
    $plainTextContent,
    $htmlContent
);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="multiple-emails-multiple-recipients"></a>
# Send Multiple Emails to Multiple Recipients

Note that [transactional templates](#transactional-templates) may be a better option for this use case, especially for more complex uses.

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$from = new \SendGrid\Mail\From("test@example.com", "Example User");
$tos = [
    new \SendGrid\Mail\To(
        "test+test1@example.com",
        "Example User1",
        [
            '-name-' => 'Example User 1',
            '-github-' => 'http://github.com/example_user1'
        ],
        "Subject 1 -name-"
    ),
    new \SendGrid\Mail\To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2',
            '-github-' => 'http://github.com/example_user2'
        ],
        "Subject 2 -name-"
    ),
    new \SendGrid\Mail\To(
        "test+test3@example.com",
        "Example User3",
        [
            '-name-' => 'Example User 3',
            '-github-' => 'http://github.com/example_user3'
        ]
    )
];
$subject = new \SendGrid\Mail\Subject("Hi -name-!"); // default subject 
$globalSubstitutions = [
    '-time-' => "2018-05-03 23:10:29"
];
$plainTextContent = new \SendGrid\Mail\PlainTextContent(
    "Hello -name-, your github is -github- sent at -time-"
);
$htmlContent = new \SendGrid\Mail\HtmlContent(
    "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
);
$email = new \SendGrid\Mail\Mail(
    $from,
    $tos,
    $subject, // or array of subjects, these take precendence
    $plainTextContent,
    $htmlContent,
    $globalSubstitutions
);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$from = new \SendGrid\Mail\From("test@example.com", "Example User");
$tos = [
    new \SendGrid\Mail\To(
        "test+test1@example.com",
        "Example User1",
        [
            '-name-' => 'Example User 1',
            '-github-' => 'http://github.com/example_user1'
        ],
        "Example User1 -name-"
    ),
    new \SendGrid\Mail\To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2',
            '-github-' => 'http://github.com/example_user2'
        ],
        "Example User2 -name-"
    ),
    new \SendGrid\Mail\To(
        "test+test3@example.com",
        "Example User3",
        [
            '-name-' => 'Example User 3',
            '-github-' => 'http://github.com/example_user3'
        ]
    )
];
$subject = [
    "Subject 1 -name-",
    "Subject 2 -name-"
];
$globalSubstitutions = [
    '-time-' => "2018-05-03 23:10:29"
];
$plainTextContent = new \SendGrid\Mail\PlainTextContent(
    "Hello -name-, your github is -github- sent at -time-"
);
$htmlContent = new \SendGrid\Mail\HtmlContent(
    "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
);
$email = new \SendGrid\Mail\Mail(
    $from,
    $tos,
    $subject, // or array of subjects, these take precendence
    $plainTextContent,
    $htmlContent,
    $globalSubstitutions
);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="transactional-templates"></a>
# Transactional Templates

For this example, we assume you have created a [transactional template](https://sendgrid.com/docs/User_Guide/Transactional_Templates/create_and_edit_transactional_templates.html). Following is the template content we used for testing.

Template ID (replace with your own):

```text
d-13b8f94fbcae4ec6b75270d6cb59f932
```

Email Subject:

```text
{{ subject }}
```

Template Body:

```html
<html>
<head>
	<title></title>
</head>
<body>
Hello {{ name }},
<br /><br/>
I'm glad you are trying out the template feature!
<br /><br/>
I hope you are having a great day in {{ city }} :)
<br /><br/>
</body>
</html>
```

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;

$from = new From("test@example.com", "Example User");
$tos = [
    new To(
        "test+test1@example.com",
        "Example User1",
        [
            'subject' => 'Subject 1',
            'name' => 'Example User 1',
            'city' => 'Denver'
        ]
    ),
    new To(
        "test+test2@example.com",
        "Example User2",
        [
            'subject' => 'Subject 2',
            'name' => 'Example User 2',
            'city' => 'Irvine'
        ]
    ),
    new To(
        "test+test3@example.com",
        "Example User3",
        [
            'subject' => 'Subject 3',
            'name' => 'Example User 3',
            'city' => 'Redwood City'
        ]
    )
];
$email = new Mail(
    $from,
    $tos
);
$email->setTemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932");
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR

```php
$email = new \SendGrid\Mail\Mail();
$email->setFrom("test@sendgrid.com", "Example User");
$email->setSubject("I'm replacing the subject tag");
$email->addTo(
    "test+test1@example.com",
    "Example User1",
    [
        "subject" => "Subject 1",
        "name" => "Example User 1",
        "city" => "Denver"
    ],
    0
);
$email->addTo(
    "test+test2@example.com", 
    "Example User2",
    [
        "subject" => "Subject 2",
        "name" => "Example User 2",
        "city" => "Denver"
    ],
    1
);
$email->addTo(
    "test+test3@example.com", 
    "Example User3",
    [
        "subject" => "Subject 3",
        "name" => "Example User 3",
        "city" => "Redwood City"
    ],
    2
);
$email->setTemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932");
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="legacy-templates"></a>
# Legacy Templates

For this example, we assume you have created a [legacy template](https://sendgrid.com/docs/User_Guide/Transactional_Templates/create_and_edit_transactional_templates.html). Following is the template content we used for testing.

Template ID (replace with your own):

```text
13b8f94f-bcae-4ec6-b752-70d6cb59f932
```

Email Subject:

```text
<%subject%>
```

Template Body:

```html
<html>
<head>
	<title></title>
</head>
<body>
Hello -name-,
<br /><br/>
I'm glad you are trying out the template feature!
<br /><br/>
<%body%>
<br /><br/>
I hope you are having a great day in -city- :)
<br /><br/>
</body>
</html>
```

```php
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;

$from = new From("test@example.com", "Example User");
$tos = [ 
    new To(
        "test+test1@example.com",
        "Example User1",
        [
            '-name-' => 'Example User 1',
            '-city-' => 'Denver'
        ]
    ),
    new To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2',
            '-city-' => 'Irvine'
        ]
    ),
    new To(
        "test+test3@example.com",
        "Example User3",
        [
            '-name-' => 'Example User 3',
            '-city-' => 'Redwood City'
        ]
    )
];
$subject = new Subject("I'm replacing the subject tag"); 
$plainTextContent = new PlainTextContent(
    "I'm replacing the **body tag**"
);
$htmlContent = new HtmlContent(
    "I'm replacing the <strong>body tag</strong>"
);
$email = new Mail(
    $from,
    $tos,
    $subject,
    $plainTextContent,
    $htmlContent
);
$email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

OR

```php
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@sendgrid.com", "Example User");
$email->setSubject("I'm replacing the subject tag");
$email->addTo(
    "test+test1@example.com", 
    "Example User1",
    [ 
        "-name-" => "Example User 1",
        "-city-" => "Denver"
    ],
    0
);
$email->addTo(
    "test+test2@example.com", 
    "Example User2",
    [ 
        "-name-" => "Example User 2",
        "-city-" => "Denver"
    ],
    1
);
$email->addTo(
    "test+test3@example.com", 
    "Example User3",
    [ 
        "-name-" => "Example User 3",
        "-city-" => "Redwood City"
    ],
    2
);
$email->addContent("text/plain", "I'm replacing the **body tag**");
$email->addContent("text/html", "I'm replacing the <strong>body tag</strong>");
$email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
```

<a name="domain-whitelabel"></a>
# How to Setup a Domain Whitelabel

You can find documentation for how to setup a domain whitelabel via the UI [here](https://example.com/docs/Classroom/Basics/Whitelabel/setup_domain_whitelabel.html) and via API [here](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md#whitelabel).

Find more information about all of SendGrid's whitelabeling related documentation [here](https://example.com/docs/Classroom/Basics/Whitelabel/index.html).

<a name="email-stats"></a>
# How to View Email Statistics

You can find documentation for how to view your email statistics via the UI [here](https://app.example.com/statistics) and via API [here](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md#stats).

Alternatively, we can post events to a URL of your choice via our [Event Webhook](https://example.com/docs/API_Reference/Webhooks/event.html) about events that occur as SendGrid processes your email.

<a name="heroku"></a>
# Deploying to Heroku

Use the button below to instantly setup your own Simple instance for sending email using sendgrid on Heroku.

<a href="https://heroku.com/deploy?template=https://github.com/sendgrid/sendgrid-php/tree/example-heroku-hello-email">
  <img src="https://www.herokucdn.com/deploy/button.svg" alt="Deploy">
</a>

<a name="GAE-instructions"></a>
# Google App Engine Installation

Google App Engine installations with composer require creation of file `php.ini` in the base folder(the same directory as the `app.yaml` file). You can read more about this file [here](https://cloud.google.com/appengine/docs/standard/php/config/php_ini).

The file `php.ini` should contain:

```ini
google_app_engine.enable_curl_lite = 1
```
