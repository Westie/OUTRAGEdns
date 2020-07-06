<?php

namespace App\Driver;

use App\PowerDns\Api\Model\Zone;
use Psr\Container\ContainerInterface;

interface DriverInterface
{
    /**
     *  Construct driver
     */
    public function __construct(ContainerInterface $container);

    /**
     *  List zones, taking into account any rights issues (if required)
     */
    public function listZones(string $serverId, array $arguments = []): ResultCollection;

    /**
     *  List one particular zone
     */
    public function listZone(string $serverId, string $zoneId): Zone;

    /**
     *  Update a zone
     */
    public function putZone(string $serverId, string $zoneId, Zone $requestBody);
}
