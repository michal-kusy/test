<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Handler\RequestHandlerInterface;
use App\Http\RequestInterface;
use App\Http\ResponseInterface;

interface MiddlewareInterface
{
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
}
