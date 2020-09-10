<?php declare(strict_types=1);

namespace App\Resolver\Rule;

use App\Entity\ClientEntity;
use App\Resolver\ClientActionContextEnum;
use App\Resolver\ClientActionEnum;
use App\Resolver\ContextInterface;
use App\Resolver\RuleInterface;

class ClientDefaultActionRule implements RuleInterface
{

    public function resolve(ContextInterface $context): bool
    {
        $context[ClientActionContextEnum::ACTION] = ClientActionEnum::NONE;
        return true;
    }
}
