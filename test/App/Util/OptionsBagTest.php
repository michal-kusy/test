<?php

namespace App\Util;

use PHPUnit\Framework\TestCase;

class OptionsBagTest extends TestCase
{

    public function testGetInt(): void
    {
        $value = 1;
        $bag = new OptionsBag(['int' => $value]);
        $this->assertSame($value, $bag->getInt('int'));
    }

    public function testGetString(): void
    {
        $value = 'string value';
        $bag = new OptionsBag(['string' => $value]);
        $this->assertSame($value, $bag->getString('string'));
    }
}
