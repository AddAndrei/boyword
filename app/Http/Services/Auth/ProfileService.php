<?php

namespace App\Http\Services\Auth;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProfileService
{

    public function get(int $id): Model
    {
        return User::with([
            'profile',
            'profile.rating',
            'adds',
            'profile.reviews',
            'profile.image',
            'profile.balance',
        ])->where('id', $id)->firstOrFail();
    }
}
