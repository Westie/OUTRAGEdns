<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class CreateTSIGKeyUnprocessableEntityException extends RuntimeException implements ClientException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Unprocessable Entry, the TSIGKey provided has issues.', 422);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
