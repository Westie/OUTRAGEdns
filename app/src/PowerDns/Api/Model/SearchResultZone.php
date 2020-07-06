<?php

namespace App\PowerDns\Api\Model;

class SearchResultZone
{
    /**
     * @var string
     */
    protected $name;
    /**
     * set to "zone"
     *
     * @var string
     */
    protected $objectType;
    /**
     * @var string
     */
    protected $zoneId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * set to "zone"
     */
    public function getObjectType(): string
    {
        return $this->objectType;
    }

    /**
     * set to "zone"
     */
    public function setObjectType(string $objectType): self
    {
        $this->objectType = $objectType;
        return $this;
    }

    public function getZoneId(): string
    {
        return $this->zoneId;
    }

    public function setZoneId(string $zoneId): self
    {
        $this->zoneId = $zoneId;
        return $this;
    }
}
