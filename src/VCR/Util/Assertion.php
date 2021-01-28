<?php

namespace VCR\Util;

use Assert\Assertion as BaseAssertion;
use VCR\VCRException;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = 'VCR\VCRException';

    const INVALID_CALLABLE = 910;

    /**
     * Assert that the value is callable.
     *
     * @param mixed  $value        variable to check for a callable
     * @param string $message      exception message to show if value is not a callable
     * @param null   $propertyPath
     *
     * @throws \VCR\VCRException if specified value is not a callable
     */
    public static function isCallable($value, $message = null, string $propertyPath = null): bool
    {
        if (!\is_callable($value)) {
            throw new VCRException($message, self::INVALID_CALLABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a curl resource.
     *
     * @param mixed $value
     * @param string|callable|null $message
     * @param string|null $propertyPath
     *
     * @psalm-assert resource $string
     *
     * @return bool
     */
    public static function isCurlResource($value, $message = null, string $propertyPath = null): bool
    {
        if ($value === false) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a resource.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_RESOURCE, $propertyPath);
        }

        return true;
    }
}
