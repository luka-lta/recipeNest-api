<?php

declare(strict_types=1);

namespace RecipeNestApi\Slim\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RecipeNestApi\Slim\CorsResponseManager;

class CORSMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = new CorsResponseManager();
        return $response->withCors($request, $handler->handle($request));
    }
}
