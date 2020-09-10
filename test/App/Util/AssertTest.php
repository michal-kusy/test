<?php

namespace App\Util;

use App\Exception\AssertionException;
use PHPUnit\Framework\TestCase;

class AssertTest extends TestCase
{

    public function testIsIntegerString()
    {
        $assert = new Assert();
        $assert->isString('ok');
        $this->assertTrue(true);
    }

    public function testIsStringWithPattern()
    {
        $assert = new Assert();
        $assert->isStringWithPattern('ok','/^ok$/', "Not ok");
        $this->assertTrue(true);
    }

    public function testIsDateString()
    {
        $assert = new Assert();
        $assert->isDateString('1.12.2020');
        $this->assertTrue(true);
    }

    public function testHasNumberOfElements()
    {
        $assert = new Assert();
        $assert->hasNumberOfElements([1,2,3],3);
        $this->assertTrue(true);
    }

    public function testIsString()
    {
        $assert = new Assert();
        $assert->isString('ok');
        $this->assertTrue(true);
    }

    public function testIsStringNegativeBool()
    {
        $assert = new Assert();

        $this->expectException(AssertionException::class);
        $assert->isString(false);
    }

    public function testIsStringNegativeNull()
    {
        $assert = new Assert();
        $this->expectException(AssertionException::class);
        $assert->isString(null);
    }

    public function testIsStringNegativeInt()
    {
        $assert = new Assert();
        $this->expectException(AssertionException::class);
        $assert->isString(0);
    }

    public function testIsStringNegativeFloat()
    {
        $assert = new Assert();
        $this->expectException(AssertionException::class);
        $assert->isString(0.0);
    }

}
