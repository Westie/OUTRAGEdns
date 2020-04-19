<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class GetTSIGKeyInternalServerErrorException extends RuntimeException implements ServerException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Internal Server Error, keys could not be retrieved. Contains error message', 500);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
