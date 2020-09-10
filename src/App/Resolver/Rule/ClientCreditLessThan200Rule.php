<?php declare(strict_types=1);

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ClientActionEnum;
use App\Resolver\ContextInterface;
use App\Resolver\RuleInterface;

class ClientCreditLessThan200Rule implements RuleInterface
{

    public function resolve(ContextInterface $context): bool
    {
        /** @var ClientEntity $clientEntity */
        $clientEntity = $context[ClientActionContextEnum::CLIENT];

        if ($clientEntity->getCredit() < 200) {
            $context[ClientActionContextEnum::ACTION] = ClientActionEnum::SMS;
            return true;
        }
        return false;
    }
}
