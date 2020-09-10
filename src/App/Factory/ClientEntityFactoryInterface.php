<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\ClientEntity;
use App\Exception\AssertionException;

interface ClientEntityFactoryInterface
{

    /**
     * @param mixed[] $data
     * @throws AssertionException
     */
    public function fromArray(array $data): ClientEntity;
}
