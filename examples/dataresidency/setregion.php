<?php
// index.php
require_once __DIR__ . '/../../sendgrid-php.php';

use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\To;
$exceptionMessage = 'Caught exception: ';

////////////////////////////////////////////////////
// Set data residency to navigate to a region/edge. #
// sending to global data residency

$email = buildHelloEmail();
$sendgrid = buildSendgridObject("global");

try {
    $response = $sendgrid->client->mail()->send()->post($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo $exceptionMessage,  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// sending to EU data residency

$sendgrid_eu = buildSendgridObject("eu");

try {
    $response = $sendgrid_eu->client->mail()->send()->post($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo $exceptionMessage,  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// not configuring any region defaults to global
$sendgrid_default = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid_default->client->mail()->send()->post($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo $exceptionMessage,  $e->getMessage(), "\n";
}

function buildHelloEmail(): Mail
{
    $email = new Mail();
    $email->setFrom("test@example.com", "test");
    $email->setSubject("Sending with Twilio SendGrid is Fun");
    $email->addTo("test@example.co", "test");
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent(
        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
    );
    $objPersonalization = new Personalization();

    $objTo = new To('foo@bar.com', 'foo bar');
    $objPersonalization->addTo($objTo);
    $email->addPersonalization($objPersonalization);
    return $email;
}

function buildSendgridObject($region): SendGrid
{
    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    $sendgrid->setDataResidency($region);
    return $sendgrid;
}
