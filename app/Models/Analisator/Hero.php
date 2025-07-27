<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property float $win_rate
 * @property string $aspect
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Hero extends BaseModel
{
    protected $table = 'heroes';

    protected $fillable = [
        'id',
        'title',
        'win_rate',
        'aspect',
        'url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'win_rate' => 'float',
    ];
}

