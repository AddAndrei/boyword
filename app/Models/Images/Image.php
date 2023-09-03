<?php

namespace App\Models\Images;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class Image
 * @package App\Models\Images
 * @property int $id
 * @property string $url
 * @property string $name
 * @property string $storage
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @author Shcerbakov Andrei
 */
class Image extends BaseModel
{
    protected $table = 'images';

    /** @var string */
    private const DEFAULT_DISK = 'time';

    protected $fillable = [
        'url',
        'name',
        'storage',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'storage' => self::DEFAULT_DISK,
    ];
}
