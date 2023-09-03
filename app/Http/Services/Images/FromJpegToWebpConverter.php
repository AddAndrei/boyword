<?php

namespace App\Http\Services\Images;

use App\Http\Interfaces\ConvertImages\IConvertable;


class FromJpegToWebpConverter implements IConvertable
{

    public static function toWebp(string $image, string $newPath = null): string|bool
    {
        $jpeg = @imagecreatefromjpeg($image);
        $newPath .= str_replace('jpg', 'webp', basename($image));
        imagewebp($jpeg, $newPath);
        return $newPath;
    }
}
