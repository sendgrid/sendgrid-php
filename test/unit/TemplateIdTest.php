<?php
/**
 * This file tests TemplateId.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\TemplateId;
use PHPUnit\Framework\TestCase;

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

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage "$template_id" must be a string.
     */
    public function testSetTemplateIdOnInvalidType()
    {
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
