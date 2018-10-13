<?php
/**
 * This file tests Subject
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

use SendGrid\Mail\Subject;
use PHPUnit\Framework\TestCase;

/**
 * This class tests Subject
 *
 * @package SendGrid\Tests
 */
class SubjectTest extends TestCase
{
    public function testConstructor()
    {
        $subject = new Subject('subject');

        $this->assertInstanceOf(Subject::class, $subject);
        $this->assertSame('subject', $subject->getSubject());
    }

    public function testSetSubject()
    {
        $subject = new Subject();
        $subject->setSubject('subject');

        $this->assertSame('subject', $subject->getSubject());
    }

    public function testJsonSerialize()
    {
        $subject = new Subject();
        $subject->setSubject('subject');

        $this->assertSame('subject', $subject->jsonSerialize());
    }

    /**
     * @expectedException \SendGrid\Mail\TypeException
     * @expectedExceptionMessage $subject must be of type string.
     */
    public function testSetSubjectOnInvalidType()
    {
        $subject = new Subject();
        $subject->setSubject(true);
    }
}
