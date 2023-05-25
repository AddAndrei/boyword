<?php

namespace App\Http\Services\Auth;


use App\Http\DTO\Auth\RegisterDTO;
use App\Http\Services\Service;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UserService extends Service
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
