<?php

namespace App\Services;

class FileRequest
{
    private array $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}
