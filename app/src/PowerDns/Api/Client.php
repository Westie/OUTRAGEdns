<?php

namespace App\PowerDns\Api;

class Client extends \Jane\OpenApiRuntime\Client\Psr18Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Server[]|\Psr\Http\Message\ResponseInterface
     */
    public function listServers(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListServers(), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Server|\Psr\Http\Message\ResponseInterface
     */
    public function listServer(string $serverId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListServer($serverId), $fetch);
    }

    /**
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $domain The domain name to flush from the cache
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\CacheFlushResult|\Psr\Http\Message\ResponseInterface
     */
    public function cacheFlushByName(string $serverId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\CacheFlushByName($serverId, $queryParameters), $fetch);
    }

    /**
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $zone When set to the name of a zone, only this zone is returned.
     *     @var bool $dnssec “true” (default) or “false”, whether to include the “dnssec” and ”edited_serial” fields in the Zone objects. Setting this to ”false” will make the query a lot faster.
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Zone[]|\Psr\Http\Message\ResponseInterface
     */
    public function listZones(string $serverId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListZones($serverId, $queryParameters), $fetch);
    }

    /**
     * @param string                       $serverId        The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Zone $requestBody
     * @param array                        $queryParameters {
     *
     *     @var bool $rrsets “true” (default) or “false”, whether to include the “rrsets” in the response Zone object.
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Zone|\Psr\Http\Message\ResponseInterface
     */
    public function createZone(string $serverId, Model\Zone $requestBody, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\CreateZone($serverId, $requestBody, $queryParameters), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\DeleteZone($serverId, $zoneId), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Zone|\Psr\Http\Message\ResponseInterface
     */
    public function listZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListZone($serverId, $zoneId), $fetch);
    }

    /**
     * @param string                       $serverId    The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Zone $requestBody
     * @param string                       $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function patchZone(string $serverId, string $zoneId, Model\Zone $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\PatchZone($serverId, $zoneId, $requestBody), $fetch);
    }

    /**
     * Allowed fields in client body: all except id, url and name. Returns 204 No Content on success.
     *
     * @param string                       $serverId    The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Zone $requestBody
     * @param string                       $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function putZone(string $serverId, string $zoneId, Model\Zone $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\PutZone($serverId, $zoneId, $requestBody), $fetch);
    }

    /**
     * Fails when zone kind is not Master or Slave, or master and slave are disabled in the configuration. Only works for Slave if renotify is on. Clients MUST NOT send a body.
     *
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function notifyZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\NotifyZone($serverId, $zoneId), $fetch);
    }

    /**
     * Fails when zone kind is not Slave, or slave is disabled in the configuration. Clients MUST NOT send a body.
     *
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function axfrRetrieveZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\AxfrRetrieveZone($serverId, $zoneId), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function axfrExportZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\AxfrExportZone($serverId, $zoneId), $fetch);
    }

    /**
     * This does not take into account the API-RECTIFY metadata. Fails on slave zones and zones that do not have DNSSEC.
     *
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function rectifyZone(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\RectifyZone($serverId, $zoneId), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\ConfigSetting[]|\Psr\Http\Message\ResponseInterface
     */
    public function getConfig(string $serverId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetConfig($serverId), $fetch);
    }

    /**
     * NOT IMPLEMENTED
     *
     * @param string $serverId          The id of the server to retrieve
     * @param string $configSettingName The name of the setting to retrieve
     * @param string $fetch             Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\ConfigSetting|\Psr\Http\Message\ResponseInterface
     */
    public function getConfigSetting(string $serverId, string $configSettingName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetConfigSetting($serverId, $configSettingName), $fetch);
    }

    /**
     * Query PowerDNS internal statistics.
     *
     * @param string $serverId        The id of the server to retrieve
     * @param array  $queryParameters {
     *
     *     @var string $statistic When set to the name of a specific statistic, only this value is returned.
     *     @var bool $includerings “true” (default) or “false”, whether to include the Ring items, which can contain thousands of log messages or queried domains. Setting this to ”false” may make the response a lot smaller.
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\GetStatsUnprocessableEntityException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getStats(string $serverId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetStats($serverId, $queryParameters), $fetch);
    }

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
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\SearchResult[]|\Psr\Http\Message\ResponseInterface
     */
    public function searchData(string $serverId, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\SearchData($serverId, $queryParameters), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Metadata[]|\Psr\Http\Message\ResponseInterface
     */
    public function listMetadata(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListMetadata($serverId, $zoneId), $fetch);
    }

    /**
     * Creates a set of metadata entries of given kind for the zone. Existing metadata entries for the zone with the same kind are not overwritten.
     *
     * @param string                           $serverId    The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Metadata $requestBody
     * @param string                           $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createMetadata(string $serverId, string $zoneId, Model\Metadata $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\CreateMetadata($serverId, $zoneId, $requestBody), $fetch);
    }

    /**
     * @param string $serverId     The id of the server to retrieve
     * @param string $zoneId       The id of the zone to retrieve
     * @param string $metadataKind The kind of metadata
     * @param string $fetch        Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteMetadata(string $serverId, string $zoneId, string $metadataKind, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\DeleteMetadata($serverId, $zoneId, $metadataKind), $fetch);
    }

    /**
     * @param string $serverId     The id of the server to retrieve
     * @param string $zoneId       The id of the zone to retrieve
     * @param string $metadataKind The kind of metadata
     * @param string $fetch        Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Metadata|\Psr\Http\Message\ResponseInterface
     */
    public function getMetadata(string $serverId, string $zoneId, string $metadataKind, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetMetadata($serverId, $zoneId, $metadataKind), $fetch);
    }

    /**
     * Creates a set of metadata entries of given kind for the zone. Existing metadata entries for the zone with the same kind are removed.
     *
     * @param string                           $serverId     The id of the server to retrieve
     * @param string                           $metadataKind The kind of metadata
     * @param \App\PowerDns\Api\Model\Metadata $requestBody
     * @param string                           $fetch        Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Metadata|\Psr\Http\Message\ResponseInterface
     */
    public function modifyMetadata(string $serverId, string $zoneId, string $metadataKind, Model\Metadata $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ModifyMetadata($serverId, $zoneId, $metadataKind, $requestBody), $fetch);
    }

    /**
     * @param string $serverId The id of the server to retrieve
     * @param string $zoneId   The id of the zone to retrieve
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Cryptokey[]|\Psr\Http\Message\ResponseInterface
     */
    public function listCryptokeys(string $serverId, string $zoneId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListCryptokeys($serverId, $zoneId), $fetch);
    }

    /**
     * This method adds a new key to a zone. The key can either be generated or imported by supplying the content parameter. if content, bits and algo are null, a key will be generated based on the default-ksk-algorithm and default-ksk-size settings for a KSK and the default-zsk-algorithm and default-zsk-size options for a ZSK.
     *
     * @param string                            $serverId    The id of the server to retrieve
     * @param \App\PowerDns\Api\Model\Cryptokey $requestBody
     * @param string                            $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Cryptokey|\Psr\Http\Message\ResponseInterface
     */
    public function createCryptokey(string $serverId, string $zoneId, Model\Cryptokey $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\CreateCryptokey($serverId, $zoneId, $requestBody), $fetch);
    }

    /**
     * @param string $serverId    The id of the server to retrieve
     * @param string $zoneId      The id of the zone to retrieve
     * @param string $cryptokeyId The id value of the Cryptokey
     * @param string $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\DeleteCryptokeyUnprocessableEntityException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteCryptokey(string $serverId, string $zoneId, string $cryptokeyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\DeleteCryptokey($serverId, $zoneId, $cryptokeyId), $fetch);
    }

    /**
     * @param string $serverId    The id of the server to retrieve
     * @param string $zoneId      The id of the zone to retrieve
     * @param string $cryptokeyId The id value of the CryptoKey
     * @param string $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\App\PowerDns\Api\Model\Cryptokey|\Psr\Http\Message\ResponseInterface
     */
    public function getCryptokey(string $serverId, string $zoneId, string $cryptokeyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetCryptokey($serverId, $zoneId, $cryptokeyId), $fetch);
    }

    /**
     * @param string                            $serverId    The id of the server to retrieve
     * @param string                            $cryptokeyId Cryptokey to manipulate
     * @param \App\PowerDns\Api\Model\Cryptokey $requestBody
     * @param string                            $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\ModifyCryptokeyUnprocessableEntityException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function modifyCryptokey(string $serverId, string $zoneId, string $cryptokeyId, Model\Cryptokey $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ModifyCryptokey($serverId, $zoneId, $cryptokeyId, $requestBody), $fetch);
    }

    /**
     * @param string $serverId The id of the server
     * @param string $fetch    Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\ListTSIGKeysInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey[]|\Psr\Http\Message\ResponseInterface
     */
    public function listTSIGKeys(string $serverId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\ListTSIGKeys($serverId), $fetch);
    }

    /**
     * This methods add a new TSIGKey. The actual key can be generated by the server or be provided by the client
     *
     * @param string                          $serverId    The id of the server
     * @param \App\PowerDns\Api\Model\TSIGKey $requestBody
     * @param string                          $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\CreateTSIGKeyConflictException
     * @throws \App\PowerDns\Api\Exception\CreateTSIGKeyUnprocessableEntityException
     * @throws \App\PowerDns\Api\Exception\CreateTSIGKeyInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey|\Psr\Http\Message\ResponseInterface
     */
    public function createTSIGKey(string $serverId, Model\TSIGKey $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\CreateTSIGKey($serverId, $requestBody), $fetch);
    }

    /**
     * @param string $serverId  The id of the server to retrieve the key from
     * @param string $tsigkeyId The id of the TSIGkey. Should match the "id" field in the TSIGKey object
     * @param string $fetch     Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\DeleteTSIGKeyNotFoundException
     * @throws \App\PowerDns\Api\Exception\DeleteTSIGKeyInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteTSIGKey(string $serverId, string $tsigkeyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\DeleteTSIGKey($serverId, $tsigkeyId), $fetch);
    }

    /**
     * @param string $serverId  The id of the server to retrieve the key from
     * @param string $tsigkeyId The id of the TSIGkey. Should match the "id" field in the TSIGKey object
     * @param string $fetch     Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\GetTSIGKeyNotFoundException
     * @throws \App\PowerDns\Api\Exception\GetTSIGKeyInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey|\Psr\Http\Message\ResponseInterface
     */
    public function getTSIGKey(string $serverId, string $tsigkeyId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\GetTSIGKey($serverId, $tsigkeyId), $fetch);
    }

    /**
     * The TSIGKey at tsigkey_id can be changed in multiple ways:
     * Changing the Name, this will remove the key with tsigkey_id after adding.
     * Changing the Algorithm
     * Changing the Key
     *
     * @param string                          $serverId    The id of the server to retrieve the key from
     * @param string                          $tsigkeyId   The id of the TSIGkey. Should match the "id" field in the TSIGKey object
     * @param \App\PowerDns\Api\Model\TSIGKey $requestBody
     * @param string                          $fetch       Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \App\PowerDns\Api\Exception\PutTSIGKeyNotFoundException
     * @throws \App\PowerDns\Api\Exception\PutTSIGKeyInternalServerErrorException
     *
     * @return null|\App\PowerDns\Api\Model\TSIGKey|\Psr\Http\Message\ResponseInterface
     */
    public function putTSIGKey(string $serverId, string $tsigkeyId, Model\TSIGKey $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\PowerDns\Api\Endpoint\PutTSIGKey($serverId, $tsigkeyId, $requestBody), $fetch);
    }

    public static function create($httpClient = null, array $additionalPlugins = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('http://localhost/api/v1');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $serializer = new \Symfony\Component\Serializer\Serializer([new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \App\PowerDns\Api\Normalizer\JaneObjectNormalizer()], [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
