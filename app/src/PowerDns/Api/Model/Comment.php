<?php

namespace App\PowerDns\Api\Model;

class Comment
{
    /**
     * The actual comment
     *
     * @var string
     */
    protected $content;
    /**
     * Name of an account that added the comment
     *
     * @var string
     */
    protected $account;
    /**
     * Timestamp of the last change to the comment
     *
     * @var int
     */
    protected $modifiedAt;

    /**
     * The actual comment
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * The actual comment
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Name of an account that added the comment
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Name of an account that added the comment
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Timestamp of the last change to the comment
     */
    public function getModifiedAt(): int
    {
        return $this->modifiedAt;
    }

    /**
     * Timestamp of the last change to the comment
     */
    public function setModifiedAt(int $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }
}
