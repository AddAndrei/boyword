<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Http\DTO\Items\CreateItemDTO;
use App\Http\DTO\Items\UpdateItemDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Items\CreateItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Items\ItemResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Items\Item;
use App\Models\Resources\ResourceType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends Controller
{
    private EntityMediatr $mediatr;

    public function __construct(EntityMediatr $entityMediatr)
    {
        $this->mediatr = new EntityMediatr(new Item(), new Service());
    }

    /**
     * @param CreateItemRequest $request
     * @return ItemResponse
     * @throws UnknownProperties
     */
    #[Route('/api/item', methods: ["POST"])]
    public function store(CreateItemRequest $request): ItemResponse
    {
        $dto = CreateItemDTO::createFromRequest($request);
        $item = $this->mediatr->store($dto, function (Item $item) use ($dto) {
            if ($item->toResourceAllowed($dto->resource_type_id)) {
                $resourceType = ResourceType::find($dto->resource_type_id);
                $item->resourceType()->associate($resourceType);
                return $item;
            }
        });
        return ItemResponse::make($item)->created();
    }

    #[Route('/api/item', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $items = $this->mediatr->all(
            $dto,
            fn(Item $item) => Item::with(['resourceType', 'image'])->paginateWithFilters($dto)
        );
        return ItemResponse::collection($items);
    }

    #[Route('/api/item', methods: ["GET"])]
    public function show(int $id): ItemResponse
    {
        return ItemResponse::make(
            Item::with(['resourceType', 'image'])
                ->where('id', $id)
                ->firstOrFail()
        );
    }

    #[Route('/api/item/{id}', methods: ["PATCH", "PUT"])]
    public function update(UpdateItemRequest $request, int $id): ItemResponse
    {
        $dto = UpdateItemDTO::createFromRequest($request);
        $item = $this->mediatr->update($id, $dto, function (Item $item) use ($dto) {
            if($dto->resource_type_id && $item->toResourceAllowed($dto->resource_type_id)) {
                $realtions = [
                    'resource_type_id' => [
                        'entity' => ResourceType::class,
                        'method' => 'resourceType'
                    ]
                ];
                $item->updateRelations($dto, $realtions);
            }
            $item->load(['resourceType', 'image']);
            return $item;
        });
        return ItemResponse::make($item);
    }

    #[Route('/api/item', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
