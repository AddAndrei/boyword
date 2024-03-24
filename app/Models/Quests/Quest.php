<?php

namespace App\Models\Quests;

use App\Models\BaseModel;
use App\Models\Npc\Npc;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Quest
 * @package App\Models\Quests
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $parent_id
 * @property int $npc_id
 * @property int $condition_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Npc $npc
 * @property ConditionAcceptQuest $condition
 * @property Quest $parent
 * @author Shcerbakov Andrei
 */
class Quest extends BaseModel
{
    protected $table = 'quests';

    protected $fillable = [
        'title',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function npc(): BelongsTo
    {
        return $this->belongsTo(Npc::class, 'npc_id');
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(ConditionAcceptQuest::class, 'condition_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Quest::class, 'parent_id');
    }

    protected function byId(Builder $builder, mixed $value): Builder
    {
        return $builder->where('id', $value);
    }

    protected function byTitle(Builder $builder, mixed $value): Builder
    {
        return $builder->where("title", "like", "%{$value}%");
    }
}
