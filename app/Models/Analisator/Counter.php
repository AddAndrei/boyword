<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $hero_id
 * @property string $vs_hero
 * @property float $win_rate
 * @property int $matches
 * @property string|null $hero_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Counter extends BaseModel
{
    protected $table = 'countres';

    protected $fillable = [
        'id',
        'hero_id',
        'vs_hero',
        'win_rate',
        'matches',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'win_rate' => 'float',
    ];
}
