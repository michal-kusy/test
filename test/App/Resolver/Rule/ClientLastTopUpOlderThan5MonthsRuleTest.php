<?php

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ContextBag;
use PHPUnit\Framework\TestCase;

class ClientLastTopUpOlderThan5MonthsRuleTest extends TestCase
{

    public function testResolve()
    {
        $rule = new ClientLastTopUpOlderThan5MonthsRule();
        $client = new ClientEntity('Mary', 100, (new \DateTimeImmutable())->modify('-1 year'));
        $context = new ContextBag(
            [
                ClientActionContextEnum::CLIENT => $client,
                ClientActionContextEnum::ACTION => 'NULL'
            ]
        );
        $matched = $rule->resolve($context);

        $this->assertTrue($matched, "Rule was applied");
        $this->assertEquals('SMS', $context[ClientActionContextEnum::ACTION]);
    }

    public function testResolveNegative()
    {
        $rule = new ClientLastTopUpOlderThan5MonthsRule();
        $client = new ClientEntity('Jane', 100, new \DateTimeImmutable());
        $context = new ContextBag(
            [
                ClientActionContextEnum::CLIENT => $client,
                ClientActionContextEnum::ACTION => 'NULL'
            ]
        );
        $matched = $rule->resolve($context);

        $this->assertFalse($matched, "Rule was not applied");
    }
}
