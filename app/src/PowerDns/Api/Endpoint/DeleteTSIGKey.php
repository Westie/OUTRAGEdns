<?php

namespace App\PowerDns\Api\Endpoint;

class DeleteTSIGKey extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $tsigkey_id;

    /**
     * @param string $serverId  The id of the server to retrieve the key from
     * @param string $tsigkeyId The id of the TSIGkey. Should match the "id" field in the TSIGKey object
     */
    public function __construct(string $serverId, string $tsigkeyId)
    {
        $this->server_id = $serverId;
        $this->tsigkey_id = $tsigkeyId;
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{tsigkey_id}'], [$this->server_id, $this->tsigkey_id], '/servers/{server_id}/tsigkeys/{tsigkey_id}');
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
     * @throws \App\PowerDns\Api\Exception\DeleteTSIGKeyNotFoundException
     * @throws \App\PowerDns\Api\Exception\DeleteTSIGKeyInternalServerErrorException
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (204 === $status) {
            return null;
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\PowerDns\Api\Exception\DeleteTSIGKeyNotFoundException($serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Error', 'json'));
        }
        if (500 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\PowerDns\Api\Exception\DeleteTSIGKeyInternalServerErrorException($serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Error', 'json'));
        }
    }
}
