<?php

namespace App\Exception;

use Exception;

class ApiResponseException extends Exception
{
    public function __construct($message)
    {
        parent::__construct("API error exception: " . $message);
    }
}