<?php

namespace App\PowerDns\Api\Model;

class RingStatisticItem
{
    /**
     * Item name
     *
     * @var string
     */
    protected $name;
    /**
     * Set to "RingStatisticItem"
     *
     * @var string
     */
    protected $type;
    /**
     * Ring size
     *
     * @var int
     */
    protected $size;
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
     * Set to "RingStatisticItem"
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set to "RingStatisticItem"
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Ring size
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Ring size
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
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
