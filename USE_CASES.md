This documentation provides examples for specific use cases. Please [open an issue](https://github.com/sendgrid/sendgrid-php/issues) or make a pull request for any use cases you would like us to document here. Thank you!

# Table of Contents
* [Attachments](#attachments)
* [Transactional Templates](#transactional_templates)

<a name="attachments"></a>
# Attachments

Here is an example of attaching a text file to your email, assuming that text file `my_file.txt` is located in the same directory.

```php
<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php

// If you are using Composer (recommended)
require 'vendor/autoload.php';

// If you are not using Composer
// require("path/to/sendgrid-php/sendgrid-php.php");

$from = new \SendGrid\Mail\Email("Example User", "test@example.com");
$subject = "Sending with SendGrid is Fun";
$to = new \SendGrid\Mail\Email("Example User", "test@example.com");
$content = new \SendGrid\Mail\Content("text/plain", "and easy to do anywhere, even with PHP");
$file = 'my_file.txt';
$file_encoded = base64_encode(file_get_contents($file));
$attachment = new \SendGrid\Mail\Attachment();
$attachment->setContent($file_encoded);
$attachment->setType("application/text");
$attachment->setDisposition("attachment");
$attachment->setFilename("my_file.txt");

$mail = new \SendGrid\Mail\SendGridMessage($from, $subject, $to, $content);
$mail->addAttachment($attachment);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid\ClientFactory($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

?>
```

<a name="transactional_templates"></a>
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
// If you are using Composer
require 'vendor/autoload.php';

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

$from = new \SendGrid\Mail\Email(null, "test@example.com");
$subject = "I'm replacing the subject tag";
$to = new \SendGrid\Mail\Email(null, "test@example.com");
$content = new \SendGrid\Mail\Content("text/html", "I'm replacing the <strong>body tag</strong>");
$mail = new \SendGrid\Mail\SendGridMessage($from, $subject, $to, $content);
$mail->personalization[0]->addSubstitution("-name-", "Example User");
$mail->personalization[0]->addSubstitution("-city-", "Denver");
$mail->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid\ClientFactory($apiKey);

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
// If you are using Composer
require 'vendor/autoload.php';

// If you are not using Composer (recommended)
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
$sg = new \SendGrid\ClientFactory($apiKey);

try {
    $response = $sg->client->mail()->send()->post($request_body);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo $response->statusCode();
echo $response->body();
print_r($response->headers());
```
