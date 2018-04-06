<?php
use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;

require 'vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line

// Send a Single Email to a Single Recipient

// $from = new From("dx@sendgrid.com", "DX Team");
// $to = new To("elmer.thomas@sendgrid.com", "Elmer Thomas");
// $subject = new Subject("Sending with SendGrid is Fun");
// $plainTextContent = new PlainTextContent(
//     "and easy to do anywhere, even with PHP"
// );
// $htmlContent = new HtmlContent(
//     "<strong>and easy to do anywhere, even with PHP</strong>"
// );
// $email = new Mail(
//     $from,
//     $to,
//     $subject,
//     $plainTextContent,
//     $htmlContent
// );
// $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//     $response = $sendgrid->send($email);
// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
// }

// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

// Send a Single Email to Multiple Recipients

// $from = new From("dx@example.com", "DX Team");
// $tos = [ 
//     new To("elmer.thomas+test1@sendgrid.com", "Elmer Thomas1"),
//     new To("elmer.thomas+test2@sendgrid.com", "Elmer Thomas2"),
//     new To("elmer.thomas+test3@sendgrid.com", "Elmer Thomas3")
// ];
// $subject = new Subject("Sending with SendGrid is Fun");
// $plainTextContent = new PlainTextContent(
//     "and easy to do anywhere, even with PHP"
// );
// $htmlContent = new HtmlContent(
//     "<strong>and easy to do anywhere, even with PHP</strong>"
// );
// $email = new Mail(
//     $from,
//     $tos,
//     $subject,
//     $plainTextContent,
//     $htmlContent
// );
// $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//     $response = $sendgrid->send($email);
// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
// }
// echo $response->statusCode();
// print_r($response->headers());
// echo $response->body(); // This will be empty on a 202

// Send Multiple Emails to Multiple Recipients

$from = new From("dx@example.com", "DX Team");
$tos = [ 
    new To(
        "elmer.thomas+test1@sendgrid.com",
        "Elmer Thomas1",
        [
            '-name-' => 'Elmer 1',
            '-github-' => 'http://github.com/elmer1'
        ],
        "Subject 1 -name-"
    ),
    new To(
        "elmer.thomas+test2@sendgrid.com",
        "Elmer Thomas2",
        [
            '-name-' => 'Elmer 2',
            '-github-' => 'http://github.com/elmer2'
        ],
        "Subject 2 -name-"
    ),
    new To(
        "elmer.thomas+test3@sendgrid.com",
        "Elmer Thomas3",
        [
            '-name-' => 'Elmer 3',
            '-github-' => 'http://github.com/elmer3'
        ]
    )
];
$subject = new Subject("Hi -name-!"); // default subject 
// Alternatively, you can pass in a collection of subjects OR
// add a subject to the `To` object
// $subject = [
//     "Elmer 1.0 -name-",
//     "Elmer 2.0 -name-",
//     "Elmer 3.0 -name-"
// ];
$globalSubstitutions = [
    '-time-' => date("Y-m-d H:i:s")
];
$plainTextContent = new PlainTextContent("Hello -name-, your github is -github- sent at -time-");
$htmlContent = new HtmlContent("<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-");
$email = new Mail(
    $from,
    $tos,
    $subject, // or array of subjects, these take precendence
    $plainTextContent,
    $htmlContent,
    $globalSubstitutions
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $response->statusCode();
print_r($response->headers());
echo $response->body(); // This will be empty on a 202