<?php

namespace App\Models\Resources;

use App\Http\Extensions\RelationsTraits\RelationImageTrait;
use App\Models\BaseModel;
use App\Models\Images\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Resource
 * @package App\Models\Resources
 * @property int $id
 * @property int|null $type_id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $image_id
 *
 * @property Image $image
 * @property ResourceType $type
 * @author Shcerbakov Andrei
 */
class Resource extends BaseModel
{
    use RelationImageTrait;

    protected $table = 'resources';

    protected $fillable = [
        'id',
        'type_id',
        'title',
        'description',
        'image_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ResourceType::class, 'type_id');
    }
}
