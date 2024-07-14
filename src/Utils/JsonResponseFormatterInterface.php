<?php

namespace App\Utils;


interface JsonResponseFormatterInterface
{
    /**
     * Format all API responses to have a unique format for all the APIs in this project
     *
     * @param $message
     * @param $data
     * @return array
     */
    public function formatResponse($message = null, $data = []): array;
}