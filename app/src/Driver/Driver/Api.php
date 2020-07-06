<?php

namespace App\Driver\Driver;

use App\Driver\DriverInterface;
use App\Driver\ResultCollection;
use App\PowerDns\Api\Client;
use App\PowerDns\Api\Model\Zone;
use Psr\Container\ContainerInterface;

class Api implements DriverInterface
{
    /**
     *  Store container
     */
    private $container;

    /**
     *  Construct driver
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *  List zones, taking into account any rights issues (if required)
     */
    public function listZones(string $serverId, array $arguments = []): ResultCollection
    {
        return new ResultCollection($this->container->get(Client::class)->listZones($serverId, $arguments));
    }

    /**
     *  List one particular zone
     */
    public function listZone(string $serverId, string $zoneId): Zone
    {
        return $this->container->get(Client::class)->listZone($serverId, $zoneId);
    }

    /**
     *  Update a zone
     */
    public function putZone(string $serverId, string $zoneId, Zone $requestBody)
    {
        dd(3, $this->container->get(Client::class)->putZone($serverId, $zoneId, $requestBody));
    }
}
