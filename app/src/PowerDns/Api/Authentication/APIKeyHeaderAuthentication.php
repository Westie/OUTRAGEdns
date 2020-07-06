<?php

namespace App\PowerDns\Api\Authentication;

class APIKeyHeaderAuthentication implements \Jane\OpenApiRuntime\Client\AuthenticationPlugin
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->{'apiKey'} = $apiKey;
    }

    public function authentication(\Psr\Http\Message\RequestInterface $request): \Psr\Http\Message\RequestInterface
    {
        return $request->withHeader('X-API-Key', $this->{'apiKey'});
    }

    public function getScope(): string
    {
        return 'APIKeyHeader';
    }
}
