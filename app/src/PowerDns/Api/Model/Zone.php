<?php

namespace App\PowerDns\Api\Model;

class Zone
{
    /**
     * Opaque zone id (string), assigned by the server, should not be interpreted by the application. Guaranteed to be safe for embedding in URLs.
     *
     * @var string
     */
    protected $id;
    /**
     * Name of the zone (e.g. “example.com.”) MUST have a trailing dot.
     *
     * @var string
     */
    protected $name;
    /**
     * Set to “Zone”.
     *
     * @var string
     */
    protected $type;
    /**
     * API endpoint for this zone.
     *
     * @var string
     */
    protected $url;
    /**
     * Zone kind, one of “Native”, “Master”, “Slave”.
     *
     * @var string
     */
    protected $kind;
    /**
     * RRSets in this zone (for zones/{zone_id} endpoint only; omitted during GET on the .../zones list endpoint).
     *
     * @var RRSet[]
     */
    protected $rrsets;
    /**
     * The SOA serial number.
     *
     * @var int
     */
    protected $serial;
    /**
     * The SOA serial notifications have been sent out for.
     *
     * @var int
     */
    protected $notifiedSerial;
    /**
     * The SOA serial as seen in query responses. Calculated using the SOA-EDIT metadata, default-soa-edit and default-soa-edit-signed settings.
     *
     * @var int
     */
    protected $editedSerial;
    /**
     *  List of IP addresses configured as a master for this zone (“Slave” type zones only).
     *
     * @var string[]
     */
    protected $masters;
    /**
     * Whether or not this zone is DNSSEC signed (inferred from presigned being true XOR presence of at least one cryptokey with active being true).
     *
     * @var bool
     */
    protected $dnssec;
    /**
     * The NSEC3PARAM record.
     *
     * @var string
     */
    protected $nsec3param;
    /**
     * Whether or not the zone uses NSEC3 narrow.
     *
     * @var bool
     */
    protected $nsec3narrow;
    /**
     * Whether or not the zone is pre-signed.
     *
     * @var bool
     */
    protected $presigned;
    /**
     * The SOA-EDIT metadata item.
     *
     * @var string
     */
    protected $soaEdit;
    /**
     * The SOA-EDIT-API metadata item.
     *
     * @var string
     */
    protected $soaEditApi;
    /**
     *  Whether or not the zone will be rectified on data changes via the API.
     *
     * @var bool
     */
    protected $apiRectify;
    /**
     * MAY contain a BIND-style zone file when creating a zone.
     *
     * @var string
     */
    protected $zone;
    /**
     * MAY be set. Its value is defined by local policy.
     *
     * @var string
     */
    protected $account;
    /**
     * MAY be sent in client bodies during creation, and MUST NOT be sent by the server. Simple list of strings of nameserver names, including the trailing dot. Not required for slave zones.
     *
     * @var string[]
     */
    protected $nameservers;
    /**
     * The id of the TSIG keys used for master operation in this zone.
     *
     * @var string[]
     */
    protected $masterTsigKeyIds;
    /**
     * The id of the TSIG keys used for slave operation in this zone.
     *
     * @var string[]
     */
    protected $slaveTsigKeyIds;

    /**
     * Opaque zone id (string), assigned by the server, should not be interpreted by the application. Guaranteed to be safe for embedding in URLs.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Opaque zone id (string), assigned by the server, should not be interpreted by the application. Guaranteed to be safe for embedding in URLs.
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Name of the zone (e.g. “example.com.”) MUST have a trailing dot.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Name of the zone (e.g. “example.com.”) MUST have a trailing dot.
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set to “Zone”.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set to “Zone”.
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * API endpoint for this zone.
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * API endpoint for this zone.
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Zone kind, one of “Native”, “Master”, “Slave”.
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * Zone kind, one of “Native”, “Master”, “Slave”.
     */
    public function setKind(string $kind): self
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * RRSets in this zone (for zones/{zone_id} endpoint only; omitted during GET on the .../zones list endpoint).
     *
     * @return RRSet[]
     */
    public function getRrsets(): array
    {
        return $this->rrsets;
    }

    /**
     * RRSets in this zone (for zones/{zone_id} endpoint only; omitted during GET on the .../zones list endpoint).
     *
     * @param RRSet[] $rrsets
     */
    public function setRrsets(array $rrsets): self
    {
        $this->rrsets = $rrsets;
        return $this;
    }

    /**
     * The SOA serial number.
     */
    public function getSerial(): int
    {
        return $this->serial;
    }

    /**
     * The SOA serial number.
     */
    public function setSerial(int $serial): self
    {
        $this->serial = $serial;
        return $this;
    }

    /**
     * The SOA serial notifications have been sent out for.
     */
    public function getNotifiedSerial(): int
    {
        return $this->notifiedSerial;
    }

    /**
     * The SOA serial notifications have been sent out for.
     */
    public function setNotifiedSerial(int $notifiedSerial): self
    {
        $this->notifiedSerial = $notifiedSerial;
        return $this;
    }

    /**
     * The SOA serial as seen in query responses. Calculated using the SOA-EDIT metadata, default-soa-edit and default-soa-edit-signed settings.
     */
    public function getEditedSerial(): int
    {
        return $this->editedSerial;
    }

