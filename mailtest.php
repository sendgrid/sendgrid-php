<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php");
// If not using Composer, uncomment the above line



$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$request_body = json_decode('{
  "content": [
    {
      "type": "text/html", 
      "value": "<html><p>Hello, world!</p></html>"
    }
  ], 
  "from": {
    "email": "james@jamesharding.me", 
    "name": "James Harding"
  }, 
  "headers": {}, 
  "mail_settings": {
    "bypass_list_management": {
      "enable": true
    }, 
    "footer": {
      "enable": true, 
      "html": "<p>Thanks</br>The SendGrid Team</p>", 
      "text": "Thanks,/n The SendGrid Team"
    }, 
    "sandbox_mode": {
      "enable": true
    }, 
    "spam_check": {
      "enable": true, 
      "post_to_url": "http://example.com/compliance", 
      "threshold": 3
    }
  }, 
  "personalizations": [
    {
      "headers": {
        "X-Accept-Language": "en", 
        "X-Mailer": "MyApp"
      }, 
      "subject": "Hello, World!", 
      "to": [
        {
          "email": "j.harding0093@gmail.com", 
          "name": "James Harding"
        }
      ]
    }
  ], 
  "reply_to": {
    "email": "james@jamesharding.me", 
    "name": "James Harding"
  },  
   
  "subject": "Hello, World!"
}');


$from = new \SendGrid\Mail\From(null, "test@example.com");
$subject = "Hello World from the SendGrid PHP Library";
$to = new \SendGrid\Mail\EmailAddress("Test Person", "test@example.com");

$plain_content = new \SendGrid\Mail\Content("text/plain", "some text here");
$html_content = new \SendGrid\Mail\Content("text/html", "<p>some text here</p>");


$mail = new \SendGrid\Mail\Mail($from, [$to], $subject, $html_content, $plain_content);

print_r($mail->getContents());