<?php
require 'vendor/autoload.php';
Dotenv::load(__DIR__);
$sendgrid_apikey = getenv('SG_KEY');
$sendgrid = new SendGrid($sendgrid_apikey);
$url = 'https://api.sendgrid.com/'; 
$template_id = '<template_id>';
$js = array(
  'sub' => array(':name' => array('Elmer')),
  'filters' => array('templates' => array('settings' => array('enable' => 1, 'template_id' => $template_id)))
);
echo json_encode($js);
$params = array(
    'to'        => "elmer.thomas@sendgrid.com", 
    'toname'    => "Elmer Thomas",
    'from'      => "dx@sendrid.com",
    'fromname'  => "DX Team",
    'subject'   => "PHP Test", 
    'text'      => "I'm text!",
    'html'      => "<strong>I'm HTML!</strong>",
    'x-smtpapi' => json_encode($js),
  );
$request =  $url.'api/mail.send.json';
$session = curl_init($request);
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
curl_setopt ($session, CURLOPT_POST, true);
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($session);
curl_close($session);
print_r($response);