    /**
     * The SOA serial as seen in query responses. Calculated using the SOA-EDIT metadata, default-soa-edit and default-soa-edit-signed settings.
     */
    public function setEditedSerial(int $editedSerial): self
    {
        $this->editedSerial = $editedSerial;
        return $this;
    }

    /**
     *  List of IP addresses configured as a master for this zone (“Slave” type zones only).
     *
     * @return string[]
     */
    public function getMasters(): array
    {
        return $this->masters;
    }

    /**
     *  List of IP addresses configured as a master for this zone (“Slave” type zones only).
     *
     * @param string[] $masters
     */
    public function setMasters(array $masters): self
    {
        $this->masters = $masters;
        return $this;
    }

    /**
     * Whether or not this zone is DNSSEC signed (inferred from presigned being true XOR presence of at least one cryptokey with active being true).
     */
    public function getDnssec(): bool
    {
        return $this->dnssec;
    }

    /**
     * Whether or not this zone is DNSSEC signed (inferred from presigned being true XOR presence of at least one cryptokey with active being true).
     */
    public function setDnssec(bool $dnssec): self
    {
        $this->dnssec = $dnssec;
        return $this;
    }

    /**
     * The NSEC3PARAM record.
     */
    public function getNsec3param(): string
    {
        return $this->nsec3param;
    }

    /**
     * The NSEC3PARAM record.
     */
    public function setNsec3param(string $nsec3param): self
    {
        $this->nsec3param = $nsec3param;
        return $this;
    }

    /**
     * Whether or not the zone uses NSEC3 narrow.
     */
    public function getNsec3narrow(): bool
    {
        return $this->nsec3narrow;
    }

    /**
     * Whether or not the zone uses NSEC3 narrow.
     */
    public function setNsec3narrow(bool $nsec3narrow): self
    {
        $this->nsec3narrow = $nsec3narrow;
        return $this;
    }

    /**
     * Whether or not the zone is pre-signed.
     */
    public function getPresigned(): bool
    {
        return $this->presigned;
    }

    /**
     * Whether or not the zone is pre-signed.
     */
    public function setPresigned(bool $presigned): self
    {
        $this->presigned = $presigned;
        return $this;
    }

    /**
     * The SOA-EDIT metadata item.
     */
    public function getSoaEdit(): string
    {
        return $this->soaEdit;
    }

    /**
     * The SOA-EDIT metadata item.
     */
    public function setSoaEdit(string $soaEdit): self
    {
        $this->soaEdit = $soaEdit;
        return $this;
    }

    /**
     * The SOA-EDIT-API metadata item.
     */
    public function getSoaEditApi(): string
    {
        return $this->soaEditApi;
    }

    /**
     * The SOA-EDIT-API metadata item.
     */
    public function setSoaEditApi(string $soaEditApi): self
    {
        $this->soaEditApi = $soaEditApi;
        return $this;
    }

    /**
     *  Whether or not the zone will be rectified on data changes via the API.
     */
    public function getApiRectify(): bool
    {
        return $this->apiRectify;
    }

    /**
     *  Whether or not the zone will be rectified on data changes via the API.
     */
    public function setApiRectify(bool $apiRectify): self
    {
        $this->apiRectify = $apiRectify;
        return $this;
    }

    /**
     * MAY contain a BIND-style zone file when creating a zone.
     */
    public function getZone(): string
    {
        return $this->zone;
    }

    /**
     * MAY contain a BIND-style zone file when creating a zone.
     */
    public function setZone(string $zone): self
    {
        $this->zone = $zone;
        return $this;
    }

    /**
     * MAY be set. Its value is defined by local policy.
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * MAY be set. Its value is defined by local policy.
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * MAY be sent in client bodies during creation, and MUST NOT be sent by the server. Simple list of strings of nameserver names, including the trailing dot. Not required for slave zones.
     *
     * @return string[]
     */
    public function getNameservers(): array
    {
        return $this->nameservers;
    }

    /**
     * MAY be sent in client bodies during creation, and MUST NOT be sent by the server. Simple list of strings of nameserver names, including the trailing dot. Not required for slave zones.
     *
     * @param string[] $nameservers
     */
    public function setNameservers(array $nameservers): self
    {
        $this->nameservers = $nameservers;
        return $this;
    }

    /**
     * The id of the TSIG keys used for master operation in this zone.
     *
     * @return string[]
     */
    public function getMasterTsigKeyIds(): array
    {
        return $this->masterTsigKeyIds;
    }

    /**
     * The id of the TSIG keys used for master operation in this zone.
     *
     * @param string[] $masterTsigKeyIds
     */
    public function setMasterTsigKeyIds(array $masterTsigKeyIds): self
    {
        $this->masterTsigKeyIds = $masterTsigKeyIds;
        return $this;
    }

    /**
     * The id of the TSIG keys used for slave operation in this zone.
     *
     * @return string[]
     */
    public function getSlaveTsigKeyIds(): array
    {
        return $this->slaveTsigKeyIds;
    }

    /**
     * The id of the TSIG keys used for slave operation in this zone.
     *
     * @param string[] $slaveTsigKeyIds
     */
    public function setSlaveTsigKeyIds(array $slaveTsigKeyIds): self
    {
        $this->slaveTsigKeyIds = $slaveTsigKeyIds;
        return $this;
    }
}
