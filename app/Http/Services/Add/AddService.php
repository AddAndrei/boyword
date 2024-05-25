<?php

namespace App\Http\Services\Add;

use App\Http\DTO\Adds\CreateAddDTO;
use App\Http\DTO\Adds\UpdateAddDTO;
use App\Models\Adds\Add;
use App\Models\Categories\Category;
use App\Models\City\City;
use App\Models\Color\Color;
use App\Models\Mark\Mark;
use App\Models\Models\Model;
use App\Models\User;
use App\Models\Volume\VolumeMemory;
use Illuminate\Support\Arr;

class AddService
{
    private static array $relations = [
        'city_id' => [
            'entity' => City::class,
            'method' => 'city',
            'callable' => ['filtration']
        ],
        'mark_id' => [
            'entity' => Mark::class,
            'method' => 'mark',
            'callable' => ['aggregation', 'filtration'],
        ],
        'model_id' => [
            'entity' => Model::class,
            'method' => 'model',
            'callable' => ['aggregation', 'filtration'],
        ],
        'memory_id' => [
            'entity' => VolumeMemory::class,
            'method' => 'memory',
            'callable' => ['aggregation', 'filtration'],
        ],
        'color_id' => [
            'entity' => Color::class,
            'method' => 'color',
            'callable' => ['aggregation', 'filtration'],
        ],
        'category_id' => [
            'entity' => Category::class,
            'method' => 'category',
            'callable'  => ['filtration'],
        ]
    ];

    public static function create(Add $add, CreateAddDTO $dto): Add
    {
        $add->updateRelations($dto, self::$relations);
        $user = User::find(1);
        $add->user()->associate($user);
        return $add;
    }

    public static function update(Add $add, UpdateAddDTO $dto): Add
    {
        Arr::forget(self::$relations, [
                'city_id.callable',
                'mark_id.callable',
                'model_id.callable',
                'memory_id.callable',
                'color_id.callable',
                'category_id.callable',
            ]);
        $add->updateRelations($dto, self::$relations);
        $add->load(['city','mark','model', 'memory', 'color', 'user', 'category']);
        $add->updateFiltrateAggregation();
        return $add;
    }

}
