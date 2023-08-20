<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\DTO\Resources\CreateResourceTypeDTO;
use App\Http\DTO\Resources\UpdateResourceTypeDTO;
use App\Http\Requests\Resources\CreateResourceTypeRequest;
use App\Http\Requests\Resources\UpdateResourceTypeRequest;
use App\Http\Responses\Resources\ResourceTypeResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Resources\ResourceType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class ResourceTypeController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new ResourceType(), new Service());
    }

    #[Route('/api/resource-type', methods: ["POST"])]
    public function store(CreateResourceTypeRequest $request): ResourceTypeResponse
    {
        $resourceType = $this->entityMediatr->store(CreateResourceTypeDTO::createFromRequest($request));
        return ResourceTypeResponse::make($resourceType)->created();
    }

    #[Route('/api/resource-type', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        return ResourceTypeResponse::collection(
            $this->entityMediatr->all(null, function (ResourceType $resourceType) {
                return $resourceType::all();
            })
        );
    }

    #[Route('/api/resource-type/{id}', methods: ["GET"])]
    public function show(int $id): ResourceTypeResponse
    {
        return ResourceTypeResponse::make($this->entityMediatr->get('id', $id));
    }

    #[Route('/api/resource-type/{id}', methods: ["PATCH"])]
    public function update(UpdateResourceTypeRequest $request, int $id): ResourceTypeResponse
    {
        $updated = $this->entityMediatr->update($id, UpdateResourceTypeDTO::createFromRequest($request));
        return ResourceTypeResponse::make($updated);
    }
}
