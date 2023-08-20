<?php

namespace App\Models\Resources;

use App\Http\DTO\FilterDTO;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ResourceType
 * @package App\Models\Resources
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @author Shcerbakov Andrei
 */
class ResourceType extends BaseModel
{
    protected $table = 'resources_types';

    protected $fillable = [
        'title',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
