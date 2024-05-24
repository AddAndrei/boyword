<?php

namespace App\Http\Controllers\Volume;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\DTO\CityMarkModelColorVolumeDTO\AggregateCreateDTO;
use App\Http\DTO\CityMarkModelColorVolumeDTO\AggregateUpdateDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\CityMarkModelColorVolumeRequest\AggregateCreateRequest;
use App\Http\Requests\CityMarkModelColorVolumeRequest\AggregateUpdateRequest;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Model\ModelResponse;
use App\Http\Responses\Volume\VolumeResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Models\Model;
use App\Models\Volume\VolumeMemory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class VolumeController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new VolumeMemory(), new Service());
    }

    /**
     * @param PaginateWithFiltersRequest $request
     * @return AnonymousResourceCollection
     * @throws UnknownProperties
     */
    #[Route('/api/cities', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $cities = $this->mediatr->all(closure: fn (VolumeMemory $city) => VolumeMemory::paginateWithFilters($dto));
        return VolumeResponse::collection($cities);
    }

    /**
     * @throws UnknownProperties
     */
    #[Route('/api/cities', methods: ["POST"])]
    public function store(AggregateCreateRequest $request): VolumeResponse
    {
        $dto = AggregateCreateDTO::createFromRequest($request);
        $city = $this->mediatr->store($dto);
        return VolumeResponse::make($city)->created();
    }

    /**
     * @param AggregateUpdateRequest $request
     * @param int $id
     * @return VolumeResponse
     * @throws UnknownProperties
     */
    #[Route('/api/cities/{id}', methods: ["PATCH", "PUT"])]
    public function update(AggregateUpdateRequest $request, int $id): VolumeResponse
    {
        $dto = AggregateUpdateDTO::createFromRequest($request);
        $city = $this->mediatr->update($id, $dto);
        return VolumeResponse::make($city);
    }

    /**
     * @param int $id
     * @return VolumeResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/cities/{id}', methods: ["GET"])]
    public function show(int $id): VolumeResponse
    {
        $city = $this->mediatr->get(
            'id',
            $id
        );
        return VolumeResponse::make($city);
    }

    /**
     * @param DestroyRequest $request
     * @return DeletedResponse
     */
    #[Route('/api/cities', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
