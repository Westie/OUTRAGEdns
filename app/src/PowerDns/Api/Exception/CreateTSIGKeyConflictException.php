<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class CreateTSIGKeyConflictException extends RuntimeException implements ClientException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Conflict. A key with this name already exists', 409);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
