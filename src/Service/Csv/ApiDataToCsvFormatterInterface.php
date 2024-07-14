<?php

namespace App\Service\Csv;


interface ApiDataToCsvFormatterInterface
{
    /**
     * Format /api/destination API to requested test format
     *
     * @param array $destinations
     * @return array
     */
    public function fromDestinationToCsvFormat(array $destinations): array;
}