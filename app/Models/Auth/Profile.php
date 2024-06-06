<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use App\Models\Image\Image;
use App\Models\Reviews\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property Carbon|null $birth_day
 * @property int|null $image_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MorphMany|Rating[] $rating
 * @property MorphMany|Review[] $reviews
 *
 * @property Image $image
 * @property User $user
 * @property Balance $balance
 */
class Profile extends BaseModel
{
    protected $table = 'profiles';

    protected $fillable = [
        'name',
        'last_name',
    ];

    protected $dates = [
        'birth_day',
        'created_at',
        'updated_at',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rating(): MorphMany
    {
        return $this->morphMany(Rating::class, 'profileable');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class, 'profile_id')->latest();
    }
}
