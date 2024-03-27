<?php

namespace App\Models\Clans;

use App\Models\BaseModel;
use App\Models\Hero\Hero;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HeroesInClan
 * @package App\Models\Clans
 * @property Hero $hero
 * @property Clan $clan
 * @author Shcerbakov Andrei
 */
class HeroesInClan extends BaseModel
{
    protected $table = 'clan_heroes';
    public $timestamps = false;
    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class, 'clan_id');
    }
}
