<?php

namespace App\Models\Items;

use App\Exceptions\AnotherExceptions\NotSupportedResourceTypeException;
use App\Http\Extensions\FiltersAndSortingPaginateTrait;
use App\Http\Extensions\RelationsTraits\RelationImageTrait;
use App\Http\Interfaces\Enumable\EnumInterface;
use App\Models\BaseModel;
use App\Models\Images\Image;
use App\Models\Resources\ResourceType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Traits\EnumeratesValues;

/**
 * Class Items
 * @package App\Models\Items
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $resource_type_id
 * @property int|null $image_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ResourceType $resourceType
 * @property Image|null $image
 * @author Shcerbakov Andrei
 */
class Item extends BaseModel
{
    use FiltersAndSortingPaginateTrait,
        RelationImageTrait, HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'title',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function resourceType(): BelongsTo
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }

    /**
     * @param int $resource_type_id
     * @return bool
     * @throws NotSupportedResourceTypeException
     */
    public function toResourceAllowed(int $resource_type_id): bool
    {
        if(ItemResourceTypeEnum::tryFrom($resource_type_id)){
            return true;
        }
        throw new NotSupportedResourceTypeException(Item::class);
    }

    public function byTitle(Builder $builder, string $value): Builder
    {
        return $builder->where("title", "like", "%$value%");
    }

    public function byTypes(Builder $query, array $typeId) : Builder
    {
        return $query->whereHas('resourceType', fn (Builder $builder) => $builder->whereIn('id', $typeId));
    }
}
