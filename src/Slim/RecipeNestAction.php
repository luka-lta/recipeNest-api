<?php

declare(strict_types=1);

namespace RecipeNestApi\Slim;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RecipeNestApi\Exception\RecipeNestException;
use RecipeNestApi\Value\ErrorResult;
use RecipeNestApi\Value\RecipeNestResult;
use Throwable;

abstract class RecipeNestAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        try {
            $response = $this->execute($request, $response);
        } catch (RecipeNestException $exception) {
            $result = RecipeNestResult::from(
                ErrorResult::from($exception),
                $exception->getCode()
            );

            return $result->getResponse($response);
        } catch (Throwable $exception) {
            $result = RecipeNestResult::from(
                ErrorResult::from($exception),
                500
            );

            return $result->getResponse($response);
        }

        return $response;
    }

    abstract protected function execute(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface;
}
