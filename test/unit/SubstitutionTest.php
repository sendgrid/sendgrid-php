<?php
/**
 * This file tests substitutions.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\Substitution;

/**
 * This file tests attachments.
 *
 * @package SendGrid\Tests\Unit
 */
class SubstitutionTest extends TestCase
{
    public function testSubstitutionSetValue() {
        $substitution = new Substitution();
        $testString = 'Twilio SendGrid is awesome!';
        $testArray = ['one', 'two', 'three'];
        $testObject = (object) array('1' => 'foo');
        $testNumberInt = 1;
        $testNumberFloat = 1.0;

        $substitution->setValue($testString);
        $this->assertEquals($substitution->getValue(), $testString);
        $substitution->setValue($testArray);
        $this->assertEquals($substitution->getValue(), $testArray);
        $substitution->setValue($testObject);
        $this->assertEquals($substitution->getValue(), $testObject);
        $substitution->setValue($testNumberInt);
        $this->assertEquals($substitution->getValue(), $testNumberInt);
        $substitution->setValue($testNumberFloat);
        $this->assertEquals($substitution->getValue(), $testNumberFloat);
    }
}
