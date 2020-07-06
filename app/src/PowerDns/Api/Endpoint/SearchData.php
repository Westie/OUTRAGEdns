<?php

namespace App\PowerDns\Api\Endpoint;

class SearchData extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * Search the data inside PowerDNS for search_term and return at most max_results. This includes zones, records and comments. The * character can be used in search_term as a wildcard character and the ? character can be used as a wildcard for a single character.
     *
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $q The string to search for
     *     @var int $max Maximum number of entries to return
     *     @var string $object_type Type of data to search for, one of “all”, “zone”, “record”, “comment”
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
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/search-data');
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
        $optionsResolver->setDefined(['q', 'max', 'object_type']);
        $optionsResolver->setRequired(['q', 'max']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('q', ['string']);
        $optionsResolver->setAllowedTypes('max', ['int']);
        $optionsResolver->setAllowedTypes('object_type', ['string']);
        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\SearchResult[]
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\SearchResult[]', 'json');
        }
    }
}
