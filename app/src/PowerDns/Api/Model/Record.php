<?php

namespace App\PowerDns\Api\Model;

class Record
{
    /**
     * The content of this record.
     *
     * @var string
     */
    protected $content;
    /**
     * Whether or not this record is disabled. When unset, the record is not disabled.
     *
     * @var bool
     */
    protected $disabled;
    /**
     * If set to true, the server will find the matching reverse zone and create a PTR there. Existing PTR records are replaced. If no matching reverse Zone, an error is thrown. Only valid in client bodies, only valid for A and AAAA types. Not returned by the server. This feature is deprecated and will be removed in 4.3.0.
     *
     * @var bool
     */
    protected $setPtr;

    /**
     * The content of this record.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * The content of this record.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Whether or not this record is disabled. When unset, the record is not disabled.
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Whether or not this record is disabled. When unset, the record is not disabled.
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * If set to true, the server will find the matching reverse zone and create a PTR there. Existing PTR records are replaced. If no matching reverse Zone, an error is thrown. Only valid in client bodies, only valid for A and AAAA types. Not returned by the server. This feature is deprecated and will be removed in 4.3.0.
     */
    public function getSetPtr(): bool
    {
        return $this->setPtr;
    }

    /**
     * If set to true, the server will find the matching reverse zone and create a PTR there. Existing PTR records are replaced. If no matching reverse Zone, an error is thrown. Only valid in client bodies, only valid for A and AAAA types. Not returned by the server. This feature is deprecated and will be removed in 4.3.0.
     */
    public function setSetPtr(bool $setPtr): self
    {
        $this->setPtr = $setPtr;
        return $this;
    }
}
