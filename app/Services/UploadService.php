<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class UploadService
{
public function uploadImage(UploadedFile $uploadedFile):string
{
    $path = $uploadedFile->storeAs('news', $uploadedFile->hashName(), 'public');
    if ($path === false){
        throw new UploadException('file was not upload');
    }
    return $path;
}
}
