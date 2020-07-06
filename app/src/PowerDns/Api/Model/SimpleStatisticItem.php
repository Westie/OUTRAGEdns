<?php

namespace App\PowerDns\Api\Model;

class SimpleStatisticItem
{
    /**
     * Item name
     *
     * @var string
     */
    protected $name;
    /**
     * Item value
     *
     * @var string
     */
    protected $value;

    /**
     * Item name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Item name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Item value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Item value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
