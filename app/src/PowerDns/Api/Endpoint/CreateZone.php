<?php

namespace App\PowerDns\Api\Endpoint;

class CreateZone extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string                       $serverId        The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Zone $zoneStruct      The zone struct to patch with
     * @param array                        $queryParameters {
     *
     *     @var bool $rrsets “true” (default) or “false”, whether to include the “rrsets” in the response Zone object.
     * }
     */
    public function __construct(string $serverId, \App\PowerDns\Api\Model\Zone $zoneStruct, array $queryParameters = [])
    {
        $this->server_id = $serverId;
        $this->body = $zoneStruct;
        $this->queryParameters = $queryParameters;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}'], [$this->server_id], '/servers/{server_id}/zones');
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

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['rrsets']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['rrsets' => true]);
        $optionsResolver->setAllowedTypes('rrsets', ['bool']);
        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return null|\App\PowerDns\Api\Model\Zone
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (201 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Zone', 'json');
        }
    }
}
