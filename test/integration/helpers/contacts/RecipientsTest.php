<?php
namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;
use SendGrid\Contacts\RecipientForm;
use SendGrid\Contacts\Recipient;

class RecipientsTestRecipient extends BaseTestClass
{
    public function testRecipientsForm()
    {
        $form = (string) new RecipientForm('http://www.example.com/recipientFormSubmit');
        $this->assertEquals(
            $form, '<form action="http://www.example.com/recipientFormSubmit" method="post">
    First Name: <input type="text" name="first-name"><br>
    Last Name: <input type="text" name="last-name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>'
        );
    }
    public function testRecipientsFormSubmit()
    {
        $firstName = 'Test';
        $lastName = 'Tester';
        $email = 'test@test.com';
        $recipient = new Recipient($firstName, $lastName, $email);
        $json = json_encode($recipient);
        $this->assertEquals($json, '{"email":"test@test.com","first_name":"Test","last_name":"Tester"}');
    }
}
