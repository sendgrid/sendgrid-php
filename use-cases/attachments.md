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

$mail = new SendGrid\Mail($from, $subject, $to, $content);
$mail->addAttachment($attachment);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

?>
```
