<?php
    require 'vendor/autoload.php';

    $from = new SendGrid\Email("Example User", getenv('FROM_EMAIL'));
    $subject = "Hello from sendgrid-php";
    $to = new SendGrid\Email("Example User", getenv('TO_EMAIL'));
    $content = new SendGrid\Content("text/plain", "Hello from sendgrid-php");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    
    $response = $sg->client->mail()->send()->post($mail);
    echo "status code: " . $response->statusCode() . "<BR>";
    echo "<pre>";
    print_r($response->headers());
    echo "</pre>";
    echo "response body: " . $response->body();