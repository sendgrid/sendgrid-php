<?php
/**
 * This file tests email address encoding.
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
use Swaggest\JsonDiff\Exception as JsonDiffException;

/**
 * This class tests email address encoding.
 *
 * @package SendGrid\Tests\Unit
 */
class EmailAddressTest extends TestCase
{
    /** @var EmailAddress */
    protected $email;

    /**
     * Use a fresh instance in every test
     */
    public function setUp()
    {
        $this->email = new EmailAddress();
    }

    /**
     * This method tests various valid types of email names
     * @throws TypeException
     */
    public function testValidEmailNames()
    {
        $this->email->setName("John Doe");
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals('{"name":"John Doe"}', $json);

        $this->email->setName('');
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals('null', $json);
    }

    /**
     * This method tests various valid types of email addresses
     * @throws TypeException
     */
    public function testValidEmails()
    {
        $this->email->setEmailAddress('john@doe.com');
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals(
            '{"email":"john@doe.com"}',
            $json
        );

        $this->email->setEmailAddress('john+doe@example.com');
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals(
            '{"email":"john+doe@example.com"}',
            $json
        );

        $this->email->setEmailAddress('john.michael-smith@example.com');
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals(
            '{"email":"john.michael-smith@example.com"}',
            $json
        );
    }

    /**
     * This method tests a valid type for a substitution
     * @throws TypeException
     */
    public function testValidSubstitution()
    {
        $this->email->setSubstitutions([
            '-time-' => "2018-05-03 23:10:29"
        ]);
        // substitutions will not get output when serialized
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals(
            'null',
            $json
        );
    }

    /**
     * This method tests valid input for a subject
     * @throws TypeException
     */
    public function testValidSubject()
    {
        $this->email->setSubject('Dear Mr. John Doe');
        // subject will not get output when serialized
        $json = json_encode($this->email->jsonSerialize());
        self::assertEquals('null', $json);
    }

    /**
     * We can not use null as our name
     */
    public function testNullIsNotAValidName()
    {
        $this->expectException(TypeException::class);
        $this->email->setName(null);
    }

    /**
     * We can not use null as our email
     */
    public function testNullIsNotAValidEMail()
    {
        $this->expectException(TypeException::class);
        $this->email->setEmailAddress(null);
    }

    /**
     * We can not use null as substitution
     */
    public function testNullIsNotAValidSubstitution()
    {
        $this->expectException(TypeException::class);
        $this->email->setSubstitutions(null);
    }

    /**
     * We can not use null as our subject
     */
    public function testNullIsNotAValidSubject()
    {
        $this->expectException(TypeException::class);
        $this->email->setSubject(null);
    }

    /**
     * There should only be a single @ in our address
     */
    public function testDoubleAtSymbolIsNoValidEmail()
    {
        $this->expectException(TypeException::class);
        $this->email->setEmailAddress('test@example.com@wrong');
    }

    /**
     * @requires PHP 7.1
     */
    public function testEmailAddressLocalPartUnicode()
    {
        $email = new EmailAddress('françois@domain.tld');
        $json = json_encode($email->jsonSerialize());
        self::assertEquals(
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
        self::assertEquals(
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
        self::assertEquals(
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

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
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
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     * @throws JsonDiffException
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

        $isEqual = BaseTestClass::compareJSONObjects($json, $expectedJson);
        self::assertTrue($isEqual);
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

    /**
     * @throws TypeException
     */
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

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
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
        self::assertTrue($isEqual);
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

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
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
        self::assertTrue($isEqual);
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

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
    public function testNextPersonalizationAsArgument()
    {
        //  Scenario: add provided (3x)
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, null, new Personalization());
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, null, new Personalization());
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, null, new Personalization());

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
    public function testNextPersonalizationIndexArgumentStarting0()
    {
        //  Scenario: existing, add, add
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 0);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 1);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 2);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
    public function testNextPersonalizationIndexArgumentStarting1()
    {
        //  Scenario: add (3x)
        $objEmail = new Mail();
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 1);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 2);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 3);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED);
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     */
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

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
    public function testNextPersonalizationAsArgumentWithSender()
    {
        //  Scenario: add provided (3x)
        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, null, new Personalization());
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, null, new Personalization());
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, null, new Personalization());

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED_SENDER);
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     * @throws JsonDiffException
     */
    public function testNextPersonalizationIndexArgumentWithSenderStarting0()
    {
        //  Scenario: add (3x)
        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 0);
        $objEmail->addTo('foo+2@bar.com', 'foo bar2', null, 1);
        $objEmail->addTo('foo+3@bar.com', 'foo bar3', null, 2);

        $json = json_encode($objEmail, JSON_PRETTY_PRINT);

        $isEqual = BaseTestClass::compareJSONObjects($json, $this->EXPECT_PERSONALIZATIONS_SEPARATED_SENDER);
        self::assertTrue($isEqual);
    }

    /**
     * @throws TypeException
     */
    public function testInvalidNextPersonalizationIndexArgumentWithSenderStarting1()
    {
        //  Scenario: exception (no first Personalization is created, index 0 is expected)
        //  In this situation Mail constructor doesn't create first Personalization
        $this->expectException(InvalidArgumentException::class);

        $objEmail = new Mail(new From('testing@bar.com'));
        $objEmail->addTo('foo+1@bar.com', 'foo bar1', null, 1);
    }

    public function testConstructor()
    {
        $emailAddress = new EmailAddress('dx@sendgrid.com', 'Elmer', ['key' => 'value'], 'subject');

        $this->assertInstanceOf(EmailAddress::class, $emailAddress);
        $this->assertSame('dx@sendgrid.com', $emailAddress->getEmailAddress());
        $this->assertSame('Elmer', $emailAddress->getName());
        $this->assertSame(['key' => 'value'], $emailAddress->getSubstitutions());
        $this->assertSame('subject', $emailAddress->getSubject()->getSubject());
    }

    public function testSetEmailAddress()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setEmailAddress('dx@sendgrid.com');

        $this->assertSame('dx@sendgrid.com', $emailAddress->getEmailAddress());
        $this->assertSame('dx@sendgrid.com', $emailAddress->getEmail());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$emailAddress" must be a valid email address.
     */
    public function testSetEmailAddressOnInvalidFormat()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setEmailAddress('invalid_email_address_format');
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$emailAddress" must be a string.
     */
    public function testSetEmailAddressOnInvalidType()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setEmailAddress(['dx@sendgrid.com']);
    }

    public function testSetName()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setName('Elmer');

        $this->assertSame('Elmer', $emailAddress->getName());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$name" must be a string.
     */
    public function testSetNameOnInvalidType()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setName(['Elmer']);
    }

    public function testSetSubstitutions()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setSubstitutions(['key' => 'value']);

        $this->assertSame(['key' => 'value'], $emailAddress->getSubstitutions());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$substitutions" must be an array.
     */
    public function testSetSubstitutionsOnInvalidType()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setSubstitutions('invalid_type');
    }

    public function testSetSubject()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setSubject('subject');
        $subject = $emailAddress->getSubject();

        $this->assertInstanceOf(Subject::class, $subject);
        $this->assertSame('subject', $subject->getSubject());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$subject" must be a string.
     */
    public function testSetSubjectOnInvalidType()
    {
        $emailAddress = new EmailAddress();
        $emailAddress->setSubject(['invalid_subject']);
    }
}
