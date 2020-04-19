<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class CreateTSIGKeyInternalServerErrorException extends RuntimeException implements ServerException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Internal Server Error. There was a problem creating the key', 500);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
