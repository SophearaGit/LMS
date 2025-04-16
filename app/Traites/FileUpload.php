<?php

namespace App\Traites;

use Illuminate\Http\UploadedFile;

trait FileUpload
{
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        $filename = 'educore_' . uniqid() . '.' . $file->getClientOriginalExtension();
        // move the file to storage
        $file->move(public_path($directory), $filename);
        return '/' . $directory . '/' . $filename;
    }

    public function deleteIfImageExist(string $path): bool
    {
        if (file_exists(public_path($path))) {
            return unlink(public_path($path));
        }
        return false;
    }
}
