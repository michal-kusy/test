<?php declare(strict_types=1);

namespace App\Http;

use App\Entity\ClientEntity;
use App\Exception\AssertionException;
use Iterator;

interface ResolveClientsActionRequestInterface
{
    /**
     * @return Iterator<ClientEntity>
     * @throws AssertionException
     */
    public function getClients(): Iterator;
}
