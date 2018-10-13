<?php
/**
 * This file tests PlainTextContent
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

use SendGrid\Mail\PlainTextContent;
use PHPUnit\Framework\TestCase;

/**
 * This class tests PlainTextContent
 *
 * @package SendGrid\Tests
 */
class PlainTextContentTest extends TestCase
{
    public function testConstructor()
    {
        $plainTextContent = new PlainTextContent('plain text');

        $this->assertSame('plain text', $plainTextContent->getValue());
    }
}
