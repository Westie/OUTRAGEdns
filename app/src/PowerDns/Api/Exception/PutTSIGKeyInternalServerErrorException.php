<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class PutTSIGKeyInternalServerErrorException extends RuntimeException implements ServerException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Internal Server Error. Contains error message', 500);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
