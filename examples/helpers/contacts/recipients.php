<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
require_once __DIR__ . '/../../../sendgrid-php.php';

// This will build an HTML form to be embedded in your page.
// This form allows users to subscribe using their name and email.
function buildRecipientForm($url = 'http://www.example.com/recipientFormSubmit')
{
    $form = (string) new \SendGrid\Contacts\RecipientForm($url);
    echo $form . PHP_EOL;
}

// This will accept a form submission from the above form. Will create a new Recipient,
// adding them to "contactdb". Note, it does not add the recipient to any list.
function recipientFormSubmit()
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    // These should be retrieved from $_POST
    $post_body = array(
        'first-name' => 'Test',
        'last-name' => 'Tester',
        'email' => 'test@test.com'
    );

    $firstName = $post_body['first-name'];
    $lastName = $post_body['last-name'];
    $email = $post_body['email'];
    $recipient = new \SendGrid\Contacts\Recipient($firstName, $lastName, $email);
    // $request_body = json_encode(array($recipient));
    $request_body = json_decode(
        '[
        {
            "email": "' . $recipient->getEmail() . '",
            "first_name": "' . $recipient->getFirstName() . '",
            "last_name": "' . $recipient->getLastName() . '"
        }
    ]'
    );

    try {
        $response = $sg->client->contactdb()->recipients()->post($request_body);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

buildRecipientForm(); // This will build and output an HTML form
recipientFormSubmit(); // This will simulate a form submission and will output the response.
