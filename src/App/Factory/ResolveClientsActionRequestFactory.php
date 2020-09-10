<?php declare(strict_types=1);

namespace App\Factory;

use App\Exception\HttpRequestBodyStreamException;
use App\Http\RequestInterface;
use App\Http\ResolveClientsActionRequest;
use App\Http\ResolveClientsActionRequestInterface;
use App\Parser\ParserInterface;

class ResolveClientsActionRequestFactory implements ResolveClientsActionRequestFactoryInterface
{
    /** @var ParserInterface */
    private $parser;

    /** @var ClientEntityFactoryInterface */
    private $clientFactory;

    public function __construct(ParserInterface $parser, ClientEntityFactoryInterface $clientFactory)
    {
        $this->parser = $parser;
        $this->clientFactory = $clientFactory;
    }

    /**
     * @throws HttpRequestBodyStreamException
     */
    public function create(
        RequestInterface $request
    ): ResolveClientsActionRequestInterface {
        return new ResolveClientsActionRequest($request, $this->parser, $this->clientFactory);
    }
}
