<?php

namespace App\Services;
/**
 * Writes data to CSV.
 * Class CSVWriter
 * @package App\Services
 */
class CSVWriter
{
    public static function writer($file, $data = [])
    {
        $file = fopen($file, 'w');
        $headers = array_keys($data[0]);
        fputcsv($file, $headers);

        foreach ($data as $item){
            fputcsv($file, $item);
        }
        fclose($file);
    }
}
