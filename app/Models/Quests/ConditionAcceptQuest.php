<?php

namespace App\Models\Quests;

use App\Models\BaseModel;
use App\Models\Resources\Resource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ConditionAcceptQuest
 * @package App\Models\Quests
 * @property int $id
 * @property int|null $resource_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Resource $resource
 * @author Shcerbakov Andrei
 */
class ConditionAcceptQuest extends BaseModel
{
    protected $table = 'condition_accept_quests';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class,'resource_id');
    }
}
