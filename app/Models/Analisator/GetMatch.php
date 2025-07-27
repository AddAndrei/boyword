<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $match_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class GetMatch extends BaseModel
{
    protected $table = 'get_matches';

    protected $fillable = [
        'id',
        'match_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
