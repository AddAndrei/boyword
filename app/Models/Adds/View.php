<?php

namespace App\Models\Adds;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $viewable_type
 * @property int $viewable_id
 * @property string $device
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property MorphTo $viewable
 */
class View extends BaseModel
{
    protected $table = 'views';

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
