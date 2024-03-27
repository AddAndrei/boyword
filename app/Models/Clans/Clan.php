<?php

namespace App\Models\Clans;

use App\Models\BaseModel;
use App\Models\Hero\Hero;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Clan
 * @package App\Models\Clans
 * @property int $id
 * @property string $title
 * @property  bool $is_banned = false
 * @property int|null $hero_id
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $creator
 * @property Hero $creatorHero
 * @property HasMany|Collection $heroes
 * @author Shcerbakov Andrei
 */
class Clan extends BaseModel
{
    protected $table = 'clans';

    protected $fillable = [
        'title',
        'is_banned',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creatorHero(): BelongsTo
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

    public function heroes(): HasMany
    {
        return $this->hasMany(HeroesInClan::class, 'clan_id', 'id');
    }
}
