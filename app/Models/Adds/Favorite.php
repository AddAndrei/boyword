<?php

namespace App\Models\Adds;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $favoriteable_type
 * @property int $favoriteable_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Add $add
 */
class Favorite extends BaseModel
{
    protected $table = 'favorites';

    public function favoriteable(): MorphTo
    {
        return $this->morphTo();
    }


    public function add(): HasOne
    {
        return $this->hasOne(Add::class, 'id', 'favoriteable_id');
    }
}
