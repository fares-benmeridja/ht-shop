<?php
namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

Trait FileManagement
{

    /**
     * @param $file
     * @param $oldfile
     * @param $link
     * @param string $disk
     * @return Response
     */
    public function updateFile($file, $oldfile, $link, $disk='public')
    {
        if (!$file->isValid())
            return null;

        Storage::disk($disk)->delete($oldfile);
        return $file->store($link, $disk);
    }

    /**
     * @param array|string $file
     * @param string $disk
     */
    public function deleteFile($file, $disk = "public")
    {
        Storage::disk($disk)->delete($file);
    }
}