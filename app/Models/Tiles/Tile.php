<?php

namespace App\Models\Tiles;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class Tile
 * @package App\Models\Tiles
 * @property int $id
 * @property string $image
 * @property string $title
 * @property int $width
 * @property int $height
 * @property bool $collision
 * @property string|null $event
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @author Shcerbakov Andrei
 */
class Tile extends BaseModel
{
    protected $table = 'tiles';

    protected $fillable = [
        'image',
        'title',
        'width',
        'height',
        'collision',
        'event',
    ];
}
