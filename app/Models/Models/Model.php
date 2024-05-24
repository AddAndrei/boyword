<?php

namespace App\Models\Models;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Model extends BaseModel
{
    protected $table = 'models';

    protected $fillable = [
        'title',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
