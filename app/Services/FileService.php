<?php

namespace App\Services;

class FileService
{
    private FileParserInterface $fileParser;

    public function __construct(FileParserInterface $fileParser)
    {
        $this->fileParser = $fileParser;
    }

    public function execute(FileRequest $fileRequest): FileResponse
    {
        $result = $this->fileParser->handle($fileRequest->getfiles());

        return new FileResponse($result);
    }
}
