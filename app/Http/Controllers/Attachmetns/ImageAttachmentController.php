<?php

namespace App\Http\Controllers\Attachmetns;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Exceptions\GeneralJsonException;
use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\ResourceResponse;
use App\Http\Responses\Response;
use App\Http\Responses\Skills\SkillResponse;
use App\Http\Responses\Tiles\TileResponse;
use App\Http\Services\Images\ImagesService;
use App\Models\BaseModel;
use App\Models\Images\Image;
use App\Models\Skills\Skill;
use App\Models\Tiles\Tile;
use App\Models\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Annotation\Route;

class ImageAttachmentController extends Controller
{
    /**
     * @var array|array[]
     */
    private array $register = [
        'tile' => Tile::class,
        'resource' => Resource::class,
        'skill' => Skill::class,
    ];

    #[Route('/api/{entity}/{entityId}/attachment/{imageId}', methods: ["POST"])]
    public function attachment(string $entity, int $entityId, int $imageId): GeneralJsonException|Response
    {
        if ($this->register[$entity]::where('id', $entityId)->exists()) {
            if (Image::where([['id', $imageId], ['storage', 'time']])->exists()) {
                $image = Image::find($imageId);
                $path = Storage::disk('time')->path($image->name);
                $newPath = storage_path("app/images/$entity/");
                $imageWebp = ImagesService::convertImage($path, $newPath);
                Storage::disk('time')->delete($image->name);
                $findEntity = $this->register[$entity]::find($entityId);
                $findEntity->image()->associate($image);
                $image->storage = $entity;
                $image->name = str_replace(storage_path("app/images/$entity/"), '', $imageWebp);
                $image->save();
                $findEntity->save();
                $findEntity->load('image');
                return $this->returnEntity($entity, $findEntity);
            } else {
                throw new EntityNotFoundException("Entity Image with id {$imageId} in storage time not found!");
            }
        }
        throw new EntityNotFoundException("Entity {$this->register[$entity]} with id {$entityId} not exists!");
    }
    #[Route('/api/{entity}/{entityId}/detachable', methods: ["POST"])]
    public function detachable(string $entity, int $entityId): GeneralJsonException|Response
    {
        if ($this->register[$entity]::where('id', $entityId)->exists()) {
            $findEntity = $this->register[$entity]::find($entityId);
            $findEntity->image()->dissociate();
            $findEntity->save();
            return $this->returnEntity($entity, $findEntity);
        }
        throw new EntityNotFoundException("Entity {$this->register[$entity]} with id {$entityId} not exists!");
    }

    private function returnEntity(string $entity, BaseModel $findEntity): Response
    {
        return match ($entity) {
            'tile' => TileResponse::make($findEntity),
            'resource' => ResourceResponse::make($findEntity),
            'skill' => SkillResponse::make($findEntity),
        };
    }
}
