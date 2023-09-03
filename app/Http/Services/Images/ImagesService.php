<?php

namespace App\Http\Services\Images;



class ImagesService
{
    private static array $register = [
        'image/png' => FromPngToWebpConverter::class,
        'image/jpeg' => FromJpegToWebpConverter::class,
    ];

    public static function convertImage(string $pathImage, string $disk = null): string|bool
    {
        $data = getimagesize($pathImage);
        if(array_key_exists($data['mime'], self::$register)) {
            return self::$register[$data['mime']]::toWebp($pathImage, $disk);
        }
        return false;
    }

}
