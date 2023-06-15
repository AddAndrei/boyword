<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\Auth\UserResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function show(): UserResponse
    {
        $user = User::with('heroes')->findOrFail(Auth::id());
        return UserResponse::make($user);
    }
}
