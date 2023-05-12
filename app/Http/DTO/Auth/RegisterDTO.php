<?php

namespace App\Http\DTO\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class RegisterDTO
 * @package App\Http\DTO\Auth
 *
 * @author Shcerbakov Andrei
 */
class RegisterDTO extends DataTransferObject
{

    public string $email;

    public string $password;
    public string $password_confirmation;

    /**
     * @param FormRequest $request
     * @return static
     * @throws UnknownProperties
     */
    public static function createFromRequest(FormRequest $request): static
    {
        /** @var RegisterRequest $request */
        return new static([
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
    }
}
