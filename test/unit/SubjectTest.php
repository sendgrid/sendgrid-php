<?php
/**
 * This file tests Subject.
 */

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Subject;
use SendGrid\Mail\TypeException;

/**
 * This class tests Subject.
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

    public function testSetSubjectOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$subject" must be a string/');

        $subject = new Subject();
        $subject->setSubject(true);
    }
}
