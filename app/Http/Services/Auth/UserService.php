<?php

namespace App\Http\Services\Auth;

use App\Http\DTO\Auth\LoginDTO;
use App\Http\DTO\Auth\RegisterDTO;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UserService
{
    public function store(DataTransferObject $dto): User
    {
        /** @var  RegisterDTO $dto */
        $user = new User();
        $user->email = $dto->email;
        $user->name = $dto->name;
        $user->password = bcrypt($dto->password);
        $user->save();
        $user->token = $user->createToken('appToken')->plainTextToken;
        return $user;
    }

    /**
     * @param LoginDTO $dto
     * @return User|Exception
     * @throws Exception
     */
    public function login(DataTransferObject $dto): User|Exception
    {
        /** @var User $user */
        $user = User::where('email', $dto->email)->first();
        if ($user && Hash::check($dto->password, $user->password)) {
            $user->token = $user->createToken('appToken')->plainTextToken;
        }
        return $user ?: throw new Exception("bad creds");
    }
}
