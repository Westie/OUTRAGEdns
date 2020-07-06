<?php

namespace App\PowerDns\Api\Endpoint;

class PutZone extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;

    /**
     * Allowed fields in client body: all except id, url and name. Returns 204 No Content on success.
     *
     * @param string                       $serverId   The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Zone $zoneStruct The zone struct to patch with
     */
    public function __construct(string $serverId, string $zoneId, \App\PowerDns\Api\Model\Zone $zoneStruct)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->body = $zoneStruct;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}'], [$this->server_id, $this->zone_id], '/servers/{server_id}/zones/{zone_id}');
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
