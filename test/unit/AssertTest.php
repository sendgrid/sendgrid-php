<?php
/**
 * Assert class unit tests.
 */
namespace SendGrid\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SendGrid\Helper\Assert;
use SendGrid\Mail\TypeException;

class AssertTest extends TestCase
{
    public function testStringThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not a string.');

        Assert::string(false, 'test');
    }

    public function testStringThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::string(false, 'test', 'Custom message');
    }

    public function testStringWithCorrectValue()
    {
        Assert::string('test', 'test');

        $this->doesNotPerformAssertions();
    }

    public function testEmailThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not a valid email.');

        Assert::email('test', 'test');
    }

    public function testEmailThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::email('test', 'test', 'Custom message');
    }

    public function testEmailWithCorrectValue()
    {
        Assert::email('test@example.com', 'test');

        $this->doesNotPerformAssertions();
    }

    public function testIntegerThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not an integer.');

        Assert::integer('test', 'test');
    }

    public function testIntegerThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::integer('test', 'test', 'Custom message');
    }

    public function testIntegerWithCorrectValue()
    {
        Assert::integer(64627492, 'test');

        $this->doesNotPerformAssertions();
    }

    public function testBooleanThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not a boolean.');

        Assert::boolean('test', 'test');
    }

    public function testBooleanThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::boolean('test', 'test', 'Custom message');
    }

    public function testBooleanWithCorrectValue()
    {
        Assert::boolean(false, 'test');
        Assert::boolean(true, 'test');

        $this->doesNotPerformAssertions();
    }

    public function testIsInstanceOfThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Object "$test" is not an instance of "' . static::class . '".');

        Assert::isInstanceOf('test', 'test', static::class);
    }

    public function testIsInstanceOfThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::isInstanceOf('test', 'test', static::class, 'Custom message');
    }

    public function testIsInstanceOfWithCorrectValue()
    {
        Assert::isInstanceOf(new \stdClass(), 'test', \stdClass::class);

        $this->doesNotPerformAssertions();
    }

    public function testIsArrayThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not an array.');

        Assert::isArray('test', 'test');
    }

    public function testIsArrayThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::isArray('test', 'test', 'Custom message');
    }

    public function testIsArrayWithCorrectValue()
    {
        Assert::isArray(['test'], 'test');
        Assert::isArray([64627492, 8482842], 'test');

        $this->doesNotPerformAssertions();
    }

    public function testIsCallableThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Provided "$test" is not a callable.');

        Assert::isCallable('test', 'test');
    }

    public function testIsCallableThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::isCallable('test', 'test', 'Custom message');
    }

    public function testIsCallableWithCorrectValue()
    {
        $callback = static function () {
            return true;
        };

        Assert::isCallable($callback, 'test');

        $this->doesNotPerformAssertions();
    }

    public function testAcceptThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Provided "$test" is not valid.');

        Assert::accept('test', 'test', static function ($val) {
            return $val === [];
        });
    }

    public function testAcceptThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::accept('test', 'test', static function ($val) {
            return $val === [];
        }, 'Custom message');
    }

    public function testAcceptWithCorrectValue()
    {
        Assert::accept([], 'test', static function ($val) {
            return $val === [];
        });

        $this->doesNotPerformAssertions();
    }

    public function testMinItemsThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$test" can not be less than 5.');

        Assert::minItems([], 'test', 5);
    }

    public function testMinItemsThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::minItems([], 'test', 5, 'Custom message');
    }

    public function testMinItemsWithCorrectValue()
    {
        $range = range(1, 5);

        Assert::minItems($range, 'test', 2);

        $this->doesNotPerformAssertions();
    }

    public function testMaxItemsThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Number of elements in "$test" can not be more than 0.');

        Assert::maxItems(['test'], 'test', 0);
    }

    public function testMaxItemsThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::maxItems(['test'], 'test', 0, 'Custom message');
    }

    public function testMaxItemsWithCorrectValue()
    {
        $range = range(1, 2);

        Assert::maxItems($range, 'test', 5);

        $this->doesNotPerformAssertions();
    }

    public function testMinValueThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" expected to be at least 5.');

        Assert::minValue(3, 'test', 5);
    }

    public function testMinValueThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::minValue(3, 'test', 5, 'Custom message');
    }

    public function testMinValueWithCorrectValue()
    {
        Assert::minValue(5, 'test', 2);

        $this->doesNotPerformAssertions();
    }

    public function testMaxValueThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" expected to be at most 3.');

        Assert::maxValue(5, 'test', 3);
    }

    public function testMaxValueThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::maxValue(5, 'test', 3, 'Custom message');
    }

    public function testMaxValueWithCorrectValue()
    {
        Assert::maxValue(2, 'test', 5);

        $this->doesNotPerformAssertions();
    }

    public function testMinLengthThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" must have at least 5 characters.');

        Assert::minLength('test', 'test', 5);
    }

    public function testMinLengthThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::minLength('test', 'test', 5, 'Custom message');
    }

    public function testMinLengthWithCorrectValue()
    {
        Assert::minLength('test', 'test', 2);

        $this->doesNotPerformAssertions();
    }

    public function testMaxLengthThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" must have no more than 3 characters.');

        Assert::maxLength('test', 'test', 3);
    }

    public function testMaxLengthThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::maxLength('test', 'test', 3, 'Custom message');
    }

    public function testMaxLengthWithCorrectValue()
    {
        Assert::maxLength('test', 'test', 5);

        $this->doesNotPerformAssertions();
    }

    public function testAnyOfThrowExceptionWithDefaultMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Value "$test" is not in given "foo,bar".');

        Assert::anyOf('test', 'test', ['foo', 'bar']);
    }

    public function testAnyOfThrowExceptionWithCustomMessage()
    {
        $this->expectException(TypeException::class);
        $this->expectExceptionMessage('Custom message');

        Assert::anyOf('test', 'test', ['foo', 'bar'], 'Custom message');
    }

    public function testAnyOfWithCorrectValue()
    {
        Assert::anyOf(3, 'test', [1, 3, 5]);

        $this->doesNotPerformAssertions();
    }
}
