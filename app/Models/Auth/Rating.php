<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $profile_to_id
 * @property string $profile_from_id
 * @property string $profile_type
 * @property int $rate
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MorphTo $profileable
 */
class Rating extends BaseModel
{
    protected $table = 'ratings';

    protected $fillable = [
        'rate',
        'user_id',
    ];

    public function profileable(): MorphTo
    {
        return $this->morphTo();
    }

}
