<?php

namespace SendGrid\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;

/**
 * This class tests Personalization instance control provided by arguments in various function calls:
 * - addTo, addCc, addBcc (addRecipientEmail)
 * - addTos, addCcs, addBccs (addRecipientEmails)
 * - setSubject
 * - addHeader
 * - addSubstitution
 * - addCustomArg
 * - setSendAt
 *
 * @package SendGrid\Tests\Unit
 */
class PersonalizationArgumentsTest extends TestCase
{
    /** @var string Single email address */
    private $address = 'testing@example.com';

    /** @var array Collection of email addresses and their names */
    private $addresses = [
        'testing+1@example.com' => 'Example User1',
        'testing+2@example.com' => 'Example User2',
        'testing+3@example.com' => 'Example User3'
    ];

    public function testInvalidIndexUsingAddTo()
    {
        $mail = new Mail();

        $i = 41;
        $mail->addTo($this->address, null, null, $i);

        $this->assertEquals(true, $mail->isValidPersonalizationIndex($i));
    }

    public function testInvalidIndexUsingAddCc()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addCc($this->address, null, null, 41);
    }

    public function testInvalidIndexUsingAddBcc()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addBcc($this->address, null, null, 36);
    }

    public function testInvalidIndexUsingAddTos()
    {
        $mail = new Mail();

        $i = 42;
        $mail->addTos($this->addresses, $i);

        $this->assertEquals(true, $mail->isValidPersonalizationIndex($i));
    }

    public function testInvalidIndexUsingAddCcs()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addCcs($this->addresses, 25);
    }

    public function testInvalidIndexUsingAddBccs()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addBccs($this->addresses, 26);
    }

    public function testInvalidIndexUsingSetSubject()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->setSubject('Testing subject', 16);
    }

    public function testInvalidIndexUsingAddHeader()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addHeader('Hea', 'Der', 26);
    }

    public function testInvalidIndexUsingAddSubstitution()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addSubstitution('foo', 'bar', 22);
    }

    public function testInvalidIndexUsingAddCustomArg()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->addCustomArg('CUSTOM', 'ARG', 18);
    }

    public function testInvalidIndexUsingSetSendAt()
    {
        $this->expectException(InvalidArgumentException::class);

        $mail = new Mail();
        $mail->setSendAt(time() + 60, 21);
    }

    public function testLastAddedPersonalizationUsingInstance()
    {
        $personalization = new Personalization();

        $mail = new Mail();
        $mail->addTo($this->address, null, null, null, $personalization);

        $mailPersonalization = $mail->getPersonalization();

        $this->assertEquals(spl_object_hash($personalization), spl_object_hash($mailPersonalization));
    }

    public function testLastAddedPersonalizationUsingIndex()
    {
        $personalization = new Personalization();

        $mail = new Mail();
        $mail->addTo($this->address, null, null, null, $personalization);

        $insertedIndex = $mail->getPersonalizationIndex();
        $mailPersonalization = $mail->getPersonalization($insertedIndex);

        $this->assertEquals(spl_object_hash($personalization), spl_object_hash($mailPersonalization));
    }
}
