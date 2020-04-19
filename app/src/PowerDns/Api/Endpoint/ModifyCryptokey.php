<?php

namespace App\PowerDns\Api\Endpoint;

class ModifyCryptokey extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $zone_id;
    protected $cryptokey_id;

    /**
     * @param string $serverId    The id of the server to retrieve
     * @param string $cryptokeyId Cryptokey to manipulate
     */
    public function __construct(string $serverId, string $zoneId, string $cryptokeyId, \App\PowerDns\Api\Model\Cryptokey $requestBody)
    {
        $this->server_id = $serverId;
        $this->zone_id = $zoneId;
        $this->cryptokey_id = $cryptokeyId;
        $this->body = $requestBody;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{zone_id}', '{cryptokey_id}'], [$this->server_id, $this->zone_id, $this->cryptokey_id], '/servers/{server_id}/zones/{zone_id}/cryptokeys/{cryptokey_id}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \App\PowerDns\Api\Model\Cryptokey) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \App\PowerDns\Api\Exception\ModifyCryptokeyUnprocessableEntityException
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (204 === $status) {
            return null;
        }
        if (422 === $status) {
            throw new \App\PowerDns\Api\Exception\ModifyCryptokeyUnprocessableEntityException();
        }
    }
}
