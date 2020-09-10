<?php declare(strict_types=1);

namespace App\Http;

use App\Entity\ClientEntity;
use App\Exception\AssertionException;
use App\Exception\HttpRequestBodyStreamException;
use App\Factory\ClientEntityFactoryInterface;
use App\Parser\ParserInterface;
use Iterator;

class ResolveClientsActionRequest implements ResolveClientsActionRequestInterface
{
    /** @var resource */
    private $stream;

    /** @var ClientEntityFactoryInterface */
    private $clientFactory;

    /** @var ParserInterface */
    private $parser;

    /**
     * @throws HttpRequestBodyStreamException
     */
    public function __construct(
        RequestInterface $request,
        ParserInterface $parser,
        ClientEntityFactoryInterface $clientFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->parser = $parser;
        $this->stream = $request->getBodyStream();
    }

    /**
     * @return Iterator<ClientEntity>
     * @throws AssertionException
     */
    public function getClients(): Iterator
    {
        foreach ($this->parser->parse($this->stream) as $line) {
            if (count($line) === 0) { // skip empty
                continue;
            }

            yield $this->clientFactory->fromArray($line);
        }
    }
}
