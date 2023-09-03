<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\DTO\Resources\CreateResourceDTO;
use App\Http\DTO\Resources\FilterResourceDTO;
use App\Http\DTO\Resources\UpdateResourceDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\Resources\CreateResourceRequest;
use App\Http\Requests\Resources\UpdateResourceRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Resources\ResourceResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Resources\Resource;
use App\Models\Resources\ResourceType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResourceController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new Resource(), new Service());
    }

    #[Route('/api/resource', methods: ["POST"])]
    public function store(CreateResourceRequest $request): ResourceResponse
    {
        $dto = CreateResourceDTO::createFromRequest($request);
        $resource = $this->entityMediatr->store($dto, function (Resource $resource) use ($dto) {
            if ($dto->type_id) {
                $resourceType = ResourceType::find($dto->type_id);
                $resource->type()->associate($resourceType);
            }
            return $resource;
        });
        return ResourceResponse::make($resource)->created();
    }

    #[Route('/api/resource', methods: ["GET"])]
    public function index(FilterRequest $request): AnonymousResourceCollection
    {
        return ResourceResponse::collection(
            $this->entityMediatr->all(null, function (Resource $resource) use ($request) {
                return $resource::with(['type', 'image'])
                    ->filtrate(FilterResourceDTO::createFromRequest($request))
                    ->orderBy('id', 'desc')
                    ->get();
            })
        );
    }

    #[Route('/api/resource', methods: ["GET"])]
    public function show(int $id): ResourceResponse
    {
        return ResourceResponse::make(Resource::with('type')->find($id));
    }
    #[Route('/api/resource/{id}', methods: ["PATCH"])]
    public function update(UpdateResourceRequest $request, int $id): ResourceResponse
    {
        $dto = UpdateResourceDTO::createFromRequest($request);
        $updated = $this->entityMediatr->update($id, $dto, function (Resource $resource) use ($dto) {
            $relations = [
                'type_id' => [
                    'entity' => ResourceType::class,
                    'method' => 'type'
                ],
            ];
            $resource->updateRelations($dto, $relations);
            return $resource->load('type');
        });
        return ResourceResponse::make($updated);
    }

    #[Route('/api/resource', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->entityMediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
