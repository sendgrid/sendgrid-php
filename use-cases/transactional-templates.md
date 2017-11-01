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
