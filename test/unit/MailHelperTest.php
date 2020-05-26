<?php
/**
 * This file tests mail helper functionality.
 */

namespace SendGrid\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BccSettings;
use SendGrid\Mail\Content;
use SendGrid\Mail\EmailAddress;
use SendGrid\Mail\From;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;
use SendGrid\Mail\TypeException;

/**
 * This class tests mail helper functionality.
 *
 * @package SendGrid\Tests\Unit
 */
class MailHelperTest extends TestCase
{
    /**
     * This method tests various types of unencoded emails
     *
     * @throws TypeException
     */
    public function testEmailName()
    {
        $email = new EmailAddress('test@example.com', 'John Doe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals('{"name":"John Doe","email":"test@example.com"}', $json);

        $email->setName('');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals('{"email":"test@example.com"}', $json);

        $email->setName('Doe, John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"name":"\\"Doe, John\\"","email":"test@example.com"}',
            $json
        );

        $email->setName('Doe; John');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"name":"\\"Doe; John\\"","email":"test@example.com"}',
            $json
        );

        $email->setName('John "Billy" O\'Keeffe');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"name":"John \\"Billy\\" O\'Keeffe","email":"test@example.com"}',
            $json
        );

        $email->setName('O\'Keeffe, John "Billy"');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"name":"\\"O\'Keeffe, John \\\\\\"Billy\\\\\\"\\"","email":"test@example.com"}',
            $json
        );
    }

    public function testEmailAddress()
    {
        $email = new EmailAddress('test@example.com');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"email":"test@example.com"}',
            $json
        );
    }

    /**
     * A TypeException must be thrown when using invalid email address
     */
    public function testInvalidEmailAddress()
    {
        $this->expectException(TypeException::class);
        new EmailAddress('test@example.com@wrong');
    }

    /**
     * @requires PHP 7.1
     */
    public function testEmailAddressLocalPartUnicode()
    {
        $email = new EmailAddress('françois@domain.tld');
        $json = json_encode($email->jsonSerialize());
        $this->assertEquals(
            '{"email":"fran\u00e7ois@domain.tld"}',
            $json
        );
    }

    /**
     * Expect a TypeException when using invalid email address containing unicode in domain part
     * @requires PHP 7.1
     */
    public function testInvalidEmailAddressLocalPartUnicode()
    {
        $this->expectException(TypeException::class);
        new EmailAddress('françois.localpart@françois.domain.tld');
    }

    public function testBccEmailAddress()
    {
        $settings = new BccSettings(null, 'test@example.com');
        $json = json_encode($settings->jsonSerialize());
        $this->assertEquals(
            '{"email":"test@example.com"}',
            $json
        );
    }

    /**
     * A TypeException must be thrown when using invalid email address for Bcc
     */
    public function testInvalidBccEmailAddress()
    {
        $this->expectException(TypeException::class);
        new BccSettings(true, 'test@example.com@wrong');
    }

    /**
     * @requires PHP 7.1
     */
    public function testBccEmailAddressLocalPartUnicode()
    {
        $settings = new BccSettings(null, 'françois@domain.tld');
        $json = json_encode($settings->jsonSerialize());
        $this->assertEquals(
            '{"email":"fran\u00e7ois@domain.tld"}',
            $json
        );
    }

    /**
     * Expect a TypeException when using invalid email address containing unicode in domain part
     * @requires PHP 7.1
     */
    public function testInvalidBccEmailAddressLocalPartUnicode()
    {
        $this->expectException(TypeException::class);
        new BccSettings(null, 'françois.localpart@françois.domain.tld');
    }

    public function testJsonSerializeOverPersonalizationsShouldNotReturnNull()
    {
        $objEmail = new Mail();

        $objFrom = new From('my@self.com', 'my self');
        $objEmail->setFrom($objFrom);

        $objSubject = new Subject('test subject');
        $objEmail->setSubject($objSubject);

        $objContent = new Content('text/html', 'test content');
        $objEmail->addContent($objContent);

        $objPersonalization = new Personalization();

        $objTo = new To('foo@bar.com', 'foo bar');
        $objPersonalization->addTo($objTo);

        $objPersonalization->addSubstitution('{{firstname}}', 'foo');

        $objPersonalization->addSubstitution('{{lastname}}', 'bar');

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

    /**
     * @throws TypeException
     */
    public function testMailPersonalizations()
    {
        $objEmail = new Mail('me@example.com');

        // Add the first personalization.
        $objEmail->addTo('foo@bar.com', 'foo bar', ['this' => 'that']);
        // Update the last personalization.
        $objEmail->setSendAt(1234567890);
        // Update the first personalization.
        $objEmail->addHeader('Head', 'der', 0);
        // Append an existing personalization.
        $objEmail->addSubstitution('sub', 'this', null, new Personalization());

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
            "headers": {
                "Head": "der"
            },
            "substitutions": {
                "this": "that"
            },
            "send_at": 1234567890
        },
        {
            "substitutions": {
                "sub": "this"
            }
        }
    ],
    "from": {
        "email": "me@example.com"
    }
}
JSON;

        $this->assertEquals($expectedJson, $json);
    }

    public function testInvalidPersonalizationIndex()
    {
        $this->expectException(InvalidArgumentException::class);

        $objEmail = new Mail();
        $objEmail->addCustomArg('CUSTOM', 'ARG', 99);
    }
}
