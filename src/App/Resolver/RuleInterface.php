<?php declare(strict_types=1);

namespace App\Resolver;

interface RuleInterface
{

    /**
     * @param ContextInterface $context
     * @return bool true if matched
     */
    public function resolve(ContextInterface $context): bool;
}
