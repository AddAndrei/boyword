<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Add\FavoriteAddsResponse;
use App\Http\Responses\StringResponses\AddFavoriteExistsResponse;
use App\Http\Responses\StringResponses\FavoriteNotExistsResponse;
use App\Http\Responses\StringResponses\RemoveFavoriteResponse;
use App\Http\Responses\StringResponses\SuccessAddFavoriteResponse;
use App\Http\Services\Add\FavoriteService;
use App\Models\Adds\Add;
use App\Models\Adds\Favorite;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends Controller
{
    public function __construct()
    {
    }

    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $adds = Favorite::with(['add.city', 'add.mark', 'add.model', 'add.color', 'add.memory', 'add.user', 'add.user.profile.rating','add.category', 'add.images', 'add.views'])->where('user_id', Auth::id())->paginateWithFilters($dto);
        return FavoriteAddsResponse::collection($adds);
    }

    #[Route('/api/favorite/add/{id}', methods: ["GET"])]
    public function add(int $id): SuccessAddFavoriteResponse|AddFavoriteExistsResponse
    {
        return FavoriteService::add($id);
    }

    #[Route('/api/favorite/remove/{id}', methods: ["GET"])]
    public function remove(int $id): RemoveFavoriteResponse|FavoriteNotExistsResponse
    {
        return FavoriteService::remove($id);
    }
}
