This documentation provides examples for specific use cases. Please [open an issue](https://github.com/sendgrid/sendgrid-php/issues) or make a pull request for any use cases you would like us to document here. Thank you!

# Table of Contents
* [Attachments](#attachments)
* [Transactional Templates](#transactional-templates)
* [How to Setup a Domain Whitelabel](#domain-whitelabel)
* [How to View Email Statistics](#email-stats)
* [Deploying to Heroku](#heroku)
* [Google App Engine Installation](#GAE-instructions)

<a name="attachments"></a>
# Attachments

Here is an example of attaching a text file to your email, assuming that text file `my_file.txt` is located in the same directory.

```php
<?php
// If you are using Composer (recommended)
require 'vendor/autoload.php';

// If you are not using Composer and downloaded SendGrid's PHP Library
// http://dx.sendgrid.com/downloads/sendgrid-php/sendgrid-php-latest.zip
// require("path/to/sendgrid-php/sendgrid-php.php");

$from = new SendGrid\Email("Example User", "test@example.com");
$subject = "Sending with SendGrid is Fun";
$to = new SendGrid\Email("Example User", "test@example.com");
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");


$file = 'my_file.txt';
$file_encoded = base64_encode(file_get_contents($file));
$attachment = new SendGrid\Attachment();
$attachment->setContent($file_encoded);
$attachment->setType("application/text");
$attachment->setDisposition("attachment");
$attachment->setFilename("my_file.txt");

// OR

$attachment = new SendGrid\Attachment();
$attachment->setContentPath("my_file.txt");
$attachment->setType("application/text");
$attachment->setDisposition("attachment");

$mail = new SendGrid\Mail($from, $subject, $to, $content);
$mail->addAttachment($attachment);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

<a name="transactional-templates"></a>
# Transactional Templates

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

## With Mail Helper Class

```php
<?php
// If you are using Composer (recommended)
require 'vendor/autoload.php';

// If you are not using Composer and downloaded SendGrid's PHP Library
// http://dx.sendgrid.com/downloads/sendgrid-php/sendgrid-php-latest.zip
// require("path/to/sendgrid-php/sendgrid-php.php");

$from = new SendGrid\Email(null, "test@example.com");
$subject = "I'm replacing the subject tag";
$to = new SendGrid\Email(null, "test@example.com");
$content = new SendGrid\Content("text/html", "I'm replacing the <strong>body tag</strong>");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$mail->personalization[0]->addSubstitution("-name-", "Example User");
$mail->personalization[0]->addSubstitution("-city-", "Denver");
$mail->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->mail()->send()->post($mail);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo $response->statusCode();
print_r($response->headers());
echo $response->body();
```

## Without Mail Helper Class

```php
<?php
// If you are using Composer (recommended)
require 'vendor/autoload.php';

// If you are not using Composer and downloaded SendGrid's PHP Library
// http://dx.sendgrid.com/downloads/sendgrid-php/sendgrid-php-latest.zip
// require("path/to/sendgrid-php/sendgrid-php.php");

$request_body = json_decode('{
  "personalizations": [
    {
      "to": [
        {
          "email": "dx@sendgrid.com"
        }
      ],
      "substitutions": {
        "-name-": "Example User",
        "-city-": "Denver"
      },
      "subject": "I\'m replacing the subject tag"
    }
  ],
  "from": {
    "email": "elmer@sendgrid.com"
  },
  "content": [
    {
      "type": "text/html",
      "value": "I\'m replacing the <strong>body tag</strong>"
    }
  ],
  "template_id": "13b8f94f-bcae-4ec6-b752-70d6cb59f932"
}');

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->mail()->send()->post($request_body);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo $response->statusCode();
echo $response->body();
print_r($response->headers());
```

<a name="domain-whitelabel"></a>
# How to Setup a Domain Whitelabel

You can find documentation for how to setup a domain whitelabel via the UI [here](https://sendgrid.com/docs/Classroom/Basics/Whitelabel/setup_domain_whitelabel.html) and via API [here](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md#whitelabel).

Find more information about all of SendGrid's whitelabeling related documentation [here](https://sendgrid.com/docs/Classroom/Basics/Whitelabel/index.html).

<a name="email-stats"></a>
# How to View Email Statistics

You can find documentation for how to view your email statistics via the UI [here](https://app.sendgrid.com/statistics) and via API [here](https://github.com/sendgrid/sendgrid-php/blob/master/USAGE.md#stats).

Alternatively, we can post events to a URL of your choice via our [Event Webhook](https://sendgrid.com/docs/API_Reference/Webhooks/event.html) about events that occur as SendGrid processes your email.

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

