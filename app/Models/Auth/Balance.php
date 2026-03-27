<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property float $rate
 * @property string $operator
 * @property float $balance
 * @property int $profile_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Profile $profile
 */
class Balance extends BaseModel
{
    protected $table = 'balances';

    protected $fillable = [
        'rate',
        'operator',
        'balance',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'rate' => 'float',
        'balance' => 'float',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
