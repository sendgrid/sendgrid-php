<?php
/**
 * This file tests Personalization.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Bcc;
use SendGrid\Mail\Cc;
use SendGrid\Mail\CustomArg;
use SendGrid\Mail\From;
use SendGrid\Mail\Header;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\SendAt;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;
use SendGrid\Mail\TypeException;

/**
 * This class tests Personalization.
 *
 * @package SendGrid\Tests
 */
class PersonalizationTest extends TestCase
{
    public function testAddTo()
    {
        $personalization = new Personalization();
        $personalization->addTo(new To('dx@sendgrid.com'));

        $this->assertSame('dx@sendgrid.com', $personalization->getTos()[0]->getEmail());
    }

    public function testAddFrom()
    {
        $personalization = new Personalization();
        $personalization->addFrom(new From('dx@sendgrid.com'));

        $this->assertSame('dx@sendgrid.com', $personalization->getFrom()->getEmail());
    }

    public function testAddCc()
    {
        $personalization = new Personalization();
        $personalization->addCc(new Cc('dx@sendgrid.com'));

        $this->assertSame('dx@sendgrid.com', $personalization->getCcs()[0]->getEmail());
    }

    public function testAddBcc()
    {
        $personalization = new Personalization();
        $personalization->addBcc(new Bcc('dx@sendgrid.com'));

        $this->assertSame('dx@sendgrid.com', $personalization->getBccs()[0]->getEmail());
    }

    public function testSetSubject()
    {
        $personalization = new Personalization();
        $personalization->setSubject(new Subject('subject'));

        $this->assertSame('subject', $personalization->getSubject()->getSubject());
    }

    public function testSetSubjectOnInvalidSubjectClass()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$subject" must be an instance of SendGrid\\\Mail\\\Subject or a string/');

        $personalization = new Personalization();
        $personalization->setSubject(false);
    }

    public function testAddHeader()
    {
        $personalization = new Personalization();
        $personalization->addHeader(new Header('Content-Type', 'text/plain'));

        $this->assertSame(['Content-Type' => 'text/plain'], $personalization->getHeaders());
    }

    public function testAddDynamicTemplateData()
    {
        $personalization = new Personalization();
        $personalization->addDynamicTemplateData('data', 'data_value');

        $this->assertSame(['data' => 'data_value'], $personalization->getDynamicTemplateData());
    }

    public function testAddCustomArg()
    {
        $personalization = new Personalization();
        $personalization->addCustomArg(new CustomArg('custom_arg', 'arg_value'));

        $this->assertSame(['custom_arg' => 'arg_value'], $personalization->getCustomArgs());
    }

    public function testSetSendAt()
    {
        $personalization = new Personalization();
        $personalization->setSendAt(new SendAt(1539363393));

        $this->assertSame(1539363393, $personalization->getSendAt()->getSendAt());
    }

    public function testSendAtOnInvalidSendAtClass()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$send_at" must be an instance of "SendGrid\\\Mail\\\SendAt/');

        $personalization = new Personalization();
        $personalization->setSendAt('invalid_send_at_class');
    }

    public function testSetHasDynamicTemplate()
    {
        $personalization = new Personalization();
        $personalization->setHasDynamicTemplate(true);

        $this->assertTrue($personalization->getHasDynamicTemplate());
    }

    public function testSetHasDynamicTemplateOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$has_dynamic_template" must be a boolean/');

        $personalization = new Personalization();
        $personalization->setHasDynamicTemplate('invalid_bool_type');
    }
}
