<?php declare(strict_types=1);

namespace App\Http\Handler;

use App\Entity\ClientEntity;
use App\Exception\AssertionException;
use App\Exception\HttpRequestBodyStreamException;
use App\Factory\ResolveClientsActionRequestFactory;
use App\Http\JsonResponse;
use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Resolver\ClientActionResolverInterface;
use App\Util\StatisticsInterface;

class ResolveClientActionHandler implements RequestHandlerInterface
{
    private const PAYLOAD_ACTIONS = 'actions';
    private const PAYLOAD_STATS = 'stats';

    /** @var ClientActionResolverInterface */
    private $resolver;

    /** @var ResolveClientsActionRequestFactory */
    private $requestFactory;

    /** @var StatisticsInterface */
    private $statistics;

    public function __construct(
        ResolveClientsActionRequestFactory $requestFactory,
        ClientActionResolverInterface $resolver,
        StatisticsInterface $statistics
    ) {
        $this->resolver = $resolver;
        $this->requestFactory = $requestFactory;
        $this->statistics = $statistics;
    }

    public function handle(RequestInterface $httpRequest): ResponseInterface
    {
        try {
            $request = $this->requestFactory->create($httpRequest);

            //TODO move to facade
            $clientActions = [];
            foreach ($request->getClients() as $client) {
                $action = $this->resolver->resolveAction($client);
                $clientActions[] = $this->makeClientActionRecord($client, $action);
                $this->statistics->addOne($action);
            }

            //TODO return new ResolveClientActionResponse();
            return new JsonResponse(
                [self::PAYLOAD_ACTIONS => $clientActions, self::PAYLOAD_STATS => $this->statistics->toArray()],
                JsonResponse::STATUS_OK,
                'OK',
                $httpRequest->getRequestMethod(),
                $httpRequest->getRequestUrl(),
                []
            );
        } catch (AssertionException | HttpRequestBodyStreamException $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                JsonResponse::STATUS_BADREQUEST,
                'Bad request',
                $httpRequest->getRequestMethod(),
                $httpRequest->getRequestUrl(),
                []
            );
        }
    }

    /**
     * @return string[]
     */
    private function makeClientActionRecord(ClientEntity $client, string $action): array
    {
        return ['name' => $client->getName(), 'action' => $action];
    }
}
