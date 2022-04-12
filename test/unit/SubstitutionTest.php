<?php

namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Substitution;
use SendGrid\Mail\TypeException;

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
        $testObject = (object)array('1' => 'foo');
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

    public function testConstructor()
    {
        $substitution = new Substitution('key', 'value');

        $this->assertInstanceOf(Substitution::class, $substitution);
        $this->assertSame('key', $substitution->getKey());
        $this->assertSame('value', $substitution->getValue());
    }

    public function testSetKey()
    {
        $substitution = new Substitution();
        $substitution->setKey('key');

        $this->assertSame('key', $substitution->getKey());
    }

    public function testSetKeyOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$key" must be a string/');

        $substitution = new Substitution();
        $substitution->setKey(true);
    }

    public function testSetValue()
    {
        $substitution = new Substitution();
        $substitution->setValue('key');

        $this->assertSame('key', $substitution->getValue());
    }

    public function testSetValueOnInvalidType()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessageMatches('/"\$value" must be an array, object, boolean, string, numeric or integer/');

        $substitution = new Substitution();
        $substitution->setValue(null);
    }
}
