<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Handler\RequestHandlerInterface;
use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Http\Response;

class BasicAuthMiddleware implements MiddlewareInterface
{
    private const PHP_AUTH_USER = 'PHP_AUTH_USER';
    private const PHP_AUTH_PW = 'PHP_AUTH_PW';

    /** @var string */
    private $user;

    /** @var string */
    private $password;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$request->getServer(self::PHP_AUTH_USER) || !$this->authenticate($request)) {
            return new Response(
                Response::STATUS_UNAUTHORIZED,
                "Unauthorized",
                $request->getRequestMethod(),
                $request->getRequestUrl(),
                []
            );
        }

        return $handler->handle($request);
    }

    private function authenticate(RequestInterface $request): bool
    {
        return $request->getServer(self::PHP_AUTH_USER) === $this->user &&
            $request->getServer(self::PHP_AUTH_PW) === $this->password;
    }
}
