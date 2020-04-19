<?php

namespace App\PowerDns\Api\Endpoint;

class ListZone extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;

    /**
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
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}'], [$this->server_id, $this->zone_id], '/servers/{server_id}/zones/{zone_id}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\Zone
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Zone', 'json');
        }
    }
}
