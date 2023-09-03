<?php

namespace App\Http\Interfaces\ConvertImages;

interface IConvertable
{
    public static function toWebp(string $image, string $newPath = null): string|bool;
}
