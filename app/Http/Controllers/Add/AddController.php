<?php

namespace App\Http\Controllers\Add;

use App\Http\Controllers\Controller;
use App\Http\DTO\Adds\CreateAddDTO;
use App\Http\DTO\Adds\UpdateAddDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\Adds\CreateAddRequest;
use App\Http\Requests\Adds\UpdateAddRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Add\AddResponse;
use App\Http\Services\Add\AddService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Adds\Add;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class AddController extends Controller
{
    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Add(), new Service());
    }

    /**
     * @param PaginateWithFiltersRequest $request
     * @return AnonymousResourceCollection
     * @throws UnknownProperties
     */
    #[Route('/api/adds', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $adds = $this->mediatr->all($dto, fn(Add $add) => Add::with(['city', 'images','user.profile'])
            ->paginateWithFilters($dto)
        );
        return AddResponse::collection($adds);
    }

    /**
     * @param CreateAddRequest $request
     * @return AddResponse
     * @throws UnknownProperties
     */
    #[Route('/api/adds', methods: ["POST"])]
    public function store(CreateAddRequest $request): AddResponse
    {
        $dto = CreateAddDTO::createFromRequest($request);
        $add = $this->mediatr->store($dto, fn(Add $add) => AddService::create($request, $add, $dto, $request->file('images')));
        return AddResponse::make($add)->created();
    }

    /**
     * @param UpdateAddRequest $request
     * @param int $id
     * @return AddResponse
     * @throws UnknownProperties
     */
    #[Route('/api/adds/{id}', methods: ["PUT", "PATCH"])]
    public function update(UpdateAddRequest $request, int $id): AddResponse
    {
        $dto = UpdateAddDTO::createFromRequest($request);
        $add = $this->mediatr->update($id, $dto, fn(Add $add) => AddService::update($add, $dto));
        return AddResponse::make($add);
    }

    #[Route('/api/adds/{id}', methods: ["GET"])]
    public function show(int $id): AddResponse
    {
        $add = $this->mediatr->get('id', $id, function (Add $add) use ($id) {
            return $add::with(['city', 'mark', 'model', 'color', 'memory', 'user', 'user.profile','category', 'images'])
                ->where('id', $id)
                ->first();
        });
        return AddResponse::make($add);
    }
}
