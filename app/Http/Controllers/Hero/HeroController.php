<?php

namespace App\Http\Controllers\Hero;

use App\Http\Controllers\Controller;
use App\Http\DTO\Hero\HeroCreateDTO;
use App\Http\Requests\Hero\HeroCreateRequest;
use App\Http\Responses\Hero\HeroResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\Hero\Hero;
use Exception;

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
                    throw new Exception("Max limited heroes in account, max limit 3 heroes!", 422);
                }
                $model->user()->associate(Auth::user());
                return $model;
            });
            return HeroResponse::make($entity)->created();
    }
}
