<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $phone
 * @property int $code
 * @property string $action
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Code extends BaseModel
{
    protected $table = 'codes';

    protected $fillable = [
        'phone',
        'code',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
