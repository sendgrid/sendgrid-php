<?php
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Substitution;

/**
 * This file tests Substitutions.
 *
 * @package SendGrid\Tests\Unit
 */
class SubstitutionTest extends TestCase
{
    public function testSubstitutionSetValue() 
    {
        $substitution = new Substitution();
        $testString = 'Twilio SendGrid is awesome!';
        $testArray = ['one', 'two', 'three'];
        $testObject = (object) array('1' => 'foo');
        $testNumberInt = 1;
        $testNumberFloat = 1.0;
        $testInvalidInput = null;

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
        $this->expectException('SendGrid\Mail\TypeException');
        $substitution->setValue($testInvalidInput);
    }
}
