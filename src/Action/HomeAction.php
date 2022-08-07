<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write('Hello, World!');

        return $response;
    }
}