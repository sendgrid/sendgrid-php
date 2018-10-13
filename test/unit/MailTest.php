<?php
/**
 * This file tests Mail
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

use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use PHPUnit\Framework\TestCase;

/**
 * This class tests Mail
 *
 * @package SendGrid\Tests
 */
class MailTest extends TestCase
{
    public function testConstructor()
    {
        $mail = new Mail();

        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame(1, $mail->getPersonalizationCount());
    }
}
