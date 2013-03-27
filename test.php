<?php
require "vendor/autoload.php";
$sendgrid = new SendGrid('martyndavies', 'md9482');
$mail = new SendGrid\Mail();
$mail->addTo('martynrdavies@gmail.com')->
       setFrom('martyn@sendgrid.com')->
       setSubject('Subject goes here')->
       setText('Hello World!')->
       setHtml('<strong>Hello World!</strong>');

$sendgrid->smtp->send($mail);
echo "done!";
?>