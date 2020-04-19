<?php

namespace App\PowerDns\Api\Model;

class Error
{
    /**
     * A human readable error message.
     *
     * @var string
     */
    protected $error;
    /**
     * Optional array of multiple errors encountered during processing.
     *
     * @var string[]
     */
    protected $errors;

    /**
     * A human readable error message.
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * A human readable error message.
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }

    /**
     * Optional array of multiple errors encountered during processing.
     *
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Optional array of multiple errors encountered during processing.
     *
     * @param string[] $errors
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
}
