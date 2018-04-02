Hello!

It is now time to implement the final piece of our v2 to v3 migration. Before we dig into writing the code, we would love to get feedback on the following proposed interfaces.

We are starting with the use cases below for the first iteration. (we have completed this work on [our C# library](https://github.com/sendgrid/sendgrid-csharp/blob/master/USE_CASES.md), you can check that out for a sneak peek of where we are heading).

Big thanks to @caseyw for [helping](https://github.com/sendgrid/sendgrid-php/pull/411) get this party started :)

# Send a Single Email to a Single Recipient

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

```php
<?php
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$to = new To("test@example.com", "Example User");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Mail($from,
                  $to,
                  $subject,
                  $plainTextContent,
                  $htmlContent);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

# Send a Single Email to Multiple Recipients

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

```php
<?php
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$tos = [ 
    new To("test1@example.com", "Example User1"),
    new To("test2@example.com", "Example User2"),
    new To("test3@example.com", "Example User3")
];
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Mail($from,
                  $tos,
                  $subject,
                  $plainTextContent,
                  $htmlContent);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

# Send Multiple Emails to Multiple Recipients

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

```php
<?php
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$tos = [
    new To("test1@example.com",
           "Example User1",
           [
               '-name-' => 'Alain',
               '-github-' => 'http://github.com/ninsuo'
           ]),
    new To("test2@example.com",
           "Example User2",
           [
               '-name-' => 'Elmer',
               '-github-' => 'http://github.com/thinkingserious'
           ]),
    new To("test3@example.com",
           "Example User3",
           [
               '-name-' => 'Casey',
               '-github-' => 'http://github.com/caseyw'
           ])
];
// Alternatively, you can pass in a collection of subjects OR add a subject to the `To` object
$subject = new Subject("Hi -name-!");
$plainTextContent = new PlainTextContent("Hello -name-, your github is -github-, email sent at -time-");
$htmlContent = new HtmlContent("<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> email sent at -time-");
$globalSubstitutions = [
  '-time-' => date("Y-m-d H:i:s"),
];
$email = new Mail($from,
                  $tos,
                  $subject, // or $subjects
                  $plainTextContent,
                  $htmlContent,
		  $globalSubstitutions);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

# Kitchen Sink - an example with all settings used

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

```php
<?php
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$to = new To("test@example.com", "Example User");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Mail($from,
                  $to, // or $tos
                  $subject, // or $subjects if multiple $to objects
                  $plainTextContent,
                  $htmlContent);

// For a detailed description of each of these settings, please see the [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).

$email->addTo("test1@example.com", "Example User1");

$toEmails = [ 
    new To("test2@example.com", "Example User2"),
    new To("test3@example.com", "Example User3")
];
$email->addTos($toEmails);

$email->addCc(new Cc("test4@example.com", "Example User4"));

$ccEmails = [ 
    new Cc("test5@example.com", "Example User5"),
    new Cc("test6@example.com", "Example User6")
];
$email->addCcs($ccEmails);

$email->addBcc(new Mail("test7@example.com", "Example User7"));

$bccEmails = [ 
    new Bcc("test8@example.com", "Example User8"),
    new Bcc("test9@example.com", "Example User9")
];
$email->addBccs($bccEmails);

$email->addHeader("X-Test1", "Test1");
$email->addHeader("X-Test2", "Test2");

$headers = [
    "X-Test3" => "Test3",
    "X-Test4" => "Test4"
];
$email->addHeaders($headers);

$email->addSubstitution("%name1%", "Example Name 1");
$email->addSubstitution("%city1%", "Denver");

$substitutions = [
    "%name2%" => "Example Name 2",
    "%city2%" => "Orange"
];
$email->addSubstitutions($substitutions);

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

$email->setSubject("this subject overrides the Global Subject on the default Personalization");

// If you need to add more [Personalizations](https://sendgrid.com/docs/Classroom/Send/v3_Mail_Send/personalizations.html), here is an example of adding another Personalization by passing in a personalization index.

$email->addTo(new To("test10@example.com", "Example User10"), 1);

$toEmails = [ 
    new To("test11@example.com", "Example User11"),
    new To("test12@example.com", "Example User12")
];
$email->addTos($toEmails, 1);

$email->addCc(new Cc("test13@example.com", "Example User13"), 1);

$ccEmails = [ 
    new Cc("test14@example.com", "Example User14"),
    new Cc("test15@example.com", "Example User15")
];
$email->addCcs($ccEmails, 1);

$email->addBcc(new Bcc("test16@example.com", "Example User16"), 1);

$bccEmails = [ 
    new Bcc("test17@example.com", "Example User17"),
    new Bcc("test18@example.com", "Example User18")
];
$email->addBccs($bccEmails, 1);

$email->addHeader("X-Test5", "Test5", 1);
$email->addHeader("X-Test6", "Test6", 1);

$headers = [
    "X-Test7" => "Test7",
    "X-Test8" => "Test8"
];
$email->addHeaders($headers, 1);

$email->addSubstitution("%name3%", "Example Name 3", 1);
$email->addSubstitution("%city3%", "Redwood City", 1);

$substitutions = [
    "%name4%" => "Example Name 4",
    "%city4%" => "London"
];
$email->addSubstitutions($substitutions, 1);

$email->addCustomArg("marketing3", "true", 1);
$email->addCustomArg("transactional3", "false", 1);

$customArgs = [
    "marketing4" => "false",
    "transactional4" => "true"
];
$email->addCustomArgs($customArgs, 1);

$email->setSendAt(1461775052, 1);

$email->setSubject("this subject overrides the Global Subject on the second Personalization", 1);

// The values below this comment are global to entire message

$email->setFrom(new Mail("test0@example.com", "Example User0"));

$email->setGlobalSubject("Sending with SendGrid is Fun");

$email->addContent(MimeType::Text, "and easy to do anywhere, even with PHP");
$email->addContent(MimeType::Html, "<strong>and easy to do anywhere, even with PHP</strong>");

$contents = [
    new Content("text/calendar", "Party Time!!"),
    new Content("text/calendar2", "Party Time 2!!")
];
$email->addContents($contents);

$email->addAttachment("balance_001.pdf",
                      "base64 encoded content",
                      "application/pdf",
                      "attachment",
                      "Balance Sheet");

$attachments = [
    new Attachment("banner.png",
                   "base64 encoded content",
                   "image/png",
                   "inline",
                   "Banner"
                  ),
    new Attachment("banner2.png",
                   "base64 encoded content",
                   "image/png",
                   "inline",
                   "Banner 2"
                  )
];
$email->addAttachments($attachments);

$email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

$email->addGlobalHeader("X-Day", "Monday");

$globalHeaders = [
    "X-Month" => "January",
    "X-Year" => "2017"
];
$email->setGlobalHeaders($globalHeaders);

$email->addSection("%section1%", "Substitution for Section 1 Tag");

$sections = [
    "%section2%" => "Substitution for Section 2 Tag",
    "%section3%" => "Substitution for Section 3 Tag"
];
$email->addSections($sections);

// Reliability settings measured in seconds.
$reliabilitySettings = [
"retryCount" => 2,
"minBackOff" => 1,
"maxBackOff" => 10,
"deltaBackOff" => 3
];
$email->reliabilitySettings($reliabilitySettings);


$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

# Attachments

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

```php
<?php
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$to = new To("test@example.com", "Example User");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Mail($from,
                  $to,
                  $subject,
                  $plainTextContent,
                  $htmlContent);
$email->addAttachment("balance_001.pdf",
                      "base64 encoded content",
                      "application/pdf",
                      "attachment",
                      "Balance Sheet");

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

# Transactional Templates

The following code assumes you are storing the API key in an [environment variable (recommended)](https://github.com/sendgrid/sendgrid-php/blob/master/TROUBLESHOOTING.md#environment-variables-and-your-sendgrid-api-key). If you don't have your key stored in an environment variable, you can assign it directly to `$apiKey` for testing purposes.

For this example, we assume you have created a [transactional template](https://sendgrid.com/docs/User_Guide/Transactional_Templates/index.html). Following is the template content we used for testing.

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
use \SendGrid;
use \SendGrid\Mail;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new From("test@example.com", "Example User");
$to = new To("test@example.com", "Example User");
$subject = new Subject("Sending with SendGrid is Fun");
$plainTextContent = new PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Mail($from,
                  $to,
                  $subject,
                  $plainTextContent,
                  $htmlContent);
// See `Send Multiple Emails to Multiple Recipients` for additional methods for adding substitutions
$substitutions = [
    "-name-" => "Example User",
    "-city-" => "Denver"
];
$email->addSubstitutions($substitutions);
$email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```
