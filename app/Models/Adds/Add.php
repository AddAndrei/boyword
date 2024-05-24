<?php

namespace App\Models\Adds;

use App\Models\BaseModel;
use App\Models\City\City;
use App\Models\Color\Color;
use App\Models\Mark\Mark;
use App\Models\Models\Model;
use App\Models\User;
use App\Models\Volume\VolumeMemory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $aggregate
 * @property string $status=unconfirmed
 * @property int $filtrate
 * @property float $price
 * @property int $city_id
 * @property int $mark_id
 * @property int $model_id
 * @property int $memory_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property City $city
 * @property Mark $mark
 * @property Model $model
 * @property VolumeMemory $memory
 * @property Color $color
 * @property User $user
 */
class Add extends BaseModel
{
    private const DEFAULT_STATUS = 'unconfirmed';

    protected $table = 'adds';

    protected $fillable = [
        'title',
        'description',
        'aggregate',
        'filtrate',
        'price',
        'status',
    ];
    protected $attributes = [
        'status' => self::DEFAULT_STATUS
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function mark():BelongsTo
    {
        return $this->belongsTo(Mark::class, 'mark_id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class, 'model_id');
    }
    public function memory(): BelongsTo
    {
        return $this->belongsTo(VolumeMemory::class, 'memory_id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aggregation(BaseModel $model): void
    {
        /** @var City|Mark|Model|VolumeMemory $model */
        $this->aggregate = "{$this->aggregate} {$model->title}";
    }

    public function filtration(BaseModel $model): void
    {
        /** @var City|Mark|Model|VolumeMemory $model */
        $this->filtrate = "{$this->filtrate}{$model->id}";
    }

}
