<?php

namespace App\Models\Hero;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Hero
 * @package App\Models\Hero
 * @property string $name
 * @property int $min_damage
 * @property int $max_damage
 * @property int $health_points
 * @property int $mana_points
 * @property string $weapon
 * @property string $hero_class
 * @property int $user_id
 *
 * @property User $user
 * @author Shcerbakov Andrei
 */
class Hero extends BaseModel
{
    protected $table = 'heroes';

    protected $fillable = [
        'name',
        'min_damage',
        'max_damage',
        'health_points',
        'mana_points',
        'weapon',
        'hero_class',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
