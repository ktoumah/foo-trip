<?php

namespace App\Exception\FooTrip;

use Exception;

class FooTripResponseException extends Exception
{
    public function __construct(Exception $exception)
    {
        parent::__construct(
            "Error when calling Foo Trip API :" . $exception->getMessage(),
            $exception->getCode()
        );
    }
}
