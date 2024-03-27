<?php

namespace App\Http\Controllers\Clans;

use App\Http\Controllers\Controller;
use App\Http\DTO\Clans\CreateClanDTO;
use App\Http\DTO\Clans\UpdateClanDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\Clans\CreateClanRequest;
use App\Http\Requests\Clans\UpdateClanRequest;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Clans\ClanResponse;
use App\Http\Responses\DeletedResponse;
use App\Http\Services\Clans\ClanService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Clans\Clan;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties as UnknownPropertiesAlias;
use Symfony\Component\Routing\Annotation\Route;

class ClanController extends Controller
{
    private EntityMediatr $mediatr;
    private ClanService $service;

    public function __construct(EntityMediatr $mediatr, ClanService $service)
    {
        $this->mediatr = new EntityMediatr(new Clan(), new Service());
        $this->service = $service;
    }

    /**
     * @param CreateClanRequest $request
     * @return ClanResponse
     * @throws UnknownPropertiesAlias
     */
    #[Route('/api/clans', methods: ["POST"])]
    public function store(CreateClanRequest $request): ClanResponse
    {
        $dto = CreateClanDTO::createFromRequest($request);
        $clan = $this->mediatr->store($dto, function (Clan $clan) use ($dto) {
            return $this->service->store($clan, $dto);
        });
        return ClanResponse::make($clan)->created();
    }

    #[Route('/api/clans/{id}', methods: ["PATCH", "PUT"])]
    public function update(UpdateClanRequest $request, int $id): ClanResponse
    {
        $dto = UpdateClanDTO::createFromRequest($request);
        $clan = $this->mediatr->update($id, $dto, fn(Clan $clan) => $clan->load(['creator', 'heroes.hero']));
        return ClanResponse::make($clan);
    }

    #[Route('/api/clans', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $clans = $this->mediatr->all(
            $dto,
            fn(Clan $clan) => $clan::with(['creator', 'heroes.hero'])->paginateWithFilters($dto)
        );
        return ClanResponse::collection($clans);
    }

    #[Route('/api/clans/{id}', methods: ["GET"])]
    public function show(int $id): ClanResponse
    {
        $clan = $this->mediatr->get('id', $id)->load(['creator', 'heroes.hero']);
        return ClanResponse::make($clan);
    }

    #[Route('/api/clans', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
