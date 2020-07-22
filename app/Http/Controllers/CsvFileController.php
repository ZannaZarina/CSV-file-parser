<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileRequest;
use App\Services\FileService;
use App\Services\CsvFileParser;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvFileController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }

    public function fileUpload(Request $request):StreamedResponse
    {
        $csvFiles = $request->file('file');
        $fileService = new FileService(new CsvFileParser);
        $fileRequest = new FileRequest($csvFiles);
        $fileResponse = $fileService->execute($fileRequest);
        $result = $fileResponse->getResult();

        return response()->streamDownload(function () use ($result) {
            $outputFile = fopen('php://output', 'w');
            foreach ($result as $row) {
                fputcsv($outputFile, $row);
            }
            fclose($outputFile);
        }, 'finalCsv.csv');
    }
}
