<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    private string $disk;

    public function __construct(string $disk = 'public')
    {
        $this->disk = $disk;
    }

    public function upload($file, string $directory): string
    {
        $extension = $file->getClientOriginalExtension();

        $filename = Str::uuid()->toString() . '.' . $extension;

        $path = $file->storeAs($directory, $filename, $this->disk);

        return $filename;
    }

    public function delete(string $filename, string $directory): bool
    {
        $path = sprintf('%s/%s', $directory, $filename);

        if (Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }

        return false;
    }
}
