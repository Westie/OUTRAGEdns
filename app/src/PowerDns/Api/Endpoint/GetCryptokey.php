<?php

namespace App\PowerDns\Api\Endpoint;

class GetCryptokey extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;
    protected $cryptokey_id;

    /**
     * @param string $serverId    The id of the server to retrieve
     * @param string $zoneId      The id of the zone to retrieve
     * @param string $cryptokeyId The id value of the CryptoKey
     */
    public function __construct(string $serverId, string $zoneId, string $cryptokeyId)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->cryptokey_id = $cryptokeyId;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}', '{cryptokey_id}'], [$this->server_id, $this->zone_id, $this->cryptokey_id], '/servers/{server_id}/zones/{zone_id}/cryptokeys/{cryptokey_id}');
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
     * @return null|\App\PowerDns\Api\Model\Cryptokey
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Cryptokey', 'json');
        }
    }
}
