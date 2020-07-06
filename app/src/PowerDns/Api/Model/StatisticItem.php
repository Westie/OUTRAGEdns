<?php

namespace App\PowerDns\Api\Model;

class StatisticItem
{
    /**
     * Item name
     *
     * @var string
     */
    protected $name;
    /**
     * set to "StatisticItem"
     *
     * @var string
     */
    protected $type;
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
     * set to "StatisticItem"
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * set to "StatisticItem"
     */
    public function setType(string $type): self
    {
        $this->type = $type;
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
