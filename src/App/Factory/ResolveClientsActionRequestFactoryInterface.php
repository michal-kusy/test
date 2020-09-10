<?php declare(strict_types=1);

namespace App\Factory;

use App\Exception\HttpRequestBodyStreamException;
use App\Http\RequestInterface;
use App\Http\ResolveClientsActionRequestInterface;

interface ResolveClientsActionRequestFactoryInterface
{

    /**
     * @throws HttpRequestBodyStreamException
     */
    public function create(
        RequestInterface $request
    ): ResolveClientsActionRequestInterface;
}
