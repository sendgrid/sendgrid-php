<?php

/**
 * Helper class for input parameters validation
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Helper
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
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
            $message = \sprintf(
                $message ?: 'Value "$%s" is not a string.',
                $property
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
        static::string($value, $property);

        if (!\filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $message = \sprintf(
                $message ?: 'Value "$%s" is not a valid email.',
                $property
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
        if (!\filter_var($value, FILTER_VALIDATE_INT)) {
            $message = \sprintf(
                $message ?: 'Value "$%s" is not an integer.',
                $property
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
            $message = \sprintf(
                $message ?: 'Value "$%s" is not a boolean.',
                $property
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
            $message = \sprintf(
                $message ?: 'Object "$%s" is not an instance of "%s".',
                $property,
                $className
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
            $message = \sprintf(
                $message ?: 'Value "$%s" is not an array.',
                $property
            );

            throw new TypeException($message);
        }
    }

    /**
     * Assert that value is a callable.
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
            $message = \sprintf(
                $message ?: 'Provided "$%s" is not a callable.',
                $property
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
        static::isCallable($callback, $property);

        if (!\call_user_func($callback, $value)) {
            $message = \sprintf(
                $message ?: 'Provided "$%s" is not valid.',
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
        static::isArray($value, $property);

        if (sizeof($value) > $size) {
            $message = \sprintf(
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
        static::isArray($value, $property);

        if (sizeof($value) < $size) {
            $message = \sprintf(
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
        static::integer($value, $property);

        if ($value > $limit) {
            $message = \sprintf(
                $message ?: 'Value "$%s" expected to be at most %d.',
                $property,
                $limit
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
        static::integer($value, $property);

        if ($value < $limit) {
            $message = \sprintf(
                $message ?: 'Value "$%s" expected to be at least %d.',
                $property,
                $limit
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
        static::string($value, $property);

        if (\mb_strlen($value, 'utf8') > $limit) {
            $message = \sprintf(
                $message ?: 'Value "$%s" must have no more than %d characters.',
                $property,
                $limit
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
        static::string($value, $property);

        if (\mb_strlen($value, 'utf8') < $limit) {
            $message = \sprintf(
                $message ?: 'Value "$%s" must have at least %d characters.',
                $property,
                $limit
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
            $message = \sprintf(
                $message ?: 'Value "$%s" is not in given "%s".',
                $property,
                \implode(',', $choices)
            );

            throw new TypeException($message);
        }
    }
}