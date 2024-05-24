<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use App\Models\Image\Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property Carbon|null $birth_day
 * @property int|null $image_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Image $image
 * @property User $user
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
}
