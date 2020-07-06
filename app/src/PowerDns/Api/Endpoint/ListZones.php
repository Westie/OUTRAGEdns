<?php

namespace App\PowerDns\Api\Endpoint;

class ListZones extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $zone when set to the name of a zone, only this zone is returned
     *     @var bool $dnssec “true” (default) or “false”, whether to include the “dnssec” and ”edited_serial” fields in the Zone objects. Setting this to ”false” will make the query a lot faster.
     * }
     */
    public function __construct(string $serverId, array $queryParameters = [])
    {
        $this->server_id = $serverId;
        $this->queryParameters = $queryParameters;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/zones');
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
        $optionsResolver->setDefined(['zone', 'dnssec']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['dnssec' => true]);
        $optionsResolver->setAllowedTypes('zone', ['string']);
        $optionsResolver->setAllowedTypes('dnssec', ['bool']);
        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\Zone[]
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Zone[]', 'json');
        }
    }
}
