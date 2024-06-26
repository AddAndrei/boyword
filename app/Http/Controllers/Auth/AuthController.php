<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\Auth\LoginDTO;
use App\Http\DTO\Auth\RegisterDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Auth\LogoutResponse;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Services\Auth\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties as UnknownPropertiesAlias;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{
    public function __construct(private UserService $service)
    {
    }

    /**
     * @throws UnknownPropertiesAlias
     */
    #[Route("/api/register", methods: ["POST"])]
    public function register(RegisterRequest $request): UserResponse|Application|ResponseFactory|Response
    {
        $dto = RegisterDTO::createFromRequest($request);
        $user = $this->service->store($dto);
        return UserResponse::make($user)->created();
    }

    #[Route("/api/logout", methods: ["POST"])]
    public function logout(Request $request): Application|ResponseFactory|Response|LogoutResponse
    {
        $request->user()->tokens()->delete();
        return LogoutResponse::make($request);
    }

    /**
     * @param LoginRequest $request
     * @return UserResponse|Application|ResponseFactory|Response
     * @throws UnknownPropertiesAlias
     * @throws Exception
     */
    #[Route("/api/login", methods: ["GET"])]
    public function login(LoginRequest $request): UserResponse|Application|ResponseFactory|Response
    {
        $dto = LoginDTO::createFromRequest($request);
        $user = $this->service->login($dto);
        return UserResponse::make($user);
    }
}
