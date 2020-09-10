<?php declare(strict_types=1);

namespace App\Http\Handler;

use App\Http\RequestInterface;
use App\Http\ResponseInterface;

interface RequestHandlerInterface
{

    public function handle(RequestInterface $request): ResponseInterface;
}
