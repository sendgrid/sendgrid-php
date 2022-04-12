<?php
/**
 * This file tests TemplateId.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\TemplateId;
use SendGrid\Mail\TypeException;

/**
 * This class tests TemplateId.
 *
 * @package SendGrid\Tests
 */
class TemplateIdTest extends TestCase
{
    public function testConstructor()
    {
        $templateId = new TemplateId('template_id');

        $this->assertSame('template_id', $templateId->getTemplateId());
    }

    public function testSetTemplateId()
    {
        $templateId = new TemplateId();
        $templateId->setTemplateId('template_id');

        $this->assertSame('template_id', $templateId->getTemplateId());
    }

    public function testSetTemplateIdOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$template_id" must be a string/');

        $templateId = new TemplateId();
        $templateId->setTemplateId(true);
    }

    public function testJsonSerialize()
    {
        $templateId = new TemplateId();
        $templateId->setTemplateId('template_id');

        $this->assertSame('template_id', $templateId->jsonSerialize());
    }
}
