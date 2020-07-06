<?php

namespace App\PowerDns\Api\Model;

class TSIGKey
{
    /**
     * The name of the key
     *
     * @var string
     */
    protected $name;
    /**
     * The ID for this key, used in the TSIGkey URL endpoint.
     *
     * @var string
     */
    protected $id;
    /**
     * The algorithm of the TSIG key
     *
     * @var string
     */
    protected $algorithm;
    /**
     * The Base64 encoded secret key, empty when listing keys. MAY be empty when POSTing to have the server generate the key material
     *
     * @var string
     */
    protected $key;
    /**
     * Set to "TSIGKey"
     *
     * @var string
     */
    protected $type;

    /**
     * The name of the key
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * The name of the key
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * The ID for this key, used in the TSIGkey URL endpoint.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * The ID for this key, used in the TSIGkey URL endpoint.
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * The algorithm of the TSIG key
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * The algorithm of the TSIG key
     */
    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * The Base64 encoded secret key, empty when listing keys. MAY be empty when POSTing to have the server generate the key material
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * The Base64 encoded secret key, empty when listing keys. MAY be empty when POSTing to have the server generate the key material
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Set to "TSIGKey"
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set to "TSIGKey"
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
