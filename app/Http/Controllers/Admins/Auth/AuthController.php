<?php

namespace App\Http\Controllers\Admins\Auth;

use App\Http\Controllers\Admins\AdminController;
use App\Http\DTO\Auth\LoginDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Services\Auth\UserService;
use Exception;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AdminController
{
    public function __construct(private UserService $service)
    {
    }

    /**
     * @param LoginRequest $request
     * @return UserResponse
     * @throws UnknownProperties
     * @throws Exception
     */
    #[Route('/api/admin/login', methods: ["POST"])]
    public function login(LoginRequest $request): UserResponse
    {
        $dto = LoginDTO::createFromRequest($request);
        $user = $this->service->login($dto, true);
        return UserResponse::make($user);
    }
}
