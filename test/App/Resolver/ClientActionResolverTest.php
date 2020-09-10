<?php

namespace App\Resolver;

use App\Entity\ClientEntity;
use PHPUnit\Framework\TestCase;

class ClientActionResolverTest extends TestCase
{

    /** Test rule CREDIT < 200 */
    public function testResolveClientWith100CreditTopUpToday(): void
    {
        $client = new ClientEntity('Mary', 100, new \DateTimeImmutable());
        $resolver = new ClientActionResolver();
        $action = $resolver->resolveAction($client);
        $this->assertEquals("SMS", $action);
    }

    /** Test rule  LAST TOP UP DATE > 5 months */
    public function testResolveClientWith100CreditTopUpLastYear(): void
    {
        $client = new ClientEntity('George', 300, (new \DateTimeImmutable())->modify('-1 year'));
        $resolver = new ClientActionResolver();
        $action = $resolver->resolveAction($client);
        $this->assertEquals("SMS", $action);
    }

    /** Test rule CREDIT <= 300 && LAST TOP UP DATE < 2 months */
    public function testResolveClientWith300CreditTopUpToday(): void
    {
        $client = new ClientEntity('John', 300, new \DateTimeImmutable());
        $resolver = new ClientActionResolver();
        $action = $resolver->resolveAction($client);
        $this->assertEquals("SMS", $action);
    }

    /** Test rule - other  */
    public function testResolveClientWith400CreditTopUpToday(): void
    {
        $client = new ClientEntity('Peter', 400, new \DateTimeImmutable());
        $resolver = new ClientActionResolver();
        $action = $resolver->resolveAction($client);
        $this->assertEquals("NONE", $action);
    }

}
