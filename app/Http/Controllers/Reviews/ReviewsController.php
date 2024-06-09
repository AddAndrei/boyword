<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Responses\Auth\ReviewResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Reviews\Review;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Review(), new Service());
    }

    #[Route('/api/reviews', methods: ["GET"])]
    public function get(): AnonymousResourceCollection
    {
        $reviews = $this->mediatr->all(closure:  fn(Review $review)
        => $review->where('reviewable_id', Auth::user()->profile->id)
            ->orderBy('id', 'DESC')
            ->get()
        );
        return ReviewResponse::collection($reviews);
    }


    public function getReviews(int $id)
    {

    }

}
