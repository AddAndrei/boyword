<?php

namespace App\Models\Reviews;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $reviewable_type
 * @property int $reviewable_id
 * @property int $user_id
 * @property string $review
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Review extends BaseModel
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'review',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
