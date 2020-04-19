<?php

namespace App\PowerDns\Api\Endpoint;

class CreateZone extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;

    /**
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var bool $rrsets “true” (default) or “false”, whether to include the “rrsets” in the response Zone object.
     * }
     */
    public function __construct(string $serverId, \App\PowerDns\Api\Model\Zone $requestBody, array $queryParameters = [])
    {
        $this->server_id = $serverId;
        $this->body = $requestBody;
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
        if ($this->body instanceof \App\PowerDns\Api\Model\Zone) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
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
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (201 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\Zone', 'json');
        }
    }
}
