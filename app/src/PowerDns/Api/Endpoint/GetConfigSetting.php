<?php

namespace App\PowerDns\Api\Endpoint;

class GetConfigSetting extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    protected $server_id;
    protected $config_setting_name;

    /**
     * NOT IMPLEMENTED
     *
     * @param string $serverId          The id of the server to retrieve
     * @param string $configSettingName The name of the setting to retrieve
     */
    public function __construct(string $serverId, string $configSettingName)
    {
        $this->server_id = $serverId;
        $this->config_setting_name = $configSettingName;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{server_id}', '{config_setting_name}'], [$this->server_id, $this->config_setting_name], '/servers/{server_id}/config/{config_setting_name}');
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
     * @return null|\App\PowerDns\Api\Model\ConfigSetting
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'App\\PowerDns\\Api\\Model\\ConfigSetting', 'json');
        }
    }
}
