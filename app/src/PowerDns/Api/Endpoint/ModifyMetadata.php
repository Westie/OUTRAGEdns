<?php

namespace App\PowerDns\Api\Endpoint;

class ModifyMetadata extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;
    protected $metadata_kind;

    /**
     * Creates a set of metadata entries of given kind for the zone. Existing metadata entries for the zone with the same kind are removed.
     *
     * @param string                           $serverId     The id of the server to retrieve
     * @param string                           $metadataKind The kind of metadata
     * @param \App\PowerDns\Api\Model\Metadata $metadata     metadata to add/create
     */
    public function __construct(string $serverId, string $zoneId, string $metadataKind, \App\PowerDns\Api\Model\Metadata $metadata)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->metadata_kind = $metadataKind;
        $this->body = $metadata;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}', '{metadata_kind}'], [$this->server_id, $this->zone_id, $this->metadata_kind], '/servers/{server_id}/zones/{zone_id}/metadata/{metadata_kind}');
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
