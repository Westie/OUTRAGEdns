<?php

namespace App\PowerDns\Api\Model;

class ConfigSetting
{
    /**
     * set to "ConfigSetting".
     *
     * @var string
     */
    protected $name;
    /**
     * The name of this setting (e.g. ‘webserver-port’).
     *
     * @var string
     */
    protected $type;
    /**
     * The value of setting name.
     *
     * @var string
     */
    protected $value;

    /**
     * set to "ConfigSetting".
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * set to "ConfigSetting".
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * The name of this setting (e.g. ‘webserver-port’).
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * The name of this setting (e.g. ‘webserver-port’).
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * The value of setting name.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * The value of setting name.
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
