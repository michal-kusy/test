<?php declare(strict_types=1);

namespace App\Resolver;

use App\Entity\ClientEntity;
use App\Resolver\Rule\ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule;
use App\Resolver\Rule\ClientCreditLessThan200Rule;
use App\Resolver\Rule\ClientDefaultActionRule;
use App\Resolver\Rule\ClientLastTopUpOlderThan5MonthsRule;

class ClientActionResolver implements ClientActionResolverInterface
{

    /** @var ResolverEngine */
    private $engine;


    public function resolveAction(ClientEntity $client): string
    {
        $engine = $this->getEngine();
        $context = $this->makeContext($client);
        $engine->resolve($context);
        return $context[ClientActionContextEnum::ACTION];
    }

    private function getEngine(): ResolverEngine
    {

        if ($this->engine === null) {
            $rules = [
                new ClientCreditLessThan200Rule(),
                new ClientLastTopUpOlderThan5MonthsRule(),
                new ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule()
            ];
            $unmatched = new ClientDefaultActionRule();

            $this->engine = new ResolverEngine($rules, $unmatched);
        }

        return $this->engine;
    }

    /**
     * @param ClientEntity $client
     * @return ContextBag
     */
    private function makeContext(ClientEntity $client): ContextBag
    {
        return new ContextBag(
            [
                ClientActionContextEnum::ACTION => ClientActionEnum::NULL,
                ClientActionContextEnum::CLIENT => $client
            ]
        );
    }
}
