<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class GetTSIGKeyNotFoundException extends RuntimeException implements ClientException
{
    private $error;

    public function __construct(\App\PowerDns\Api\Model\Error $error)
    {
        parent::__construct('Not found. The TSIGKey with the specified tsigkey_id does not exist', 404);
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
