<?php

namespace App\Models\Map;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class Map
 * @package App\Models\Map
 * @property int $id
 * @property string|null $title
 * @property string|null $tiles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @author Shcerbakov Andrei
 */
class Map extends BaseModel
{
    protected $table = 'maps';

    protected $fillable = [
        'title',
        'tiles',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected function tiles(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }
}
