<?php

namespace App\PowerDns\Api\Model;

class Server
{
    /**
     * Set to “Server”
     *
     * @var string
     */
    protected $type;
    /**
     * The id of the server, “localhost”
     *
     * @var string
     */
    protected $id;
    /**
     * “recursor” for the PowerDNS Recursor and “authoritative” for the Authoritative Server
     *
     * @var string
     */
    protected $daemonType;
    /**
     * The version of the server software
     *
     * @var string
     */
    protected $version;
    /**
     * The API endpoint for this server
     *
     * @var string
     */
    protected $url;
    /**
     * The API endpoint for this server’s configuration
     *
     * @var string
     */
    protected $configUrl;
    /**
     * The API endpoint for this server’s zones
     *
     * @var string
     */
    protected $zonesUrl;

    /**
     * Set to “Server”
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set to “Server”
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * The id of the server, “localhost”
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * The id of the server, “localhost”
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * “recursor” for the PowerDNS Recursor and “authoritative” for the Authoritative Server
     */
    public function getDaemonType(): string
    {
        return $this->daemonType;
    }

    /**
     * “recursor” for the PowerDNS Recursor and “authoritative” for the Authoritative Server
     */
    public function setDaemonType(string $daemonType): self
    {
        $this->daemonType = $daemonType;
        return $this;
    }

    /**
     * The version of the server software
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * The version of the server software
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * The API endpoint for this server
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * The API endpoint for this server
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * The API endpoint for this server’s configuration
     */
    public function getConfigUrl(): string
    {
        return $this->configUrl;
    }

    /**
     * The API endpoint for this server’s configuration
     */
    public function setConfigUrl(string $configUrl): self
    {
        $this->configUrl = $configUrl;
        return $this;
    }

    /**
     * The API endpoint for this server’s zones
     */
    public function getZonesUrl(): string
    {
        return $this->zonesUrl;
    }

    /**
     * The API endpoint for this server’s zones
     */
    public function setZonesUrl(string $zonesUrl): self
    {
        $this->zonesUrl = $zonesUrl;
        return $this;
    }
}
