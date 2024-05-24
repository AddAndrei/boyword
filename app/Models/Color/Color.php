<?php

namespace App\Models\Color;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Color extends BaseModel
{
    protected $table = 'colors';

    protected $fillable = [
        'title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
