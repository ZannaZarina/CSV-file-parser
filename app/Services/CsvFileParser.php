<?php

namespace App\Services;

class CsvFileParser implements FileParserInterface
{
    public function handle(array $csvFiles)
    {
        foreach ($csvFiles as $file) { // Iterating through each uploaded CSV file
            // with a purpose to parse a CSV string into an array, remove unwanted spaces,
            // separate headers from content.

            $csvFileToArray = array_map(function ($file) {
                return str_getcsv($file, ",");
            }, file($file));

            foreach ($csvFileToArray as $key => $row) {
                $csvFileToArray[$key] = array_map(function ($row) {
                    return trim($row);
                }, $row);
            }

            $allHeaders[] = array_shift($csvFileToArray);
            $contents[] = $csvFileToArray;
        }

        $headers = [];

        foreach ($allHeaders as $key => $header) { // collate header values (keys) with contents values (values)
            foreach ($contents[$key] as $item) {
                $combinedArray[] = array_combine($header, $item);
            }

            foreach ($header as $value) { //create an array with non-repetitive header values
                // and an array where values become keys
                if (!in_array($value, $headers)) {
                    $headers[] = $value;
                }
            }
            $flipHeaders = array_flip($headers);
        }

        foreach ($combinedArray as $element) { // check if specific header exists in specific CSV file.
            // if yes, value is assigned as it was given in CSV file, if not - as empty one.
            // Unique headers and each created row get passed to the array with resulting data.
            foreach ($flipHeaders as $key => $value) {
                if (array_key_exists($key, $element)) {
                    $finalRow [] = $element[$key];
                } else {
                    $finalRow [] = '“”';
                }
            }
            $finalData[] = $finalRow;
            $finalRow = [];
        }
        array_unshift($finalData, $headers);

        return $finalData;
    }
}
