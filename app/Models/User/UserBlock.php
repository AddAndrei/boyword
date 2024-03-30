<?php

namespace App\Models\User;

use App\Models\BaseModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserBlock
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $ban_time
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @author Shcerbakov Andrei
 */
class UserBlock extends BaseModel
{
    protected $table = 'users_block';

    protected $fillable = [
        'reason',
    ];

    protected $dates = [
        'ban_time',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
