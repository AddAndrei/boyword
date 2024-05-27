<?php

namespace App\Http\Services\Add;

use App\Api\YandexDisk;
use App\Http\DTO\Adds\CreateAddDTO;
use App\Http\DTO\Adds\UpdateAddDTO;
use App\Http\Services\Image\ImagesService;
use App\Jobs\UploadImageToDiskJob;
use App\Models\Adds\Add;
use App\Models\Categories\Category;
use App\Models\City\City;
use App\Models\Color\Color;
use App\Models\Image\Image;
use App\Models\Mark\Mark;
use App\Models\Models\Model;
use App\Models\User;
use App\Models\Volume\VolumeMemory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'callable' => ['filtration'],
        ]
    ];

    public static function create(Add $add, CreateAddDTO $dto, array $images): Add
    {
        $add->updateRelations($dto, self::$relations);
        $user = Auth::user();
        $add->user()->associate($user);
        $add->propagateFromDTO($dto)->save();
        if (!empty($images)) {
            $webpName = [];
            foreach($images as $image) {
                /** @var  UploadedFile $image */
                $imageName = Storage::disk('time')->put('', $image);
                $path = Storage::disk('time')->path('');
                $path .= $imageName;
                $newPath = storage_path("app/images/time/");
                $imageWebp = ImagesService::convertImage($path, $newPath);
                Storage::disk('time')->delete($imageName);
                $webpName = last(explode('/', $imageWebp));
                $fullPath = env('APP_URL') . '/public/images/time/' . $webpName;
                $entityImage = new Image();
                $entityImage->url = $fullPath;
                $entityImage->add()->associate($add);
                $entityImage->save();
            }

            //UploadImageToDiskJob::dispatch(new YandexDisk(), $images, $add->id, $user->id);
        }
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
        $add->load(['city', 'mark', 'model', 'memory', 'color', 'user', 'category']);
        $add->updateFiltrateAggregation();
        return $add;
    }

}
