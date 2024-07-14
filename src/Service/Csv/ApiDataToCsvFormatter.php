<?php

namespace App\Service\Csv;

class ApiDataToCsvFormatter implements ApiDataToCsvFormatterInterface
{
    public function fromDestinationToCsvFormat(array $destinations): array
    {
        $output = [];
        foreach ($destinations as $destination) {
            $output[] = [
                'name' => $destination['name'],
                'description' => $destination['description'],
                'price' => $destination['price'],
                'duration' => $this->concatDuration($destination['duration'])
            ];
        }

        return $output;
    }

    /**
     * Concatenate duration to requested test format
     *
     * @param string|null $duration
     * @return string
     */
    public function concatDuration(string $duration = null): string
    {
        return $duration <= 1 ? $duration . ' day' : $duration . ' days';
    }
}