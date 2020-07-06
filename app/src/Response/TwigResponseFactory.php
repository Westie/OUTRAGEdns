<?php

namespace App\Response;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TwigResponseFactory
{
    /**
     *  Called when connecting an app to this controller provider.
     */
    public function withResponse(ContainerInterface $container, Request $request, Response $response, string $file, array $context)
    {
        $response->getBody()->write(
            $container->get('view')->fetch($file, $context)
        );

        return $response;
    }
}
