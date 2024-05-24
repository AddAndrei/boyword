<?php

namespace App\Http\Controllers\Mark;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\DTO\CityMarkModelColorVolumeDTO\AggregateCreateDTO;
use App\Http\DTO\CityMarkModelColorVolumeDTO\AggregateUpdateDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\CityMarkModelColorVolumeRequest\AggregateCreateRequest;
use App\Http\Requests\CityMarkModelColorVolumeRequest\AggregateUpdateRequest;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\City\CityResponse;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Mark\MarkResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Mark\Mark;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class MarkController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Mark(), new Service());
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
        $cities = $this->mediatr->all(closure: fn (Mark $city) => Mark::paginateWithFilters($dto));
        return MarkResponse::collection($cities);
    }

    /**
     * @throws UnknownProperties
     */
    #[Route('/api/cities', methods: ["POST"])]
    public function store(AggregateCreateRequest $request): MarkResponse
    {
        $dto = AggregateCreateDTO::createFromRequest($request);
        $city = $this->mediatr->store($dto);
        return MarkResponse::make($city)->created();
    }

    /**
     * @param AggregateUpdateRequest $request
     * @param int $id
     * @return MarkResponse
     * @throws UnknownProperties
     */
    #[Route('/api/cities/{id}', methods: ["PATCH", "PUT"])]
    public function update(AggregateUpdateRequest $request, int $id): MarkResponse
    {
        $dto = AggregateUpdateDTO::createFromRequest($request);
        $city = $this->mediatr->update($id, $dto);
        return MarkResponse::make($city);
    }

    /**
     * @param int $id
     * @return MarkResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/cities/{id}', methods: ["GET"])]
    public function show(int $id): MarkResponse
    {
        $city = $this->mediatr->get(
            'id',
            $id
        );
        return MarkResponse::make($city);
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
