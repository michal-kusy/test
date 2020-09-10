<?php

namespace App\Resolver\Rule;

use App\Resolver\ClientActionContextEnum;
use App\Resolver\ContextBag;
use PHPUnit\Framework\TestCase;

class ClientDefaultActionRuleTest extends TestCase
{

    public function testResolve()
    {
        $rule = new ClientDefaultActionRule();
        $context = new ContextBag(
            [
                ClientActionContextEnum::ACTION => 'NULL'
            ]
        );
        $matched = $rule->resolve($context);

        $this->assertTrue($matched, "Rule was applied");
        $this->assertEquals('NONE', $context[ClientActionContextEnum::ACTION]);
    }
}
