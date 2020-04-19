<?php

namespace App\PowerDns\Api\Model;

class CacheFlushResult
{
    /**
     * Amount of entries flushed.
     *
     * @var float
     */
    protected $count;
    /**
     * A message about the result like "Flushed cache".
     *
     * @var string
     */
    protected $result;

    /**
     * Amount of entries flushed.
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * Amount of entries flushed.
     */
    public function setCount(float $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * A message about the result like "Flushed cache".
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * A message about the result like "Flushed cache".
     */
    public function setResult(string $result): self
    {
        $this->result = $result;
        return $this;
    }
}
