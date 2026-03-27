<?php

namespace App\Models\Image;

use App\Models\Adds\Add;
use App\Models\Auth\Profile;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $url
 * @property int|null $add_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Profile $profile
 * @property Add $add
 */
class Image extends BaseModel
{
    protected $table = 'images';

    protected $fillable = [
        'url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'image_id', 'id');
    }

    public function add(): BelongsTo
    {
        return $this->belongsTo(Add::class, 'add_id');
    }
}
