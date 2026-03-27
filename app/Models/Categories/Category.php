<?php

namespace App\Models\Categories;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Category extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = [
        'title',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];


}
