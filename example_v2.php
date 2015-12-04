<?php
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
require 'lib/Client.php';
  
Dotenv::load(__DIR__);
$sendgrid_apikey = getenv('SG_KEY');
$sendgrid = new SendGrid($sendgrid_apikey);

$email = new SendGrid\Email();

$templateId = '<template_id>';
$name = array('Elmer');

$email
    ->addTo('example@example.com')
    ->setFrom('example@example.com')
    ->setSubject('Testing the PHP Library')
    ->setText('I\'m text!')
    ->setHtml('<strong>I\'m HTML!</strong>')
    ->addFilter('templates', 'enabled', 1)
    ->addFilter('templates', 'template_id', $templateId)
    ->addSubstitution(":name", $name)
;

$sendgrid->send($email);