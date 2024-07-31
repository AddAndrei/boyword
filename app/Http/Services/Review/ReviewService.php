<?php

namespace App\Http\Services\Review;

use App\Exceptions\ReviewExceptions\RateReviewException;
use App\Exceptions\ReviewExceptions\ReviewExistedException;
use App\Http\DTO\Review\CreateReviewDTO;
use App\Models\Auth\Profile;
use App\Models\Auth\Rating;
use App\Models\Reviews\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function create(CreateReviewDTO $dto): void
    {
        if (Review::where([['user_id', Auth::id()], ['reviewable_id', $dto->profile_id]])->exists()) {
            throw new ReviewExistedException();
        }
        $profile = Profile::find($dto->profile_id);
        $review = new Review();
        $review->review = $dto->review;
        $review->user_id = Auth::id();
        $profile->reviews()->save($review);
        if ($dto->rate) {
            if ($dto->rate > 0 && $dto->rate <= 5) {
                $rating = new Rating();
                $rating->rate = $dto->rate;
                $rating->user_id = Auth::id();
                $profile->rating()->save($rating);
            } else {
                throw new RateReviewException();
            }
        }
    }
}
