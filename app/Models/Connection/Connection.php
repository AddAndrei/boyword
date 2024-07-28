<?php

namespace App\Models\Connection;

use App\Models\BaseModel;

/**
 * @property int $profile_id
 * @property int $connection_id
 */
class Connection extends BaseModel
{
    protected $table = 'connections';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'connection_id',
    ];
}
