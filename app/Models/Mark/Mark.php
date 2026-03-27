<?php

namespace App\Models\Mark;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection $models
 */
class Mark extends BaseModel
{
    protected $table = 'marks';

    protected $fillable = [
        'title',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(MarkModelPivot::class, 'mark_id', 'id')->with(['model']);
    }

}
