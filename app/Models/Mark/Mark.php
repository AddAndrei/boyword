<?php

namespace App\Models\Mark;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Mark extends BaseModel
{
    protected $table = 'marks';

    protected $fillable = [
        'title',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
