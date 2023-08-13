<?php

namespace App\Http\Controllers\Hero;

use App\Exceptions\HeroExceptions\MaxLimitedHeroException;
use App\Http\Controllers\Controller;
use App\Http\DTO\DTO;
use App\Http\DTO\Hero\AllHeroDTO;
use App\Http\DTO\Hero\HeroCreateDTO;
use App\Http\DTO\Hero\UpdateHeroDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Hero\HeroCreateRequest;
use App\Http\Requests\Hero\UpdateHeroRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Hero\HeroResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Skills\Axe;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Hero\Hero;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new Hero(), new Service());
    }
    #[Route("/api/hero", methods:["POST"])]
    public function store(HeroCreateRequest $request): HeroResponse|Application|ResponseFactory|Response
    {
            $entity = $this->entityMediatr->store(HeroCreateDTO::createFromRequest($request), function (Hero $model) {
                /** @var User $user */
                $user = Auth::user();
                if($user->heroes()->count() >= 3){
                    throw new MaxLimitedHeroException;
                }
                $model->user()->associate(Auth::user());
                return $model;
            });
            return HeroResponse::make($entity)->created();
    }
    #[Route("/api/hero/{id}", methods:["GET"])]
    public function show(int $id): HeroResponse
    {
        $hero = $this->entityMediatr->get('id', $id);
        return HeroResponse::make($hero);
    }
    #[Route("/api/hero", methods:["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $id = Auth::id();
        $heroes = $this->entityMediatr->all(AllHeroDTO::createFromUser($id), function(Hero $model) use($id) {
            return $model::where('user_id', $id)->get();
        });
        return HeroResponse::collection($heroes);
    }

    #[Route("/api/hero/{id}", methods: ["PATCH"])]
    public function update(UpdateHeroRequest $request, int $id): HeroResponse
    {
        $hero = $this->entityMediatr->update($id, UpdateHeroDTO::createFromRequest($request));
        return HeroResponse::make($hero);
    }

    #[Route("/api/hero", methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->entityMediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
