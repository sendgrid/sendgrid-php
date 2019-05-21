<?php
/**
 * This file tests email address encoding
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;

use SendGrid\Mail\EmailAddress as EmailAddress;

/**
 * This class tests email address encoding
 *
 * @package SendGrid\Tests
 */
class MailTest_Mail extends \PHPUnit\Framework\TestCase
{
    /**
     * This method tests various types of unencoded emails
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testEmailName()
    {
        $email = new EmailAddress('test@example.com', 'John Doe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"name":"John Doe","email":"test@example.com"}');

        $email->setName('');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"email":"test@example.com"}');

        $email->setName(null);
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals($json, '{"email":"test@example.com"}');

        $email->setName('Doe, John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"Doe, John\\"","email":"test@example.com"}'
        );

        $email->setName('Doe; John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"Doe; John\\"","email":"test@example.com"}'
        );

        $email->setName('John "Billy" O\'Keeffe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"John \\"Billy\\" O\'Keeffe","email":"test@example.com"}'
        );

        $email->setName('O\'Keeffe, John "Billy"');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"O\'Keeffe, John \\\\\\"Billy\\\\\\"\\"","email":"test@example.com"}'
        );
    }

    /**
     * This method tests TypeException for wrong email address
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testEmailAddress()
    {
		$email = new EmailAddress();
    	$email->setEmailAddress('test@example.com@wrong');
    }

    public function testJsonSerializeOverPersonalizationsShouldNotReturnNull()
    {
        $objEmail = new \SendGrid\Mail\Mail();

        $objFrom = new \SendGrid\Mail\From('my@self.com', 'my self');
        $objEmail->setFrom($objFrom);

        $objSubject = new \SendGrid\Mail\Subject("test subject");
        $objEmail->setSubject($objSubject);

        $objContent = new \SendGrid\Mail\Content("text/html", "test content");
        $objEmail->addContent($objContent);


        $objPersonalization = new \SendGrid\Mail\Personalization();

        $objTo = new \SendGrid\Mail\To('foo@bar.com', 'foo bar');
        $objPersonalization->addTo($objTo);

        $objPersonalization->addSubstitution("{{firstname}}", 'foo');

        $objPersonalization->addSubstitution("{{lastname}}", 'bar');

        $objEmail->addPersonalization($objPersonalization);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $expectedJson = <<<JSON
{
    "personalizations": [
        {
            "to": [
                {
                    "name": "foo bar",
                    "email": "foo@bar.com"
                }
            ],
            "substitutions": {
                "{{firstname}}": "foo",
                "{{lastname}}": "bar"
            }
        }
    ],
    "from": {
        "name": "my self",
        "email": "my@self.com"
    },
    "subject": "test subject",
    "content": [
        {
            "type": "text\/html",
            "value": "test content"
        }
    ]
}
JSON;

        $this->assertEquals($expectedJson, $json);
    }
}
