<?php

namespace App\PowerDns\Api\Endpoint;

class ListServer extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string $serverId The id of the server to retrieve
     */
    public function __construct(string $serverId)
    {
        $this->server_id = $serverId;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    public function getAuthenticationScopes(): array
    {
        return ['APIKeyHeader'];
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\Server
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Server', 'json');
        }
    }
}
