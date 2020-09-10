<?php declare(strict_types=1);

namespace App\Resolver;

use App\Entity\ClientEntity;

interface ClientActionResolverInterface
{
    public function resolveAction(ClientEntity $client): string;
}
