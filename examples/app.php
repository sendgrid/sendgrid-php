<?php 

include __dir__ . '/../' . 'SendGrid_loader.php';

$sendgrid = new SendGrid('cj', 'secret');

$mail = new SendGrid\Mail();
$mail->addTo('cj.buchmann@sendgrid.com')->
       setFrom('jorge.urias@sendgrid.com')->
       setSubject('Subject')->
       setHtml('Hello');


$sendgrid->smtp->send($mail);
