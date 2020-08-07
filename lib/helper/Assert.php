<?php

/**
 * Helper class for input parameters validation
 *
 * @package SendGrid\Helper
 */

namespace SendGrid\Helper;

use SendGrid\Mail\TypeException;

class Assert
{
    /**
     * Assert that value is a string.
     *
     * @param mixed $value
     * @param string $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function string($value, $property, $message = null)
    {
        if (!\is_string($value)) {
            $message = sprintf(
                $message ?: '"$%s" must be a string. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is a valid email address.
     *
     * @param mixed $value
     * @param string $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function email($value, $property, $message = null)
    {
        static::string($value, $property, $message);

        //  Define additional flags for filter_var to verify unicode characters on local part
        //  Constant FILTER_FLAG_EMAIL_UNICODE is available since PHP 7.1
        $flags = (defined('FILTER_FLAG_EMAIL_UNICODE')) ? FILTER_FLAG_EMAIL_UNICODE : null;

        if (filter_var($value, FILTER_VALIDATE_EMAIL, $flags) === false) {
            $message = sprintf(
                $message ?: '"$%s" must be a valid email address. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is an integer.
     *
     * @param mixed $value
     * @param string $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function integer($value, $property, $message = null)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            $message = sprintf(
                $message ?: '"$%s" must be an integer. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is a boolean.
     *
     * @param mixed $value
     * @param string $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function boolean($value, $property, $message = null)
    {
        if (!\is_bool($value)) {
            $message = sprintf(
                $message ?: '"$%s" must be a boolean. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is an instance of provided class.
     *
     * @param mixed $value
     * @param string $property
     * @param string $className
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function isInstanceOf($value, $property, $className, $message = null)
    {
        if (!($value instanceof $className)) {
            $message = sprintf(
                $message ?: '"$%s" must be an instance of "%s". Got: %s',
                $property,
                $className,
                \is_object($value) ? \get_class($value) : (string) $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is an array.
     *
     * @param mixed $value
     * @param string $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function isArray($value, $property, $message = null)
    {
        if (!\is_array($value)) {
            $message = sprintf(
                $message ?: '"$%s" must be an array. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is callable.
     *
     * @param mixed $value
     * @param string|null $property
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function isCallable($value, $property, $message = null)
    {
        if (!\is_callable($value)) {
            $message = sprintf(
                $message ?: '"$%s" must be callable. Got: %s',
                $property,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value satisfies the conditions in callback function.
     *
     * @param mixed $value
     * @param string $property
     * @param callable $callback
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function accept($value, $property, $callback, $message = null)
    {
        static::isCallable($callback, 'callback', $message);

        if (!$callback($value)) {
            $message = sprintf(
                $message ?: '"$%s" is not valid.',
                $property
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that number of elements in array is less than a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $size
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function maxItems($value, $property, $size, $message = null)
    {
        static::isArray($value, $property, $message);

        if (\count($value) > $size) {
            $message = sprintf(
                $message ?: 'Number of elements in "$%s" can not be more than %d.',
                $property,
                $size
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that number of elements in array is more than a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $size
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function minItems($value, $property, $size, $message = null)
    {
        static::isArray($value, $property, $message);

        if (\count($value) < $size) {
            $message = sprintf(
                $message ?: 'Number of elements in "$%s" can not be less than %d.',
                $property,
                $size
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that a number is smaller as a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $limit
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function maxValue($value, $property, $limit, $message = null)
    {
        static::integer($value, $property, $message);

        $limit = (int) $limit;

        if ($value > $limit) {
            $message = sprintf(
                $message ?: '"$%s" expected to be at most %d. Got: %s',
                $property,
                $limit,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that a number is at least as big as a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $limit
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function minValue($value, $property, $limit, $message = null)
    {
        static::integer($value, $property, $message);

        $limit = (int) $limit;

        if ($value < $limit) {
            $message = sprintf(
                $message ?: '"$%s" expected to be at least %d. Got: %s',
                $property,
                $limit,
                $value
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that string value is not longer than a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $limit
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function maxLength($value, $property, $limit, $message = null)
    {
        static::string($value, $property, $message);

        $length = mb_strlen($value, 'utf8');

        if ($length > $limit) {
            $message = sprintf(
                $message ?: '"$%s" must have no more than %d characters. Got: %d',
                $property,
                $limit,
                $length
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that string value length is greater than a given limit.
     *
     * @param mixed $value
     * @param string $property
     * @param int $limit
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function minLength($value, $property, $limit, $message = null)
    {
        static::string($value, $property, $message);

        $length = mb_strlen($value, 'utf8');

        if ($length < $limit) {
            $message = sprintf(
                $message ?: '"$%s" must have at least %d characters. Got: %d',
                $property,
                $limit,
                $length
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is in array of choices.
     *
     * @param mixed $value
     * @param string $property
     * @param array $choices
     * @param string|null $message
     *
     * @throws TypeException
     */
    public static function anyOf($value, $property, array $choices, $message = null)
    {
        if (!\in_array($value, $choices, true)) {
            $message = sprintf(
                $message ?: '"$%s" must be any of "%s". Got: %s',
                $property,
                implode(', ', $choices),
                $value
            );

            throw new TypeException($message);
        }
    }
}
