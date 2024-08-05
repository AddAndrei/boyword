<?php

namespace App\Models\Reviews;

use App\Models\Auth\Profile;
use App\Models\Auth\Rating;
use App\Models\BaseModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $reviewable_type
 * @property int $reviewable_id
 * @property int $user_id
 * @property string $review
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property int|null $rate
 */
class Review extends BaseModel
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'review',
    ];

    public ?int $rate;

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getRateAttribute(Rating $rating): void
    {
        $this->rate = $rating->rate;
    }
}
