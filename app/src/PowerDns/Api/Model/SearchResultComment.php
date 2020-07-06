<?php

namespace App\PowerDns\Api\Model;

class SearchResultComment
{
    /**
     * @var string
     */
    protected $content;
    /**
     * @var string
     */
    protected $name;
    /**
     * set to "comment"
     *
     * @var string
     */
    protected $objectType;
    /**
     * @var string
     */
    protected $zoneId;
    /**
     * @var string
     */
    protected $zone;

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

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
     * set to "comment"
     */
    public function getObjectType(): string
    {
        return $this->objectType;
    }

    /**
     * set to "comment"
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

    public function getZone(): string
    {
        return $this->zone;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;
        return $this;
    }
}
