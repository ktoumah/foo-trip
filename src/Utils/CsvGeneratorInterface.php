<?php

namespace App\Utils;

interface CsvGeneratorInterface
{
    /**
     * This is a CSV generator code that can be used in all the project
     *
     * @param array $associativeArray
     * @param string $filePath
     * @param bool $useKeysForHeaderRow
     * @return string
     */
    public function generate(array $associativeArray, string $filePath): string;
}