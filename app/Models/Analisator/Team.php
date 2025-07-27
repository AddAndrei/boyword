<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property HasMany $players
 */
class Team extends BaseModel
{
    protected $table = 'teams';

    protected $fillable = [
        'id',
        'title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(TeamPlayer::class, 'team_id', 'id');
    }
}
