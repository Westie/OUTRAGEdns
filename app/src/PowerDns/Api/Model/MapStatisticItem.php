<?php

namespace App\PowerDns\Api\Model;

class MapStatisticItem
{
    /**
     * Item name
     *
     * @var string
     */
    protected $name;
    /**
     * Set to "MapStatisticItem"
     *
     * @var string
     */
    protected $type;
    /**
     * Named values
     *
     * @var SimpleStatisticItem[]
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
     * Set to "MapStatisticItem"
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set to "MapStatisticItem"
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Named values
     *
     * @return SimpleStatisticItem[]
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * Named values
     *
     * @param SimpleStatisticItem[] $value
     */
    public function setValue(array $value): self
    {
        $this->value = $value;
        return $this;
    }
}
