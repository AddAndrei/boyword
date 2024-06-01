<?php

namespace App\Models\Mark;

use App\Models\BaseModel;
use App\Models\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $mark_id
 * @property int $model_id
 * @property Mark $mark
 * @property Model $model
 */
class MarkModelPivot extends BaseModel
{
    protected $table = 'marks_models_pivot';

    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class, 'mark_id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class, 'model_id');
    }
}
