<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $nick
 * @property float $win_rate
 * @property int $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Player extends BaseModel
{
    protected $table = 'players';

    protected $fillable = [
        'id',
        'nick',
        'win_rate',
        'position',
    ];

    protected $casts = [
        'win_rate' => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setHero(string $hero): void
    {
        $this->attributes['hero'] = $hero;
    }
}
