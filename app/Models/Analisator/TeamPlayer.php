<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $team_id
 * @property int|null $player_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Team|null $team
 * @property Player|null $player
 */
class TeamPlayer extends BaseModel
{
    protected $table = 'team_players';

    protected $fillable = [
        'id',
        'team_id',
        'player_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
