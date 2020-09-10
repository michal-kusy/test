<?php declare(strict_types=1);

use App\Factory\ClientEntityFactory;
use App\Factory\ResolveClientsActionRequestFactory;
use App\Http\Handler\ResolveClientActionHandler;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Request;
use App\Http\Response;
use App\Resolver\ClientActionResolver;
use App\Util\Assert;
use App\Util\Statistics;

// psr-4 micro-loader
spl_autoload_register(static function (string $class): void {
    require_once __DIR__ . '/../' . $class . '.php';
});

$request = Request::fromGlobal();

//TODO DI container
//TODO dispatcher
//TODO router + post route
//TODO default error handler middleware

$auth = new BasicAuthMiddleware("admin", "admin");
$parser = new App\Parser\CsvParser();
$assert = new Assert();
$clientFactory = new ClientEntityFactory($assert);
$requestFactory = new ResolveClientsActionRequestFactory($parser, $clientFactory);
$statistics = new Statistics();
$handler = new ResolveClientActionHandler($requestFactory, new ClientActionResolver(), $statistics);

if ($request->getRequestMethod() === Request::METHOD_POST) {
    // $response = $handler->handle($request); // bypass middleware
    $response = $auth->process($request, $handler);
} else {
    $response = new Response(
        Response::STATUS_BADREQUEST,
        "Bad request",
        $request->getRequestMethod(),
        $request->getRequestUrl(),
        []
    );
}

$response->send();
