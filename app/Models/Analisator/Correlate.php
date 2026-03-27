<?php

namespace App\Models\Analisator;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $match_id
 * @property string $forecast
 * @property float $left_team_strong
 * @property float $right_team_strong
 * @property string $result
 * @property boolean $predict
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Correlate extends BaseModel
{
    protected $table = 'corellation';

    protected $fillable = [
        'id',
        'match_id',
        'forecast',
        'left_team_strong',
        'right_team_strong',
        'result',
        'predict',

    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'left_team_strong' => 'float',
        'right_team_strong' => 'float',
    ];
}
