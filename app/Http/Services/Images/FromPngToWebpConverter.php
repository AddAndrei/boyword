<?php

namespace App\Http\Services\Images;

use App\Http\Interfaces\ConvertImages\IConvertable;

class FromPngToWebpConverter implements IConvertable
{

    public static function toWebp(string $image, string $newPath = null): string|bool
    {
        $png = @imagecreatefrompng($image);
        $newPath .= str_replace('png', 'webp', basename($image));
        imagepalettetotruecolor($png);
        imagealphablending($png, true);
        imagesavealpha($png, true);
        imagewebp($png, $newPath);
        return $newPath;
    }
}
