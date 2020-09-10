<?php

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ContextBag;
use PHPUnit\Framework\TestCase;

class ClientCreditLessThan200RuleTest extends TestCase
{

    public function testResolve()
    {
        $rule = new ClientCreditLessThan200Rule();
        $client = new ClientEntity('Mary', 100, new \DateTimeImmutable());
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
        $rule = new ClientCreditLessThan200Rule();
        $client = new ClientEntity('Jane', 300, new \DateTimeImmutable());
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
