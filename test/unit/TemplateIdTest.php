<?php
/**
 * This file tests TemplateId
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

use SendGrid\Mail\TemplateId;
use PHPUnit\Framework\TestCase;

/**
 * This class tests TemplateId
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
     * @expectedExceptionMessage $template_id must be of type string.
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
