<?php

namespace App\PowerDns\Api\Model;

class RRSet
{
    /**
     * Name for record set (e.g. “www.powerdns.com.”)
     *
     * @var string
     */
    protected $name;
    /**
     * Type of this record (e.g. “A”, “PTR”, “MX”)
     *
     * @var string
     */
    protected $type;
    /**
     * DNS TTL of the records, in seconds. MUST NOT be included when changetype is set to “DELETE”.
     *
     * @var int
     */
    protected $ttl;
    /**
     * MUST be added when updating the RRSet. Must be REPLACE or DELETE. With DELETE, all existing RRs matching name and type will be deleted, including all comments. With REPLACE: when records is present, all existing RRs matching name and type will be deleted, and then new records given in records will be created. If no records are left, any existing comments will be deleted as well. When comments is present, all existing comments for the RRs matching name and type will be deleted, and then new comments given in comments will be created.
     *
     * @var string
     */
    protected $changetype;
    /**
     * All records in this RRSet. When updating Records, this is the list of new records (replacing the old ones). Must be empty when changetype is set to DELETE. An empty list results in deletion of all records (and comments).
     *
     * @var Record[]
     */
    protected $records;
    /**
     * List of Comment. Must be empty when changetype is set to DELETE. An empty list results in deletion of all comments. modified_at is optional and defaults to the current server time.
     *
     * @var Comment[]
     */
    protected $comments;

    /**
     * Name for record set (e.g. “www.powerdns.com.”)
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Name for record set (e.g. “www.powerdns.com.”)
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Type of this record (e.g. “A”, “PTR”, “MX”)
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Type of this record (e.g. “A”, “PTR”, “MX”)
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * DNS TTL of the records, in seconds. MUST NOT be included when changetype is set to “DELETE”.
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * DNS TTL of the records, in seconds. MUST NOT be included when changetype is set to “DELETE”.
     */
    public function setTtl(int $ttl): self
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * MUST be added when updating the RRSet. Must be REPLACE or DELETE. With DELETE, all existing RRs matching name and type will be deleted, including all comments. With REPLACE: when records is present, all existing RRs matching name and type will be deleted, and then new records given in records will be created. If no records are left, any existing comments will be deleted as well. When comments is present, all existing comments for the RRs matching name and type will be deleted, and then new comments given in comments will be created.
     */
    public function getChangetype(): string
    {
        return $this->changetype;
    }

    /**
     * MUST be added when updating the RRSet. Must be REPLACE or DELETE. With DELETE, all existing RRs matching name and type will be deleted, including all comments. With REPLACE: when records is present, all existing RRs matching name and type will be deleted, and then new records given in records will be created. If no records are left, any existing comments will be deleted as well. When comments is present, all existing comments for the RRs matching name and type will be deleted, and then new comments given in comments will be created.
     */
    public function setChangetype(string $changetype): self
    {
        $this->changetype = $changetype;
        return $this;
    }

    /**
     * All records in this RRSet. When updating Records, this is the list of new records (replacing the old ones). Must be empty when changetype is set to DELETE. An empty list results in deletion of all records (and comments).
     *
     * @return Record[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    /**
     * All records in this RRSet. When updating Records, this is the list of new records (replacing the old ones). Must be empty when changetype is set to DELETE. An empty list results in deletion of all records (and comments).
     *
     * @param Record[] $records
     */
    public function setRecords(array $records): self
    {
        $this->records = $records;
        return $this;
    }

    /**
     * List of Comment. Must be empty when changetype is set to DELETE. An empty list results in deletion of all comments. modified_at is optional and defaults to the current server time.
     *
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * List of Comment. Must be empty when changetype is set to DELETE. An empty list results in deletion of all comments. modified_at is optional and defaults to the current server time.
     *
     * @param Comment[] $comments
     */
    public function setComments(array $comments): self
    {
        $this->comments = $comments;
        return $this;
    }
}
