<?php

namespace App\Http\Services\Image;

use App\Http\Services\Image\FromJpegToWebpConverter;
use App\Models\BaseModel;
use App\Models\Image\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ImagesService
{
    private static array $register = [
        'image/png' => FromPngToWebpConverter::class,
        'image/jpeg' => FromJpegToWebpConverter::class,
    ];

    public static function convertImage(string $pathImage, string $disk = null): string|bool
    {
        $data = getimagesize($pathImage);
        if (array_key_exists($data['mime'], self::$register)) {
            return self::$register[$data['mime']]::toWebp($pathImage, $disk);
        }
        return false;
    }

    public static function createImages(array $images, BaseModel $model): void
    {
        foreach ($images as $image) {
            /** @var  UploadedFile $image */
            $imageName = Storage::disk('time')->put('', $image);
            $path = Storage::disk('time')->path('');
            $path .= $imageName;
            $newPath = str_replace("storage", "", storage_path("public/images/time/"));
            $imageWebp = self::convertImage($path, $newPath);
            Storage::disk('time')->delete($imageName);
            $webpName = last(explode('/', $imageWebp));
            $fullPath = env('APP_URL') . '/public/images/time/' . $webpName;
            $entityImage = new Image();
            $entityImage->url = $fullPath;
            $entityImage->add()->associate($model);
            $entityImage->save();
        }
    }
}
