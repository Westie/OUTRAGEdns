<?php

namespace App\PowerDns\Api\Endpoint;

class CacheFlushByName extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $domain The domain name to flush from the cache
     * }
     */
    public function __construct(string $serverId, array $queryParameters = [])
    {
        $this->server_id = $serverId;
        $this->queryParameters = $queryParameters;
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/cache/flush');
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

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['domain']);
        $optionsResolver->setRequired(['domain']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('domain', ['string']);
        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\CacheFlushResult
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\CacheFlushResult', 'json');
        }
    }
}
