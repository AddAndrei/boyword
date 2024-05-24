<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User\Representative;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property int $user_id
 * @property string $status
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $creator
 * @property string $dateFormat
 *
 * @property Representative $backers
 * @property Representative $fronts
 * @property Representative $testers
 * @property Representative $observers
 */
class Task extends BaseModel
{
    protected $dateFormat = "d-m-Y H:i:s";
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'content',
        'status',
    ];
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'status' => 'queue',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function backers(): BelongsToMany
    {
        return $this->belongsToMany(
            Representative::class,
            'representatives',
            'id',
            'task_id'
        );
    }

}
