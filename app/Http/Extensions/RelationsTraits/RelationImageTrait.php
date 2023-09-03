<?php

namespace App\Http\Extensions\RelationsTraits;

use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait RelationImageTrait
{
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
