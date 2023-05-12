<?php

namespace App\Http\DTO\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject
{
    public string $email;

    public string $password;

    public static function createFromRequest(FormRequest $request): static
    {
        /** @var LoginRequest $request */
        return new static([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}
