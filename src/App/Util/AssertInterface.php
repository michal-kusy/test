<?php

namespace App\Util;

use App\Exception\AssertionException;

interface AssertInterface
{
    /**
     * @param mixed $value
     * @throws AssertionException
     */
    public function isString($value): void;

    /**
     * @param mixed $value
     * @throws AssertionException
     */
    public function isIntegerString($value): void;

    /**
     * @param mixed $value
     * @throws AssertionException
     */
    public function isDateString($value): void;

    /**
     * @param mixed $value
     * @throws AssertionException
     */
    public function isStringWithPattern($value, string $pattern, string $errorMessage): void;

    /**
     * @param mixed $value
     * @throws AssertionException
     */
    public function hasNumberOfElements($value, int $expectedCount): void;
}
