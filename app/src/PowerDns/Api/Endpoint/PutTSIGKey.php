<?php

namespace App\PowerDns\Api\Endpoint;

class PutTSIGKey extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $tsigkey_id;

    /**
     * The TSIGKey at tsigkey_id can be changed in multiple ways:
     * Changing the Name, this will remove the key with tsigkey_id after adding.
     * Changing the Algorithm
     * Changing the Key
     *
     * @param string                          $serverId  The id of the server to retrieve the key from
     * @param string                          $tsigkeyId The id of the TSIGkey. Should match the "id" field in the TSIGKey object
     * @param \App\PowerDns\Api\Model\TSIGKey $tsigkey   A (possibly stripped down) TSIGKey object with the new values
     */
    public function __construct(string $serverId, string $tsigkeyId, \App\PowerDns\Api\Model\TSIGKey $tsigkey)
    {
        $this->server_id = $serverId;
        $this->tsigkey_id = $tsigkeyId;
        $this->body = $tsigkey;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{tsigkey_id}'], [$this->server_id, $this->tsigkey_id], '/servers/{server_id}/tsigkeys/{tsigkey_id}');
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
     * @throws \App\PowerDns\Api\Exception\PutTSIGKeyNotFoundException
     * @throws \App\PowerDns\Api\Exception\PutTSIGKeyInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\TSIGKey', 'json');
        }
        if (404 === $status) {
            throw new \App\PowerDns\Api\Exception\PutTSIGKeyNotFoundException($serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Error', 'json'));
        }
        if (500 === $status) {
            throw new \App\PowerDns\Api\Exception\PutTSIGKeyInternalServerErrorException($serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Error', 'json'));
        }
    }
}
