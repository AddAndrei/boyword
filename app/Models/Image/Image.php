<?php

namespace App\Models\Image;

use App\Models\Auth\Profile;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Profile $profile
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
}
