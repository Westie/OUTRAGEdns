<?php

namespace App\PowerDns\Api\Endpoint;

class GetStats extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * Query PowerDNS internal statistics.
     *
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $statistic When set to the name of a specific statistic, only this value is returned.
     *     @var bool $includerings “true” (default) or “false”, whether to include the Ring items, which can contain thousands of log messages or queried domains. Setting this to ”false” may make the response a lot smaller.
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
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/statistics');
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
        $optionsResolver->setDefined(['statistic', 'includerings']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['includerings' => true]);
        $optionsResolver->setAllowedTypes('statistic', ['string']);
        $optionsResolver->setAllowedTypes('includerings', ['bool']);
        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \App\PowerDns\Api\Exception\GetStatsUnprocessableEntityException
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return json_decode($body);
        }
        if (422 === $status) {
            throw new \App\PowerDns\Api\Exception\GetStatsUnprocessableEntityException();
        }
    }
}
