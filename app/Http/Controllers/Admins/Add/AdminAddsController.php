<?php

namespace App\Http\Controllers\Admins\Add;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Admins\AdminController;
use App\Http\DTO\Adds\UpdateAddDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\Adds\UpdateAddRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Add\AddResponse;
use App\Http\Responses\PaginateCollection;
use App\Http\Services\Add\AddService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Adds\Add;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class AdminAddsController extends AdminController
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
    #[Route('/api/admin/adds', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $adds = $this->mediatr->all($dto,
            fn(Add $add) => $add::with(['city', 'images','user.profile','model','mark','memory'])
                ->paginateWithFilters($dto)
        );
        return AddResponse::collection($adds);
    }

    /**
     * @param int $id
     * @return AddResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/admin/adds/{id}', methods: ["GET"])]
    public function show(int $id): AddResponse
    {
        $add = $this->mediatr->get('id', $id)
            ->load(['city', 'images','user.profile','model','mark','memory']);
        return AddResponse::make($add);
    }

    /**
     * @throws UnknownProperties
     */
    #[Route('/api/admin/adds/{id}', methods: ["PUT", "POST"])]
    public function update(UpdateAddRequest $request, int $id): AddResponse
    {
        $dto = UpdateAddDTO::createFromRequest($request);
        $add = $this->mediatr->update($id, $dto, fn(Add $add) => AddService::update($add, $dto));
        return AddResponse::make($add);
    }
}
