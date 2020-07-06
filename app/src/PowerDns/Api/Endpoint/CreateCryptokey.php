<?php

namespace App\PowerDns\Api\Endpoint;

class CreateCryptokey extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;

    /**
     * This method adds a new key to a zone. The key can either be generated or imported by supplying the content parameter. if content, bits and algo are null, a key will be generated based on the default-ksk-algorithm and default-ksk-size settings for a KSK and the default-zsk-algorithm and default-zsk-size options for a ZSK.
     *
     * @param string                            $serverId  The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Cryptokey $cryptokey Add a Cryptokey
     */
    public function __construct(string $serverId, string $zoneId, \App\PowerDns\Api\Model\Cryptokey $cryptokey)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->body = $cryptokey;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}'], [$this->server_id, $this->zone_id], '/servers/{server_id}/zones/{zone_id}/cryptokeys');
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
     * @return null|\App\PowerDns\Api\Model\Cryptokey
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (201 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Cryptokey', 'json');
        }
    }
}
