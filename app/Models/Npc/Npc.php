<?php

namespace App\Models\Npc;

use App\Models\BaseModel;
use App\Models\Quests\Quest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Npc
 * @package App\Models\Npc
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection $quests
 * @author Shcerbakov Andrei
 */
class Npc extends BaseModel
{
    protected $table = 'npcs';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function quests(): HasMany
    {
        return $this->hasMany(Quest::class, 'npc_id', 'id');
    }
}
