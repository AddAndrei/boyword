<?php

namespace App\Http\Controllers\YandexDisk;

use App\Api\YandexDisk;
use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadImageRequest;
use Illuminate\Http\UploadedFile;

class YandexDiskController extends Controller
{

    private YandexDisk $disk;

    public function __construct(YandexDisk $disk)
    {
        $this->disk = $disk;
    }

    public function index(UploadImageRequest $request): mixed
    {
        //return $this->disk->publicResource("Adds/php58AB.tmp");
        return $this->disk->getFolderInfo("disk:/Adds/php58AB.tmp");
        //dd($request->file('files'));
        foreach ($request->file('files') as $file) {
            /**@var $file UploadedFile */
            $filePath = $file->getPath(). '/' . $file->getBasename();
            return $this->disk->upload($file->getBasename(), $filePath);
        }
        //return $this->disk->getFolderInfo();
        //return $this->disk->createFolder("/Adds/test");
        //return $this->disk->diskGetInfo();
        return [];
    }
}
