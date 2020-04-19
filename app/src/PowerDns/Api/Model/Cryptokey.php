<?php

namespace App\PowerDns\Api\Model;

class Cryptokey
{
    /**
     * set to "Cryptokey".
     *
     * @var string
     */
    protected $type;
    /**
     * The internal identifier, read only.
     *
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $keytype;
    /**
     * Whether or not the key is in active use.
     *
     * @var bool
     */
    protected $active;
    /**
     * Whether or not the DNSKEY record is published in the zone.
     *
     * @var bool
     */
    protected $published;
    /**
     * The DNSKEY record for this key.
     *
     * @var string
     */
    protected $dnskey;
    /**
     * An array of DS records for this key.
     *
     * @var string[]
     */
    protected $ds;
    /**
     * The private key in ISC format.
     *
     * @var string
     */
    protected $privatekey;
    /**
     * The name of the algorithm of the key, should be a mnemonic.
     *
     * @var string
     */
    protected $algorithm;
    /**
     * The size of the key.
     *
     * @var int
     */
    protected $bits;

    /**
     * set to "Cryptokey".
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * set to "Cryptokey".
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * The internal identifier, read only.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * The internal identifier, read only.
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getKeytype(): string
    {
        return $this->keytype;
    }

    public function setKeytype(string $keytype): self
    {
        $this->keytype = $keytype;
        return $this;
    }

    /**
     * Whether or not the key is in active use.
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether or not the key is in active use.
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Whether or not the DNSKEY record is published in the zone.
     */
    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * Whether or not the DNSKEY record is published in the zone.
     */
    public function setPublished(bool $published): self
    {
        $this->published = $published;
        return $this;
    }

    /**
     * The DNSKEY record for this key.
     */
    public function getDnskey(): string
    {
        return $this->dnskey;
    }

    /**
     * The DNSKEY record for this key.
     */
    public function setDnskey(string $dnskey): self
    {
        $this->dnskey = $dnskey;
        return $this;
    }

    /**
     * An array of DS records for this key.
     *
     * @return string[]
     */
    public function getDs(): array
    {
        return $this->ds;
    }

    /**
     * An array of DS records for this key.
     *
     * @param string[] $ds
     */
    public function setDs(array $ds): self
    {
        $this->ds = $ds;
        return $this;
    }

    /**
     * The private key in ISC format.
     */
    public function getPrivatekey(): string
    {
        return $this->privatekey;
    }

    /**
     * The private key in ISC format.
     */
    public function setPrivatekey(string $privatekey): self
    {
        $this->privatekey = $privatekey;
        return $this;
    }

    /**
     * The name of the algorithm of the key, should be a mnemonic.
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * The name of the algorithm of the key, should be a mnemonic.
     */
    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * The size of the key.
     */
    public function getBits(): int
    {
        return $this->bits;
    }

    /**
     * The size of the key.
     */
    public function setBits(int $bits): self
    {
        $this->bits = $bits;
        return $this;
    }
}
