<?php

namespace App\PowerDns\Api\Endpoint;

class GetMetadata extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;
    protected $metadata_kind;

    /**
     * @param string $serverId     The id of the server to retrieve
     * @param string $zoneId       The id of the zone to retrieve
     * @param string $metadataKind The kind of metadata
     */
    public function __construct(string $serverId, string $zoneId, string $metadataKind)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->metadata_kind = $metadataKind;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}', '{metadata_kind}'], [$this->server_id, $this->zone_id, $this->metadata_kind], '/servers/{server_id}/zones/{zone_id}/metadata/{metadata_kind}');
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
     * @return null|\App\PowerDns\Api\Model\Metadata
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Metadata', 'json');
        }
    }
}
