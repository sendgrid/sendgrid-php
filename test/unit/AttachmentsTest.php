<?php
/**
 * This file tests attachments.
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
use SendGrid\Mail\Attachment;

/**
 * This file tests attachments.
 *
 * @package SendGrid\Tests
 */
class AttachmentsTests extends TestCase
{
    public function testWillEncodeNonBase64String() {

        $attachment = new Attachment();
        $testString = 'Sendgrid is awesome!';

        $attachment->setContent($testString);

        $this->assertEquals(base64_encode($testString), $attachment->getContent());
    }

    public function testWillNotEncodeBase64String() {

        $attachment = new Attachment();
        $testString = base64_encode('Sendgrid is awesome!');

        $attachment->setContent($testString);

        $this->assertEquals($testString, $attachment->getContent());
    }
}
