<?php

namespace App\Utils;


class JsonResponseFormatter implements JsonResponseFormatterInterface
{
    public function formatResponse($message = null, $data = []): array
    {
        return [
            'message' => $message,
            'data' => $data,
        ];
    }
}