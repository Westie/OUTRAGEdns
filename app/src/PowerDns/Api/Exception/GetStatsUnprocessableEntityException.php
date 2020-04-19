<?php

namespace App\PowerDns\Api\Exception;

use RuntimeException;

class GetStatsUnprocessableEntityException extends RuntimeException implements ClientException
{
    public function __construct()
    {
        parent::__construct('Returned when a non-existing statistic name has been requested. Contains an error message', 422);
    }
}
