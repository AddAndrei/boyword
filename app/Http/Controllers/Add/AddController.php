<?php

namespace App\Http\Controllers\Add;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\DTO\Adds\CreateAddDTO;
use App\Http\DTO\Adds\GetAddDTO;
use App\Http\DTO\Adds\UpdateAddDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\Adds\CreateAddRequest;
use App\Http\Requests\Adds\GetAddRequest;
use App\Http\Requests\Adds\UpdateAddRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Add\AddResponse;
use App\Http\Services\Add\AddService;
use App\Http\Services\Add\ViewService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Adds\Add;
use App\Models\Adds\View;
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
        $adds = $this->mediatr->all($dto, fn(Add $add) => Add::with(['city', 'images','user.profile','model','mark','memory'])
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

    /**
     * @param GetAddRequest $request
     * @param int $id
     * @return AddResponse
     * @throws UnknownProperties
     * @throws EntityNotFoundException
     */
    #[Route('/api/adds/{id}', methods: ["GET"])]
    public function show(GetAddRequest $request ,int $id): AddResponse
    {
        $dto = GetAddDTO::createFromRequest($request);
        $add = $this->mediatr->get('id', $id, function (Add $add) use ($id, $dto) {
            /**@var $res Add*/
            $res = $add::with(['city', 'mark', 'model', 'color', 'memory', 'user', 'user.profile.rating','category', 'images', 'views'])
                ->where('id', $id)
                ->first();
            ViewService::createView($dto, $res);
            return $res;
        });
        dd($add);
        return AddResponse::make($add);
    }
}
