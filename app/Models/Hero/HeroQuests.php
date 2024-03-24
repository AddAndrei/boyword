<?php

namespace App\Models\Hero;

use App\Models\BaseModel;
use App\Models\Quests\Quest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HeroQuests
 * @package App\Models\Hero
 * @property int $id
 * @property bool $status = false
 * @property int $hero_id
 * @property int $quest_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Hero $hero
 * @property Quest $quest
 * @author Shcerbakov Andrei
 */
class HeroQuests extends BaseModel
{
    protected $table = 'heroes_quests';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

    public function quest(): BelongsTo
    {
        return $this->belongsTo(Quest::class, 'quest_id');
    }
}
