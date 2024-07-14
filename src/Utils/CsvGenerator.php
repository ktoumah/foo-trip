<?php

namespace App\Utils;


class CsvGenerator implements CsvGeneratorInterface
{
    public function generate(array $associativeArray, string $filePath, bool $useKeysForHeaderRow = true): string
    {
        if ($useKeysForHeaderRow)
            array_unshift($associativeArray, array_keys(reset($associativeArray)));

        $outputBuffer = fopen("$filePath.csv", 'w');
        fprintf($outputBuffer, chr(0xEF) . chr(0xBB) . chr(0xBF)); // Entete du fichier en UTF-8
        foreach ($associativeArray as $v) {
            fputcsv($outputBuffer, $v, ";");
        }
        fclose($outputBuffer);

        return "$filePath.csv";
    }
}