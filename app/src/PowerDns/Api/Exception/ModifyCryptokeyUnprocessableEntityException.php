<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class ModifyCryptokeyUnprocessableEntityException extends RuntimeException implements ClientException
{
    public function __construct()
    {
        parent::__construct('Returned when something is wrong with the content of the request. Contains an error message', 422);
    }
}
