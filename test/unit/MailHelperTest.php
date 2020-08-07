<?php
/**
 * This file tests email address encoding
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
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
class MailHelperTest extends \PHPUnit\Framework\TestCase
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
     */
    public function testValidEmailNames()
    {
        $this->email->setName("John Doe");
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals($json, '{"name":"John Doe"}');

        $this->email->setName('');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals($json, 'null');

        $this->email->setName('Doe, John');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"Doe, John\\""}'
        );

        $this->email->setName('Doe; John');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"Doe; John\\""}'
        );

        $this->email->setName('John "Billy" O\'Keeffe');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"John \\"Billy\\" O\'Keeffe"}'
        );

        $this->email->setName('O\'Keeffe, John "Billy"');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"name":"\\"O\'Keeffe, John \\\\\\"Billy\\\\\\"\\""}'
        );
    }

    /**
     * This method tests various valid types of email addresses
     */
    public function testValidEmails()
    {
        $this->email->setEmailAddress('john@doe.com');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"email":"john@doe.com"}'
        );

        $this->email->setEmailAddress('john+doe@example.com');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"email":"john+doe@example.com"}'
        );

        $this->email->setEmailAddress('john.michael-smith@example.com');
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            '{"email":"john.michael-smith@example.com"}'
        );
    }

    /**
     * This method tests a valid type for a substitution
     */
    public function testValidSubstitution()
    {
        $this->email->setSubstitutions([
            '-time-' => "2018-05-03 23:10:29"
        ]);
        // substitutions will not get output when serialized
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals(
            $json,
            'null'
        );
    }

    /**
     * This method tests valid input for a subject
     */
    public function testValidSubject()
    {
        $this->email->setSubject('Dear Mr. John Doe');
        // subject will not get output when serialized
        $json = json_encode($this->email->jsonSerialize());
        $this->assertEquals($json, 'null');
    }


    /** Tests for invalid input
     *
     * Because phpunit stops after expecting the first Exception,
     * we need more then one function to test different scenarios with invalid input
     */

    /**
     * We can not use null as our name
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testNullIsNotAValidName()
    {
        $this->email->setName(null);
    }

    /**
     * We can not use null as our email
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testNullIsNotAValidEMail()
    {
        $this->email->setEmailAddress(null);
    }

    /**
     * We can not use null as substitution
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testNullIsNotAValidSubstitution()
    {
        $this->email->setSubstitutions(null);
    }

    /**
     * We can not use null as our subject
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testNullIsNotAValidSubject()
    {
        $this->email->setSubject(null);
    }

    /**
     * There should only be a single @ in our address
     *
     * @expectedException \SendGrid\Mail\TypeException
     */
    public function testDoubleAtSymbolIsNoValidEmail()
    {
        $this->email->setEmailAddress('test@example.com@wrong');
    }
}
