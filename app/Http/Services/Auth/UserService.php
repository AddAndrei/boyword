<?php

namespace App\Http\Services\Auth;

use App\Exceptions\Auth\InvalidPasswordException;
use App\Exceptions\Auth\UserExistedException;
use App\Http\DTO\Auth\CreateCodeDTO;
use App\Http\DTO\Auth\LoginDTO;
use App\Http\DTO\Auth\RegisterDTO;
use App\Http\DTO\Auth\ResetPasswordDTO;
use App\Http\DTO\Auth\VerifyCodeDTO;
use App\Http\Responses\OkResponse;
use App\Models\Auth\Code;
use App\Models\Auth\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UserService
{
    private const CODE = 6666;
    private const RESET = 'reset';
    private array $methods = [
        1 => "createCodeForNewUser",
        2 => "createCodeForResetPassword",
    ];

    /**
     * @throws UserExistedException
     */
    public function store(DataTransferObject $dto): User
    {
        /** @var  RegisterDTO $dto */
        $this->checkByPhone($dto->phone);
        $user = new User();
        $user->phone = $dto->phone;
        $user->name = $dto->name;
        $user->password = bcrypt($dto->password);
        $user->save();
        $profile = new Profile();
        $profile->name = $dto->name;
        $profile->last_name = $dto->last_name;
        $profile->user()->associate($user);
        $profile->save();
        $user->token = $user->createToken('appToken')->plainTextToken;
        $user->load(['profile']);
        return $user;
    }

    /**
     * @param LoginDTO $dto
     * @return User|InvalidPasswordException
     * @throws Exception
     */
    public function login(DataTransferObject $dto): User|InvalidPasswordException
    {
        /** @var User $user */
        $user = User::where('phone', $dto->phone)->first();
        if ($user && Hash::check($dto->password, $user->password)) {
            $user->token = $user->createToken('appToken')->plainTextToken;
            return $user;
        }
        throw new InvalidPasswordException();
    }

    /**
     * @param CreateCodeDTO $dto
     * @return Code
     */
    public function createCode(CreateCodeDTO $dto): Code
    {
        return call_user_func_array([$this, $this->methods[$dto->action]], [$dto]);
    }

    /**
     * @param string $phone
     * @return void
     * @throws UserExistedException
     */
    private function checkByPhone(string $phone): void
    {
        if(User::where('phone', $phone)->exists()) {
            throw new UserExistedException($phone);
        }
    }

    /**
     * @throws UserExistedException
     */
    private function createCodeForNewUser(CreateCodeDTO $dto): Code
    {
        $this->checkByPhone($dto->numberPhone);
        $code = new Code([
            'phone' => $dto->numberPhone,
            'code' => self::CODE,
        ]);
        $code->save();
        return $code;
    }

    private function createCodeForResetPassword(CreateCodeDTO $dto): Code
    {
        $code = new Code([
            'phone' => $dto->numberPhone,
            'code' => self::CODE,
        ]);
        $code->action = self::RESET;
        $code->save();
        return $code;
    }

    /**
     * @param VerifyCodeDTO $dto
     * @return OkResponse|Response
     */
    public function verify(VerifyCodeDTO $dto): OkResponse|Response
    {
        $code = Code::where([['phone', $dto->numberPhone], ['code' , $dto->code]])->first();
        if($code){
            $code->delete();
            return OkResponse::make([]);
        }
        return new Response(['error' => 'code invalid'], 422);
    }

    /**
     * @param ResetPasswordDTO $dto
     * @return OkResponse|Response
     */
    public function reset(ResetPasswordDTO $dto): OkResponse|Response
    {
        $hasCode = Code::where([['phone', $dto->phone],['action', self::RESET]])->first();
        if($hasCode && User::where('phone', $dto->phone)->exists()) {
            $user = User::where('phone', $dto->phone)->first();
            $user->password = bcrypt($dto->password);
            $user->save();
            $hasCode->delete();
            return OkResponse::make([]);
        }
        return new Response(['error' => 'Не верный код из смс'], 422);
    }

}
