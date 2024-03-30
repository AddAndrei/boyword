<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BanUserRequest
 * @package App\Http\Requests\Auth
 * @property int $ban_time
 * @property string $reason
 * @property int $user_id
 * @author Shcerbakov Andrei
 */
class BanUserRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only(
            [
                'ban_time',
                'reason',
                'user_id',
            ]
        );
    }

    public function rules(): array
    {
        return [
            'ban_time' => 'integer|required',
            'reason' => 'string|required',
            'user_id' => 'integer|required|exists:users,id',
        ];
    }
}
