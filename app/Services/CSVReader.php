<?php

namespace App\Services;

/**
 * Reads Data from CSV and returns as an array.
 * Class CSVReader
 * @package App\Services
 */
class CSVReader
{
    public static function reader($file)
    {
        $file = fopen($file, 'r');
        $output = [];
        $header = true;
        while (($line = fgetcsv($file, 0)) !== FALSE) {
            if(!$header) {
                $output[] = $line;
            }
            $header = false;
        }
        fclose($file);
        return $output;
    }
}
