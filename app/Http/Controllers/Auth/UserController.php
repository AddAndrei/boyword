<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AnotherExceptions\UserIsBlockedException;
use App\Http\Controllers\Controller;
use App\Http\DTO\Auth\BanDTO;
use App\Http\DTO\Auth\UpdateUserDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\Auth\BanUserRequest;
use App\Http\Requests\Auth\UnbanUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Responses\DeletedResponse;
use App\Models\User;
use App\Models\User\UserBlock;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties as UnknownPropertiesAlias;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends Controller
{
    #[Route('/api/user', methods: ["GET"])]
    public function show(int $id): UserResponse
    {
        $user = User::with(['heroes', 'ban'])->findOrFail($id);
        return UserResponse::make($user);
    }

    #[Route('/api/user', methods: ["POST"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $users = User::with(['heroes', 'ban'])->paginateWithFilters($dto);
        return UserResponse::collection($users);
    }

    #[Route('/api/user/{id}', methods: ["PATCH", "PUT"])]
    public function update(UpdateUserRequest $request, int $id): UserResponse
    {
        $dto = UpdateUserDTO::createFromRequest($request);
        $user = User::find($id);
        $user->propagateFromDTO($dto)->load(['heroes', 'ban'])->save();
        return UserResponse::make($user);
    }

    /**
     * @param BanUserRequest $request
     * @return UserResponse
     * @throws UserIsBlockedException
     * @throws UnknownPropertiesAlias
     */
    #[Route('/api/user/{id}/banned', methods: ["POST"])]
    public function banned(BanUserRequest $request): UserResponse
    {
        $dto = BanDTO::createFromRequest($request);
        if (UserBlock::where('user_id', $dto->user_id)->exists()) {
            throw new UserIsBlockedException();
        }
        $user = User::find($dto->user_id);
        $userBlock = new UserBlock();
        $userBlock->user()->associate($user);
        $userBlock->propagateFromDTO($dto)->save();
        $user->load('heroes', 'ban');
        return UserResponse::make($user);
    }

    #[Route('/api/user/unbanned', methods: ["POST"])]
    public function unbanned(UnbanUserRequest $request): DeletedResponse
    {
        $userBlocked = UserBlock::whereIn('user_id', $request->all())->delete();
        return DeletedResponse::make([])->deleted();
    }
}
