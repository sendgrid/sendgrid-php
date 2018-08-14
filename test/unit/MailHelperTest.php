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
}
