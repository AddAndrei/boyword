<?php

namespace App\Models\Adds;

use App\Models\BaseModel;
use App\Models\Categories\Category;
use App\Models\City\City;
use App\Models\Color\Color;
use App\Models\Image\Image;
use App\Models\Mark\Mark;
use App\Models\Models\Model;
use App\Models\User;
use App\Models\Volume\VolumeMemory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property int $color_id
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property City $city
 * @property Mark $mark
 * @property Model $model
 * @property VolumeMemory $memory
 * @property Color $color
 * @property User $user
 * @property Category $category
 * @property Image[]|Collection $images
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

    public function mark(): BelongsTo
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'add_id', 'id');
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

    public function updateFiltrateAggregation(): void
    {
        $this->filtrate = "{$this->city_id}{$this->mark_id}{$this->model_id}{$this->memory_id}{$this->color_id}";
        $this->aggregate = "{$this->mark->title} {$this->model->title} {$this->memory->title} {$this->color->title}";
    }

    public function byCategory(Builder $query, int $value): Builder
    {
        return $query->where('category_id', $value);
    }

    public function bySearch(Builder $query, string $value): Builder
    {
        return $query->where('aggregate', 'like', "%$value%");
    }

    public function byCity(Builder $query, string $value): Builder
    {
        return $query->withWhereHas('city', function($q) use ($value) {
            $q->where('title', $value);
        });
    }

    public function byPrices(Builder $query, string $value): Builder
    {
        $prices = explode(",", $value);
        return $query->whereBetween('price', [$prices[0], $prices[1]]);
    }
    public function byFrom(Builder $query, string $value): Builder
    {
        return $query->where('price', '>=', $value);
    }

    public function byTo(Builder $query, string $value): Builder
    {
        return $query->where('price', '<=', $value);
    }

    public function byMark(Builder $builder , int $value): Builder
    {
        return $builder->where('mark_id', $value);
    }

    public function byModel(Builder $builder, int $value): Builder
    {
        return $builder->where('model_id', $value);
    }

    public function byColor(Builder $builder, int $value): Builder
    {
        return $builder->where('color_id', $value);
    }

    public function byMemory(Builder $builder, int $value): Builder
    {
        return $builder->where('memory_id', $value);
    }
}
