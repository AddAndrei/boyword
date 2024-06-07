<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\Auth\UserProfileResponse;
use App\Models\Auth\Profile;
use App\Models\Auth\Rating;
use App\Models\Reviews\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    #[Route('/api/profile', methods: ["GET"])]
    public function show(): UserProfileResponse
    {
        /** @var $user User */
        /*$review = new Review();
        $review->review = 'Отзыв';
        $review->user_id = 112;
        $user = User::find(Auth::id());
        $user->profile->reviews()->save($review);
        dd("ok");*/
        $user = User::with([
            'profile',
            'profile.rating',
            'adds',
            'profile.reviews',
            'profile.image',
            'profile.balance',
        ])->where('id', Auth::id())->firstOrFail();
        return UserProfileResponse::make($user);
    }

    public function test()
    {
        $price = request('price');
        $rating = new Rating();
        $rating->rate = $price;
        $profile = Profile::find(5);
        $profile->rating()->save($rating);
        return "ok";
    }
}
