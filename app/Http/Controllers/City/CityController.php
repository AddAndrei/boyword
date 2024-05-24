<?php

namespace App\Http\Controllers\City;

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
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\City\City;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class CityController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new City(), new Service());
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
        $cities = $this->mediatr->all(closure: fn (City $city) => City::paginateWithFilters($dto));
        return CityResponse::collection($cities);
    }

    /**
     * @throws UnknownProperties
     */
    #[Route('/api/cities', methods: ["POST"])]
    public function store(AggregateCreateRequest $request): CityResponse
    {
        $dto = AggregateCreateDTO::createFromRequest($request);
        $city = $this->mediatr->store($dto);
        return CityResponse::make($city)->created();
    }

    /**
     * @param AggregateUpdateRequest $request
     * @param int $id
     * @return CityResponse
     * @throws UnknownProperties
     */
    #[Route('/api/cities/{id}', methods: ["PATCH", "PUT"])]
    public function update(AggregateUpdateRequest $request, int $id): CityResponse
    {
        $dto = AggregateUpdateDTO::createFromRequest($request);
        $city = $this->mediatr->update($id, $dto);
        return CityResponse::make($city);
    }

    /**
     * @param int $id
     * @return CityResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/cities/{id}', methods: ["GET"])]
    public function show(int $id): CityResponse
    {
        $city = $this->mediatr->get(
            'id',
            $id
        );
        return CityResponse::make($city);
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
