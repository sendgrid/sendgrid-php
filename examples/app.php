<?php 

include __dir__ . '/../' . 'SendGrid_loader.php';

$sendgrid = new SendGrid('username', 'secret');

$mail = new SendGrid\Mail();
$mail->addTo('foo@bar.com')->
       setFrom('baz@bar.com')->
       setSubject('Subject')->
       setHtml('Hello');


$sendgrid->smtp->send($mail);
