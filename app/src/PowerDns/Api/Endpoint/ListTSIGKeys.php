<?php

namespace App\PowerDns\Api\Endpoint;

class ListTSIGKeys extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string $serverId The id of the server
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
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/tsigkeys');
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
     * @throws \App\PowerDns\Api\Exception\ListTSIGKeysInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey[]
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\TSIGKey[]', 'json');
        }
        if (500 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\PowerDns\Api\Exception\ListTSIGKeysInternalServerErrorException($serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Error', 'json'));
        }
    }
}
