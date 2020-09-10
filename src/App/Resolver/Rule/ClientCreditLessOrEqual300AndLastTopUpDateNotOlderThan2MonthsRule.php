<?php declare(strict_types=1);

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ClientActionEnum;
use App\Resolver\ContextInterface;
use App\Resolver\RuleInterface;

class ClientCreditLessOrEqual300AndLastTopUpDateNotOlderThan2MonthsRule implements RuleInterface
{
    public function resolve(ContextInterface $context): bool
    {
        /** @var ClientEntity $clientEntity */
        $clientEntity = $context[ClientActionContextEnum::CLIENT];

        $dateBeforeTwoMonths = (new \DateTimeImmutable())->modify('-2 months');

        if ($clientEntity->getCredit() <= 300 && $clientEntity->getLastTopUpDate() > $dateBeforeTwoMonths) {
            $context[ClientActionContextEnum::ACTION] = ClientActionEnum::SMS;
            return true;
        }
        return false;
    }
}
