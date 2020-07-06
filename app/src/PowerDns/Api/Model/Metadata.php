<?php

namespace App\PowerDns\Api\Model;

class Metadata
{
    /**
     * Name of the metadata
     *
     * @var string
     */
    protected $kind;
    /**
     * Array with all values for this metadata kind.
     *
     * @var string[]
     */
    protected $metadata;

    /**
     * Name of the metadata
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * Name of the metadata
     */
    public function setKind(string $kind): self
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * Array with all values for this metadata kind.
     *
     * @return string[]
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * Array with all values for this metadata kind.
     *
     * @param string[] $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }
}
