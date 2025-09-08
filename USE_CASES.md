This documentation provides examples for specific use cases. Please [open an issue](https://github.com/sendgrid/sendgrid-php/issues) or make a pull request for any use cases you would like us to document here. Thank you!

# Table of Contents
- [Table of Contents](#table-of-contents)
- [Attachments](#attachments)
- [Attaching a File from Box](#attaching-a-file-from-box)
- [Attaching a File from S3](#attaching-a-file-from-s3)
- [Kitchen Sink - an example with all settings used](#kitchen-sink)
- [Send an Email to a Single Recipient](#send-an-email-to-a-single-recipient)
- [Send an Email to Multiple Recipients](#send-an-email-to-multiple-recipients)
- [Send Multiple Emails to Multiple Recipients](#send-multiple-emails-to-multiple-recipients)
- [Send Multiple Emails with Personalizations](#multiple-email-personalizations)
- [Set Region](#set-region)
- [Transactional Templates](#transactional-templates)
- [Legacy Templates](#legacy-templates)
- [Send an Email With Twilio Email (Pilot)](#send-an-email-with-twilio-email-pilot)
- [Send an SMS Message](#send-an-sms-message)
- [How to Set up a Domain Authentication](#how-to-set-up-a-domain-authentication)
- [How to View Email Statistics](#how-to-view-email-statistics)
- [How to Use the Email Activity Feed](#how-to-use-the-email-activity-feed-api)
- [Deploying to Heroku](#deploying-to-heroku)
- [Google App Engine Installation](#google-app-engine-installation)

<a name="attachments"></a>
# Attachments

Here is an example of attaching a text file to your email, assuming that text file `my_file.txt` is located in the same directory. You can use the `addAttachments` method to add an array attachments.

```php
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
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

<a name="box-attachment-example"></a>
# Attaching a File from Box

You can attach a file from [Box](https://www.box.com) to your emails.
Because there is no official Box SDK for PHP, this example requires
[firebase/php-jwt](https://github.com/firebase/php-jwt) to generate a
[JSON Web Token](https://jwt.io) assertion. Before using this code, you should
set up a JWT application on [Box](https://developer.box.com/docs/setting-up-a-jwt-app).
For more information about authenticating with JWT, see
[this page](https://developer.box.com/docs/construct-jwt-claim-manually).

After completing the setup tutorial, you will want to make sure your app’s
configuration settings have at least the following options enabled:

**Application Access**
* Enterprise

**Application Scopes**
* Read all files and folders stored in Box
* Read and write all files and folders stored in Box
* Manage users

**Advanced Features**
* Perform Actions as Users

Remember to reauthorize your app
[here](https://app.box.com/master/settings/openbox) after making any changes to
your app’s JWT scopes.

```php
<?php
// This example assumes you're using Composer for both the sendgrid-php library and php-jwt.
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$fileOwner = 'email@example.com'; // Replace with the email you use to sign in to Box
$filePath = '/path/to/file.txt'; // Replace with the path on Box to the file you will attach
// Replace with the path to your Box config file. Keep it in a secure location!
$boxConfig = json_decode(file_get_contents('/path/to/boxConfig.json'));

$path = explode('/', $filePath);
if (!empty($path[0])){
    // Adds a blank element to beginning of array in case $filePath does not have a preceding forward slash.
    array_unshift($path, '');
}

$header = array(
    'alg' => 'RS256',
    'typ' => 'JWT',
    'kid' => $boxConfig->boxAppSettings->appAuth->publicKeyID
);
$claims = array(
    'iss' => $boxConfig->boxAppSettings->clientID,
    'sub' => $boxConfig->enterpriseID,
    'box_sub_type' => 'enterprise',
    'aud' => 'https://api.box.com/oauth2/token',
    'jti' => bin2hex(openssl_random_pseudo_bytes(16)),
    'exp' => time() + 50
);

$privateKey = openssl_get_privatekey(
    $boxConfig->boxAppSettings->appAuth->privateKey,
    $boxConfig->boxAppSettings->appAuth->passphrase
);

$assertion = JWT::encode($claims, $privateKey, 'RS256', null, $header);

// Get access token
$url = 'https://api.box.com/oauth2/token';
$data = array(
    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
    'client_id' => $boxConfig->boxAppSettings->clientID,
    'client_secret' => $boxConfig->boxAppSettings->clientSecret,
    'assertion' => $assertion
);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$result = json_decode(curl_exec($ch));
curl_close($ch);
$accessToken = $result->access_token;

// Get user ID
$url = 'https://api.box.com/2.0/users';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$accessToken
));
$result = json_decode(curl_exec($ch));
curl_close($ch);
foreach ($result->entries as $entry){
    if ($entry->login === $fileOwner){
        $userId = $entry->id;
    }
}

// Get file ID
$url = 'https://api.box.com/2.0/search';
$data = array(
    'query' => urlencode(end($path))
);
$urlEncoded = http_build_query($data);
$ch = curl_init($url.'?'.$urlEncoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$accessToken,
    'As-User: '.$userId
));
$result = json_decode(curl_exec($ch));
curl_close($ch);
foreach ($result->entries as $entry){
    if (count($entry->path_collection->entries) === count($path) -1){
        if (count($path) > 2){
            // File is located in a subdirectory.
            for ($i = 1; $i < (count($path) - 1); $i++){
                if ($path[$i] === $entry->path_collection->entries[$i]->name){
                    $fileId = $entry->id;
                }
            }
        } else {
            // File is located in default directory.
            $fileId = $entry->id;
        }
    }
}

if (isset($fileId) && isset($userId)){
    // Get file data
    $url = 'https://api.box.com/2.0/files/'.$fileId.'/content';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$accessToken,
        'As-User: '.$userId
    ));
    $result = curl_exec($ch);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    $attachmentFilename = end($path);
    $attachmentContent = base64_encode($result);
    $attachmentContentType = $contentType;

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("test@example.com", "Example User");
    $email->setSubject("Attaching a File from Box");
    $email->addTo("test@example.com", "Example User");
    $email->addContent("text/plain", "See attached file from Box.");
    $email->addContent(
        "text/html", "<strong>See attached file from Box.</strong>"
    );

    $attachment = new \SendGrid\Mail\Attachment();
    $attachment->setContent($attachmentContent);
    $attachment->setType($attachmentContentType);
    $attachment->setFilename($attachmentFilename);
    $attachment->setDisposition("attachment");
    $attachment->setContentId($attachmentFilename); // Only used if disposition is set to inline
    $email->addAttachment($attachment);

    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
} else {
    echo "Error: file or owner could not be located\n";
}
```

<a name="s3-attachment-example"></a>
# Attaching a File from S3

You can attach a file from [Amazon S3 storage](https://aws.amazon.com/s3/) to your emails. In addition to sendgrid-php, this requires the [AWS SDK for PHP](https://aws.amazon.com/sdk-for-php/). Please follow the [Getting Started](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_index.html) tutorial at Amazon if you haven’t set up your AWS SDK installation yet.

```php
<?php
// This example assumes you're using Composer for both
// the sendgrid-php library and the AWS SDK for PHP.
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$bucket = '*** Your Bucket Name ***';
$keyname = '*** Your Object Key ***';
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1' // This should match the region of your S3 bucket.
]);
try {
    // Get the object.
    // See https://docs.aws.amazon.com/AmazonS3/latest/dev/RetrieveObjSingleOpPHP.html
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $keyname
    ]);
    $keyExplode = explode('/',$keyname);
    $attachmentFilename = end($keyExplode);
    $attachmentContent = base64_encode($result['Body']);
    $attachmentContentType = $result['ContentType'];

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("test@example.com", "Example User");
    $email->setSubject("Attaching a File from S3");
    $email->addTo("test@example.com", "Example User");
    $email->addContent("text/plain", "See attached file from S3.");
    $email->addContent(
        "text/html", "<strong>See attached file from S3.</strong>"
    );

    $attachment = new \SendGrid\Mail\Attachment();
    $attachment->setContent($attachmentContent);
    $attachment->setType($attachmentContentType);
    $attachment->setFilename($attachmentFilename);
    $attachment->setDisposition("attachment");
    $attachment->setContentId($attachmentFilename); //Only used if disposition is set to inline
    $email->addAttachment($attachment);
    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
} catch (S3Exception $e) {
    echo 'Caught exception: '. $e->getMessage() . "\n";
}
```

<a name="kitchen-sink"></a>
# Kitchen Sink - an example with all settings used

```php
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();

// For a detailed description of each of these settings,
// please see the
// [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
$email->setSubject("Sending with Twilio SendGrid is Fun 2");

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

// The values below this comment are global to an entire message

$email->setFrom("test@example.com", "Twilio SendGrid");

$email->setGlobalSubject("Sending with Twilio SendGrid is Fun and Global 2");

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
        "image/jpeg",
        "banner2.jpeg",
        "attachment",
        "Banner 3"
    ],
    [
        "base64 encoded content3",
        "image/gif",
        "banner3.gif",
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
// Note: Bypass Spam, Bounce, and Unsubscribe management cannot
// be combined with Bypass List Management
$email->enableBypassBounceManagement();
$email->enableBypassListManagement();
$email->enableBypassSpamManagement();
$email->enableBypassUnsubscribeManagement();
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Asm;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\BatchId;
use SendGrid\Mail\Bcc;
use SendGrid\Mail\BccSettings;
use SendGrid\Mail\BypassBounceManagement;
use SendGrid\Mail\BypassListManagement;
use SendGrid\Mail\BypassSpamManagement;
use SendGrid\Mail\BypassUnsubscribeManagement;
use SendGrid\Mail\Category;
use SendGrid\Mail\Cc;
use SendGrid\Mail\ClickTracking;
use SendGrid\Mail\Content;
use SendGrid\Mail\CustomArg;
use SendGrid\Mail\Footer;
use SendGrid\Mail\From;
use SendGrid\Mail\Ganalytics;
use SendGrid\Mail\GroupId;
use SendGrid\Mail\GroupsToDisplay;
use SendGrid\Mail\Header;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\IpPoolName;
use SendGrid\Mail\Mail;
use SendGrid\Mail\MailSettings;
use SendGrid\Mail\OpenTracking;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\ReplyTo;
use SendGrid\Mail\SandBoxMode;
use SendGrid\Mail\Section;
use SendGrid\Mail\SendAt;
use SendGrid\Mail\SpamCheck;
use SendGrid\Mail\Subject;
use SendGrid\Mail\SubscriptionTracking;
use SendGrid\Mail\Substitution;
use SendGrid\Mail\TemplateId;
use SendGrid\Mail\To;
use SendGrid\Mail\TrackingSettings;

$email = new Mail();

// For a detailed description of each of these settings,
// please see the
// [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
$email->setSubject(
    new Subject("Sending with Twilio SendGrid is Fun 2")
);

$email->addTo(new To("test@example.com", "Example User"));
$email->addTo(new To("test+1@example.com", "Example User1"));
$toEmails = [
    new To("test+2@example.com", "Example User2"),
    new To("test+3@example.com", "Example User3")
];
$email->addTos($toEmails);

$email->addCc(new Cc("test+4@example.com", "Example User4"));
$ccEmails = [
    new Cc("test+5@example.com", "Example User5"),
    new Cc("test+6@example.com", "Example User6")
];
$email->addCcs($ccEmails);

$email->addBcc(
    new Bcc("test+7@example.com", "Example User7")
);
$bccEmails = [
    new Bcc("test+8@example.com", "Example User8"),
    new Bcc("test+9@example.com", "Example User9")
];
$email->addBccs($bccEmails);

$email->addHeader(new Header("X-Test1", "Test1"));
$email->addHeader(new Header("X-Test2", "Test2"));
$headers = [
    new Header("X-Test3", "Test3"),
    new Header("X-Test4", "Test4")
];
$email->addHeaders($headers);

$email->addDynamicTemplateData(
    new Substitution("subject1", "Example Subject 1")
);
$email->addDynamicTemplateData(
    new Substitution("name", "Example Name 1")
);
$email->addDynamicTemplateData(
    new Substitution("city1", "Denver")
);
$substitutions = [
    new Substitution("subject2", "Example Subject 2"),
    new Substitution("name2", "Example Name 2"),
    new Substitution("city2", "Orange")
];
$email->addDynamicTemplateDatas($substitutions);

$email->addCustomArg(new CustomArg("marketing1", "false"));
$email->addCustomArg(new CustomArg("transactional1", "true"));
$email->addCustomArg(new CustomArg("category", "name"));
$customArgs = [
    new CustomArg("marketing2", "true"),
    new CustomArg("transactional2", "false"),
    new CustomArg("category", "name")
];
$email->addCustomArgs($customArgs);

$email->setSendAt(new SendAt(1461775051));

// You can add a personalization index or personalization parameter to the above
// methods to add and update multiple personalizations. You can learn more about
// personalizations [here](https://sendgrid.com/docs/Classroom/Send/v3_Mail_Send/personalizations.html).

// The values below this comment are global to an entire message

$email->setFrom(new From("test@example.com", "Twilio SendGrid"));

$email->setGlobalSubject(
    new Subject("Sending with Twilio SendGrid is Fun and Global 2")
);

$plainTextContent = new PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email->addContent($plainTextContent);
$email->addContent($htmlContent);
$contents = [
    new Content("text/calendar", "Party Time!!"),
    new Content("text/calendar2", "Party Time 2!!")
];
$email->addContents($contents);

$email->addAttachment(
    new Attachment(
        "base64 encoded content1",
        "image/png",
        "banner.png",
        "inline",
        "Banner"
    )
);
$attachments = [
    new Attachment(
        "base64 encoded content2",
        "banner2.jpeg",
        "image/jpeg",
        "attachment",
        "Banner 3"
    ),
    new Attachment(
        "base64 encoded content3",
        "banner3.gif",
        "image/gif",
        "inline",
        "Banner 3"
    )
];
$email->addAttachments($attachments);

$email->setTemplateId(
    new TemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932")
);

$email->addGlobalHeader(new Header("X-Day", "Monday"));
$globalHeaders = [
    new Header("X-Month", "January"),
    new Header("X-Year", "2017")
];
$email->addGlobalHeaders($globalHeaders);

$email->addSection(
    new Section(
        "%section1%",
        "Substitution for Section 1 Tag"
    )
);

$sections = [
    new Section(
        "%section3%",
        "Substitution for Section 3 Tag"
    ),
    new Section(
        "%section4%",
        "Substitution for Section 4 Tag"
    )
];
$email->addSections($sections);

$email->addCategory(new Category("Category 1"));
$categories = [
    new Category("Category 2"),
    new Category("Category 3")
];
$email->addCategories($categories);

$email->setBatchId(
    new BatchId(
        "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
    )
);

$email->setReplyTo(
    new ReplyTo(
        "dx+replyto2@example.com",
        "DX Team Reply To 2"
    )
);

$asm = new Asm(
    new GroupId(1),
    new GroupsToDisplay([1,2,3,4])
);
$email->setAsm($asm);

$email->setIpPoolName(new IpPoolName("23"));

$mail_settings = new MailSettings();
$mail_settings->setBccSettings(
    new BccSettings(true, "bcc@example.com")
);

// Note: Bypass Spam, Bounce, and Unsubscribe management cannot
// be combined with Bypass List Management
$mail_settings->setBypassBounceManagement(
    new BypassBounceManagement(true)
);
$mail_settings->setBypassSpamManagement(
    new BypassSpamManagement(true)
);
$mail_settings->setBypassUnsubscribeManagement(
    new BypassUnsubscribeManagement(true)
);

// OR
$mail_settings->setBypassListManagement(
    new BypassListManagement(true)
);

$mail_settings->setFooter(
    new Footer(true, "Footer", "<strong>Footer</strong>")
);
$mail_settings->setSandBoxMode(new SandBoxMode(true));
$mail_settings->setSpamCheck(
    new SpamCheck(true, 1, "http://mydomain.com")
);
$email->setMailSettings($mail_settings);

$tracking_settings = new TrackingSettings();
$tracking_settings->setClickTracking(
    new ClickTracking(true, true)
);
$tracking_settings->setOpenTracking(
    new OpenTracking(true, "--sub--")
);
$tracking_settings->setSubscriptionTracking(
    new SubscriptionTracking(
        true,
        "subscribe",
        "<bold>subscribe</bold>",
        "%%sub%%"
    )
);
$tracking_settings->setGanalytics(
    new Ganalytics(
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

$from = new From("test@example.com", "Example User");
$subject = new Subject("Sending with Twilio SendGrid is Fun");
$to = new To("test@example.com", "Example User");
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
$email->setFrom("test@example.com", "Example User");
$tos = [
    "test+test1@example.com" => "Example User1",
    "test+test2@example.com" => "Example User2",
    "test+test3@example.com" => "Example User3"
];
$email->addTos($tos);
$email->setSubject("Sending with Twilio SendGrid is Fun");
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

$from = new From("test@example.com", "Example User");
$tos = [
    new To("test+test1@example.com", "Example User1"),
    new To("test+test2@example.com", "Example User2"),
    new To("test+test3@example.com", "Example User3")
];
$subject = new Subject("Sending with Twilio SendGrid is Fun");
$plainTextContent = new PlainTextContent(
    "and easy to do anywhere, even with PHP"
);
$htmlContent = new HtmlContent(
    "<strong>and easy to do anywhere, even with PHP</strong>"
);
$email = new Mail(
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

$from = new From("test@example.com", "Example User");
$tos = [
    new To(
        "test+test1@example.com",
        "Example User1",
        [
            '-name-' => 'Example User 1',
            '-github-' => 'http://github.com/example_user1'
        ],
        "Subject 1 -name-"
    ),
    new To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2',
            '-github-' => 'http://github.com/example_user2'
        ],
        "Subject 2 -name-"
    ),
    new To(
        "test+test3@example.com",
        "Example User3",
        [
            '-name-' => 'Example User 3',
            '-github-' => 'http://github.com/example_user3'
        ]
    )
];
$subject = new Subject("Hi -name-!"); // default subject
$globalSubstitutions = [
    '-time-' => "2018-05-03 23:10:29"
];
$plainTextContent = new PlainTextContent(
    "Hello -name-, your github is -github- sent at -time-"
);
$htmlContent = new HtmlContent(
    "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
);
$email = new Mail(
    $from,
    $tos,
    $subject, // or array of subjects, these take precedence
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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\To;

$from = new From("test@example.com", "Example User");
$tos = [
    new To(
        "test+test1@example.com",
        "Example User1",
        [
            '-name-' => 'Example User 1',
            '-github-' => 'http://github.com/example_user1'
        ],
        "Example User1 -name-"
    ),
    new To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2',
            '-github-' => 'http://github.com/example_user2'
        ],
        "Example User2 -name-"
    ),
    new To(
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
$plainTextContent = new PlainTextContent(
    "Hello -name-, your github is -github- sent at -time-"
);
$htmlContent = new HtmlContent(
    "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
);
$email = new Mail(
    $from,
    $tos,
    $subject, // or array of subjects, these take precedence
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

<a name="multiple-email-personalizations"></a>
# Send Multiple Emails with Personalizations

```php
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

$from = new From("test@example.com", "Twilio Sendgrid");
$to = new To(
    "test+test1@example.com",
    "Example User1",
    [
        '-name-' => 'Example User 1'
    ],
    "Example User1 -name-"
 );
$subject = new Subject("Hello from Twilio Sendgrid!");
$plainTextContent = new PlainTextContent(
    "How's it going -name-?"
);
$htmlContent = new HtmlContent(
    "<strong>How's it going -name-?</strong>"
);
$email = new Mail($from, $to, $subject, $plainTextContent, $htmlContent);

$personalization0 = new Personalization();
$personalization0->addTo(new To(
        "test+test2@example.com",
        "Example User2",
        [
            '-name-' => 'Example User 2'
        ],
        "Example User2 -name-"
));
$personalization0->addTo(new To(
        "test+test3@example.com",
        "Example User3",
        [
            '-name-' => 'Example User 3'
        ],
        "Example User3 -name-"
));
$personalization0->setSubject(new Subject("Hello from Twilio Sendgrid!"));
$email->addPersonalization($personalization0);

$personalization1 = new Personalization();
$personalization1->addTo(new To(
        "test+test3@example.com",
        "Example User4",
        [
            '-name-' => 'Example User 4'
        ],
        "Example User4 -name-"
));
$personalization1->addTo(new To(
        "test+test4@example.com",
        "Example User5",
        [
            '-name-' => 'Example User 5'
        ],
        "Example User5 -name-"
));
$personalization1->addFrom(new From(
    "test5@example.com" => "Twilio"
))
$personalization1->setSubject(new Subject("Hello from Twilio!"));
$mail->addPersonalization($personalization1);

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

<a name="set-region"></a>
# Set Region
The SendGrid object can also be used to set the region to "eu", which will send the request to https://api.eu.sendgrid.com/. By default, it is set to https://api.sendgrid.com/, e.g.

```php
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
$sendgrid->setDataResidency("eu");

OR

$sendgrid->setDataResidency("global");
```

<a name="transactional-templates"></a>
# Transactional Templates

For this example, we assume you have created a [dynamic transactional template](https://sendgrid.com/docs/ui/sending-email/how-to-send-an-email-with-dynamic-transactional-templates/) in the UI or via the API. Following is the template content we used for testing.

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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;

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
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
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

For this example, we assume you have created a [legacy transactional template](https://sendgrid.com/docs/User_Guide/Transactional_Templates/index.html) in the UI or via the API. Following is the template content we used for testing.

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
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use \SendGrid\Mail\From;
use \SendGrid\Mail\To;
use \SendGrid\Mail\Subject;
use \SendGrid\Mail\PlainTextContent;
use \SendGrid\Mail\HtmlContent;
use \SendGrid\Mail\Mail;

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
<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
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

# Send an Email With Twilio Email (Pilot)

### 1. Obtain a Free Twilio Account

Sign up for a free Twilio account [here](https://www.twilio.com/try-twilio?source=sendgrid-php).

### 2. Set Up Your Environment Variables

The Twilio API allows for authentication using with either an API key/secret or your Account SID/Auth Token. You can create an API key [here](https://twil.io/get-api-key) or obtain your Account SID and Auth Token [here](https://twil.io/console).

Once you have those, follow the steps below based on your operating system.

#### Linux/Mac

```bash
echo "export TWILIO_API_KEY='YOUR_TWILIO_API_KEY'" > twilio.env
echo "export TWILIO_API_SECRET='YOUR_TWILIO_API_SECRET'" >> twilio.env

# or

echo "export TWILIO_ACCOUNT_SID='YOUR_TWILIO_ACCOUNT_SID'" > twilio.env
echo "export TWILIO_AUTH_TOKEN='YOUR_TWILIO_AUTH_TOKEN'" >> twilio.env
```

Then:

```bash
echo "twilio.env" >> .gitignore
source ./twilio.env
```

#### Windows

Temporarily set the environment variable (accessible only during the current CLI session):

```bash
set TWILIO_API_KEY=YOUR_TWILIO_API_KEY
set TWILIO_API_SECRET=YOUR_TWILIO_API_SECRET

: or

set TWILIO_ACCOUNT_SID=YOUR_TWILIO_ACCOUNT_SID
set TWILIO_AUTH_TOKEN=YOUR_TWILIO_AUTH_TOKEN
```

Or permanently set the environment variable (accessible in all subsequent CLI sessions):

```bash
setx TWILIO_API_KEY "YOUR_TWILIO_API_KEY"
setx TWILIO_API_SECRET "YOUR_TWILIO_API_SECRET"

: or

setx TWILIO_ACCOUNT_SID "YOUR_TWILIO_ACCOUNT_SID"
setx TWILIO_AUTH_TOKEN "YOUR_TWILIO_AUTH_TOKEN"
```

### 3. Initialize the Twilio Email Client

```php
$twilioEmail = new \TwilioEmail(\getenv('TWILIO_API_KEY'), \getenv('TWILIO_API_SECRET'));

// or

$twilioEmail = new \TwilioEmail(\getenv('TWILIO_ACCOUNT_SID'), \getenv('TWILIO_AUTH_TOKEN'));
```

This client has the same interface as the `SendGrid` client.

# Send an SMS Message

First, follow the above steps for creating a Twilio account and setting up environment variables with the proper credentials.

Then, install the Twilio Helper Library.

```bash
composer require twilio/sdk
```

Finally, send a message.

```php
<?php
$sid = \getenv('TWILIO_ACCOUNT_SID');
$token = \getenv('TWILIO_AUTH_TOKEN');

$client = new \Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
  '8881231234', // Text this number
  [
    'from' => '9991231234', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  ]
);
```

For more information, please visit the [Twilio SMS PHP documentation](https://www.twilio.com/docs/sms/quickstart/php).

<a name="domain-authentication"></a>
# How to Set up a Domain Authentication

You can find documentation for how to setup a domain authentication via the UI [here](https://sendgrid.com/docs/ui/account-and-settings/how-to-set-up-domain-authentication/) and via API [here](USAGE.md#sender-authentication).

Find more information about all of Twilio SendGrid's authentication related documentation [here](https://sendgrid.com/docs/ui/account-and-settings/).

<a name="email-stats"></a>
# How to View Email Statistics

You can find documentation for how to view your email statistics via the UI [here](https://app.sendgrid.com/statistics) and via API [here](USAGE.md#stats).

Alternatively, we can post events to a URL of your choice via our [Event Webhook](https://sendgrid.com/docs/for-developers/tracking-events/event/) about events that occur as Twilio SendGrid processes your email.

<a name="email-activity"></a>
# How to Use the Email Activity Feed API

In order to gain access to the Email Activity Feed API, you must [purchase](https://app.sendgrid.com/settings/billing/addons/email_activity) additional email activity history. To learn about Sendgrid's API to download information from the Email Activity feed, get started [here](https://sendgrid.com/docs/API_Reference/Web_API_v3/Tutorials/getting_started_email_activity_api.html).

<a name="heroku"></a>
# Deploying to Heroku

Use the button below to instantly setup your own Simple instance for sending email using SendGrid on Heroku.

<a href="https://heroku.com/deploy?template=https://github.com/sendgrid/sendgrid-php/tree/example-heroku-hello-email">
  <img src="https://www.herokucdn.com/deploy/button.svg" alt="Deploy">
</a>

<a name="GAE-instructions"></a>
# Google App Engine Installation

Google App Engine installations with Composer require the creation of file `php.ini` in the base folder(the same directory as the `app.yaml` file). You can read more about this file [here](https://cloud.google.com/appengine/docs/standard/php/config/php_ini).

The file `php.ini` should contain:

```ini
google_app_engine.enable_curl_lite = 1
```
