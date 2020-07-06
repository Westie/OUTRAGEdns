<?php

namespace App\PowerDns\Api\Endpoint;

class NotifyZone extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;

    /**
     * Fails when zone kind is not Master or Slave, or master and slave are disabled in the configuration. Only works for Slave if renotify is on. Clients MUST NOT send a body.
     *
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     */
    public function __construct(string $serverId, string $zoneId)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}'], [$this->server_id, $this->zone_id], '/servers/{server_id}/zones/{zone_id}/notify');
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
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return null;
        }
    }
}
