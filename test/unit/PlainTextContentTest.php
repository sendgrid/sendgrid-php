<?php
/**
 * This file tests PlainTextContent.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\PlainTextContent;
use PHPUnit\Framework\TestCase;

/**
 * This class tests PlainTextContent.
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
