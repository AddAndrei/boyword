<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\Auth\UserProfileResponse;
use App\Http\Services\Auth\ProfileService;
use App\Models\Auth\Profile;
use App\Models\Auth\Rating;
use App\Models\Reviews\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends Controller
{
    private ProfileService $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
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
        $user = $this->service->get(Auth::id());
        //dd($user);
        return UserProfileResponse::make($user);
    }

    #[Route('/api/profile/{id}', methods: ["GET"])]
    public function getProfile(int $id): UserProfileResponse
    {
        $user = $this->service->get($id);
        return UserProfileResponse::make($user);
    }

    public function test()
    {
        $price = request('price');
        $rating = new Rating();
        $rating->rate = $price;
        $rating->user_id = 112;
        $profile = Profile::find(5);
        $profile->rating()->save($rating);
        return "ok";
    }
}
