<?php

namespace App\PowerDns\Api\Endpoint;

class CreateMetadata extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;

    /**
     * Creates a set of metadata entries of given kind for the zone. Existing metadata entries for the zone with the same kind are not overwritten.
     *
     * @param string                           $serverId The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Metadata $metadata Metadata object with list of values to create
     */
    public function __construct(string $serverId, string $zoneId, \App\PowerDns\Api\Model\Metadata $metadata)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->body = $metadata;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}'], [$this->server_id, $this->zone_id], '/servers/{server_id}/zones/{zone_id}/metadata');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
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
        if (204 === $status) {
            return null;
        }
    }
}
