<?php
/**
 * This file tests HtmlContent.
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

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\HtmlContent;

/**
 * This file tests HtmlContent.
 *
 * @package SendGrid\Tests
 */
class HtmlContentTest extends TestCase
{
    public function testConstructor()
    {
        $htmlContent = new HtmlContent('html_content');

        $this->assertInstanceOf(HtmlContent::class, $htmlContent);
        $this->assertSame('html_content', $htmlContent->getValue());
        $this->assertSame('text/html', $htmlContent->getType());
    }
}
