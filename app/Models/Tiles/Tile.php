<?php

namespace App\Models\Tiles;

use App\Http\Extensions\RelationsTraits\RelationImageTrait;
use App\Models\BaseModel;
use App\Models\Images\Image;
use Carbon\Carbon;

/**
 * Class Tile
 * @package App\Models\Tiles
 * @property int $id
 * @property string $title
 * @property int $width
 * @property int $height
 * @property bool $collision
 * @property string|null $event
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $image_id
 *
 * @property Image $image
 * @author Shcerbakov Andrei
 */
class Tile extends BaseModel
{

    use RelationImageTrait;

    protected $table = 'tiles';

    protected $fillable = [
        'title',
        'width',
        'height',
        'collision',
        'event',
        'image_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
