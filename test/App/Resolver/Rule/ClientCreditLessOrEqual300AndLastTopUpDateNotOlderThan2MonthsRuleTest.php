<?php

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ContextBag;
use PHPUnit\Framework\TestCase;

class ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRuleTest extends TestCase
{

    public function testResolve()
    {
        $rule = new ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule();
        $client = new ClientEntity('Mary', 300, (new \DateTimeImmutable())->modify('-1 month'));
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

    public function testResolveNegativeOlder()
    {
        $rule = new ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule();
        $client = new ClientEntity('Jane', 100, (new \DateTimeImmutable())->modify('-12 month'));
        $context = new ContextBag(
            [
                ClientActionContextEnum::CLIENT => $client,
                ClientActionContextEnum::ACTION => 'NULL'
            ]
        );
        $matched = $rule->resolve($context);

        $this->assertFalse($matched, "Rule was not applied");
    }

    public function testResolveNegativeHigherCredit()
    {
        $rule = new ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule();
        $client = new ClientEntity('Jane', 301, (new \DateTimeImmutable())->modify('-12 month'));
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
