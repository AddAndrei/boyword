<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $win_hero
 * @property string $lose_hero
 * @property float $win_rate
 * @property int $matches
 * @property int $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Pick extends BaseModel
{
    protected $table = 'pickes';

    protected $fillable = [
        'id',
        'win_hero',
        'lose_hero',
        'win_rate',
        'matches',
        'position',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'win_rate' => 'float',
    ];
}
