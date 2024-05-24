<?php

namespace App\Models\User;

use App\Models\BaseModel;
use App\Models\Tasks\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $role=observer
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 *
 * @property User $user
 * @property Task $task
 *
 */
class Representative extends BaseModel
{
    protected $table = 'representatives';

    protected $fillable = [
        'role',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
