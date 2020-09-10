<?php declare(strict_types=1);

namespace App\Resolver;

class ResolverEngine implements RuleInterface
{

    /** @var RuleInterface[] */
    private $rules;

    /** @var RuleInterface|null optional rule to execute if none passed */
    private $unmatchedRule;

    /**
     * @param RuleInterface[] $rules
     * @param RuleInterface|null $unmatchedRule optional rule to execute if none passed
     */
    public function __construct(array $rules, ?RuleInterface $unmatchedRule = null)
    {
        $this->rules = $rules;
        $this->unmatchedRule = $unmatchedRule;
    }

    public function resolve(ContextInterface $context): bool
    {
        $matched = false;

        foreach ($this->rules as $rule) {
            $matched =
                $rule->resolve($context) || $matched;
        }

        if (!$matched && $this->unmatchedRule !== null) {
            $this->unmatchedRule->resolve($context);
            $matched = true;
        }

        return $matched;
    }
}
