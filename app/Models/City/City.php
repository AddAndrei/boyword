<?php

namespace App\Models\City;

use App\Http\Extensions\FiltersAndSortingPaginateTrait;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class City extends BaseModel
{
    protected $table = 'cities';

    protected $fillable = [
        'title',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function byTitle(Builder $builder, string $value): Builder
    {
        return $builder->where('title', 'like', "%$value%");
    }

}
