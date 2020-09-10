<?php declare(strict_types=1);

namespace App\Util;

use App\Exception\AssertionException;

final class Assert implements AssertInterface
{
    private const REGEX_INTEGER = "/^\d+$/";
    private const REGEX_DATE = "/^\d{1,2}.\d{1,2}.\d{4}$/";


    public function isString($value): void
    {
        if (!is_string($value)) {
            $message = sprintf("Value is expected to be string type got %s instead", var_export($value, true));
            throw new AssertionException($message);
        }
    }

    public function isIntegerString($value): void
    {
        $message = "Value is expected to be string type with integer got %s instead";
        $this->isStringWithPattern($value, self::REGEX_INTEGER, $message);
    }

    public function isDateString($value): void
    {
        $message = "Value is expected to be string type with date (dd.mm.yyyy) got %s instead";
        $this->isStringWithPattern($value, self::REGEX_DATE, $message);
    }


    public function isStringWithPattern($value, string $pattern, string $errorMessage): void
    {
        if (!is_string($value) || preg_match($pattern, $value) === false) {
            throw new AssertionException(sprintf($errorMessage, var_export($value, true)));
        }
    }

    public function hasNumberOfElements($value, int $expectedCount): void
    {
        if (!is_array($value) || count($value) !== $expectedCount) {
            $message = sprintf(
                "Value is expected to be array type and to have %d elements, got %s instead",
                $expectedCount,
                var_export($value, true)
            );
            throw new AssertionException($message);
        }
    }
}
