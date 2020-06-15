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
use SendGrid\Tests\BaseTestClass;

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
     *
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
     *
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

        $isEqual = BaseTestClass::compareJSONObjects($json, $expectedJson);
        $this->assertTrue($isEqual);
    }

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

        $isEqual = BaseTestClass::compareJSONObjects($json, $expectedJson);
        $this->assertTrue($isEqual);
    }

    public function testInvalidPersonalizationVariant1()
    {
        //  Try to add invalid Personalization instance
        //  TypeException must be thrown by Mail->addPersonalization()
        $this->expectException(TypeException::class);

        $objEmail = new Mail();
        $objEmail->addPersonalization(null);
    }

    public function testInvalidPersonalizationVariant2()
    {
        //  Try to add invalid Personalization instance
        //  Route: addTo -> addRecipientEmail() -> getPersonalization() -> addPersonalization()
        $this->expectException(TypeException::class);

        //  Create new Personalization...Subject
        $personalization = new Subject('Not a real Personalization instance');

        $objEmail = new Mail();
        $objEmail->addTo('foo+bar@example.com', 'foo bar', null, null, $personalization);
    }

    public function testInvalidPersonalizationIndex()
    {
        $this->expectException(InvalidArgumentException::class);

        $objEmail = new Mail();
        $objEmail->addCustomArg('CUSTOM', 'ARG', 99);
    }

    private $EXPECT_PERSONALIZATIONS_SINGLE = <<<JSON
{
    "personalizations": [
        {
            "to": [
                {
                    "name": "foo bar1",
                    "email": "foo+1@bar.com"
                },
                {
                    "name": "foo bar2",
                    "email": "foo+2@bar.com"
                },
                {
                    "name": "foo bar3",
                    "email": "foo+3@bar.com"
                }
            ]
        }
    ]
}
JSON;

    public function testLastRetrievedPersonalization()
    {
        //  Scenario: last added (2x)
        $objEmail = new Mail();
        $personalization = $objEmail->getPersonalization();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1');
        $personalization->addTo(new To('foo+2@bar.com', 'foo bar2'));
        $personalization->addTo(new To('foo+3@bar.com', 'foo bar3'));

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SINGLE);
        $this->assertTrue($isEqual);
    }

    private $EXPECT_PERSONALIZATIONS_SINGLE_SENDER = <<<JSON
{
    "personalizations": [
        {
            "to": [
                {
                    "name": "foo bar1",
                    "email": "foo+1@bar.com"
                },
                {
                    "name": "foo bar2",
                    "email": "foo+2@bar.com"
                },
                {
                    "name": "foo bar3",
                    "email": "foo+3@bar.com"
                }
            ]
        }
    ],
    "from": {
        "email": "testing@bar.com"
    }
}
JSON;

    public function testLastRetrievedPersonalizationWithSender()
    {
        //  Scenario: add + last added, last added
        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1');
        $personalization = $objEmail->getPersonalization();
        $personalization->addTo(new To('foo+2@bar.com', 'foo bar2'));
        $personalization->addTo(new To('foo+3@bar.com', 'foo bar3'));

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SINGLE_SENDER);
        $this->assertTrue($isEqual);
    }

    private $EXPECT_PERSONALIZATIONS_SEPARATED = <<<JSON
{
    "personalizations": [
        {
            "to": [
                {
                    "name": "foo bar1",
                    "email": "foo+1@bar.com"
                }
            ]
        },
        {
            "to": [
                {
                    "name": "foo bar2",
                    "email": "foo+2@bar.com"
                }
            ]
        },
        {
            "to": [
                {
                    "name": "foo bar3",
                    "email": "foo+3@bar.com"
                }
            ]
        }
    ]
}
JSON;

    public function testNextPersonalizationAsArgument()
    {
        //  Scenario: add provided (3x)
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, null, new Personalization());
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, null, new Personalization());
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, null, new Personalization());

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        $this->assertTrue($isEqual);
    }

    public function testNextPersonalizationIndexArgumentStarting0()
    {
        //  Scenario: existing, add, add
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 0);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 1);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 2);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        $this->assertTrue($isEqual);
    }

    public function testNextPersonalizationIndexArgumentStarting1()
    {
        //  Scenario: add (3x)
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 1);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 2);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 3);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        $this->assertTrue($isEqual);
    }

    public function testInvalidNextPersonalizationIndexArgument()
    {
        //  Scenario: add, exception (count=2, expected index 2, 3 provided)
        $this->expectException(InvalidArgumentException::class);

        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 1);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 3);
    }

    private $EXPECT_PERSONALIZATIONS_SEPARATED_SENDER = <<<JSON
{
    "personalizations": [
        {
            "to": [
                {
                    "name": "foo bar1",
                    "email": "foo+1@bar.com"
                }
            ]
        },
        {
            "to": [
                {
                    "name": "foo bar2",
                    "email": "foo+2@bar.com"
                }
            ]
        },
        {
            "to": [
                {
                    "name": "foo bar3",
                    "email": "foo+3@bar.com"
                }
            ]
        }
    ],
    "from": {
        "email": "testing@bar.com"
    }
}
JSON;

    public function testNextPersonalizationAsArgumentWithSender()
    {
        //  Scenario: add provided (3x)
        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, null, new Personalization());
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, null, new Personalization());
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, null, new Personalization());

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED_SENDER);
        $this->assertTrue($isEqual);
    }

    public function testNextPersonalizationIndexArgumentWithSenderStarting0()
    {
        //  Scenario: add (3x)
        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 0);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 1);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 2);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED_SENDER);
        $this->assertTrue($isEqual);
    }

    public function testInvalidNextPersonalizationIndexArgumentWithSenderStarting1()
    {
        //  Scenario: exception (no first Personalization is created, index 0 is expected)
        //  In this situation Mail constructor doesn't create first Personalization
        $this->expectException(InvalidArgumentException::class);

        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 1);
    }
}
