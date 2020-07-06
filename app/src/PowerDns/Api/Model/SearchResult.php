<?php

namespace App\PowerDns\Api\Model;

class SearchResult
{
    /**
     * @var string
     */
    protected $content;
    /**
     * @var bool
     */
    protected $disabled;
    /**
     * @var string
     */
    protected $name;
    /**
     * set to one of "record, zone, comment"
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
    /**
     * @var string
     */
    protected $type;
    /**
     * @var int
     */
    protected $ttl;

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
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
     * set to one of "record, zone, comment"
     */
    public function getObjectType(): string
    {
        return $this->objectType;
    }

    /**
     * set to one of "record, zone, comment"
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function setTtl(int $ttl): self
    {
        $this->ttl = $ttl;
        return $this;
    }
}
