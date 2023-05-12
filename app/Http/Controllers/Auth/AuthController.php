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
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{
    public function __construct(private UserService $service)
    {
    }

    #[Route("/api/register", methods: ["POST"])]
    public function register(RegisterRequest $request): UserResponse|Application|ResponseFactory|Response
    {
        try {
            $dto = RegisterDTO::createFromRequest($request);
            $user = $this->service->store($dto);
            return UserResponse::make($user)
                ->setStatusCode(SymfonyResponse::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->jsonException($e);
        }
    }

    #[Route("/api/logout", methods: ["POST"])]
    public function logout(Request $request): Application|ResponseFactory|Response|LogoutResponse
    {
        try {
            $request->user()->tokens()->delete();
            return LogoutResponse::make($request);
        } catch (Exception $e) {
            return $this->jsonException($e);
        }
    }

    #[Route("/api/login", methods: ["GET"])]
    public function login(LoginRequest $request): UserResponse|Application|ResponseFactory|Response
    {
        try {
            $dto = LoginDTO::createFromRequest($request);
            $user = $this->service->login($dto);
            return UserResponse::make($user);
        } catch (Exception $e) {
            return $this->jsonException($e);
        }
    }
}
