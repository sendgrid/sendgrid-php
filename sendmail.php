<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)

use \SendGrid\Mail;
use \SendGrid\Helpers\Mail\Model;

// require("path/to/sendgrid-php/sendgrid-php.php"); // If not using Composer, uncomment and comment out the above line

$from = new Model\EmailAddress("test@example.com", "Example User");
$to = new Model\EmailAddress("test@example.com", "Example User");
$subject = new Model\Subject("Sending with SendGrid is Fun");
$plainTextContent = new Model\PlainTextContent("and easy to do anywhere, even with PHP");
$htmlContent = new Model\HtmlContent("<strong>and easy to do anywhere, even with PHP</strong>");
$email = new Model\Mail($from,
$subject,
$to,
array($htmlContent, $plainTextContent)
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {

$response = $sendgrid->send($email);
} catch (Exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo $response->statusCode();
print_r($response->headers());
echo $response->body();
