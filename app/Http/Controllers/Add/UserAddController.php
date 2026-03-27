<?php

namespace App\Http\Controllers\Add;

use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Add\AddResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Adds\Add;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class UserAddController extends Controller
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
    #[Route('/api/user/adds', methods: ['GET'])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $adds = $this->mediatr->all($dto, fn(Add $add) => Add::with(['city', 'images','user.profile','model','mark','memory'])
            ->where('user_id', Auth::id())
            ->paginateWithFilters($dto)
        );
        return AddResponse::collection($adds);
    }


}
