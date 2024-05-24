<?php

namespace App\Http\Controllers\Color;

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
use App\Http\Responses\Color\ColorResponse;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Mark\MarkResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Color\Color;
use App\Models\Mark\Mark;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class ColorController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Color(), new Service());
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
        $cities = $this->mediatr->all(closure: fn (Color $city) => Color::paginateWithFilters($dto));
        return ColorResponse::collection($cities);
    }

    /**
     * @throws UnknownProperties
     */
    #[Route('/api/cities', methods: ["POST"])]
    public function store(AggregateCreateRequest $request): ColorResponse
    {
        $dto = AggregateCreateDTO::createFromRequest($request);
        $city = $this->mediatr->store($dto);
        return ColorResponse::make($city)->created();
    }

    /**
     * @param AggregateUpdateRequest $request
     * @param int $id
     * @return ColorResponse
     * @throws UnknownProperties
     */
    #[Route('/api/cities/{id}', methods: ["PATCH", "PUT"])]
    public function update(AggregateUpdateRequest $request, int $id): ColorResponse
    {
        $dto = AggregateUpdateDTO::createFromRequest($request);
        $city = $this->mediatr->update($id, $dto);
        return ColorResponse::make($city);
    }

    /**
     * @param int $id
     * @return ColorResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/cities/{id}', methods: ["GET"])]
    public function show(int $id): ColorResponse
    {
        $city = $this->mediatr->get(
            'id',
            $id
        );
        return ColorResponse::make($city);
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
