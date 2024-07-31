<?php

namespace App\Http\Controllers\Reviews;

use App\Exceptions\ReviewExceptions\RateReviewException;
use App\Exceptions\ReviewExceptions\ReviewExistedException;
use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\DTO\Review\CreateReviewDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Requests\Reviews\CreateReviewRequest;
use App\Http\Responses\Auth\ReviewResponse;
use App\Http\Responses\OkResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Review\ReviewService;
use App\Http\Services\Service;
use App\Models\Reviews\Review;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends Controller
{
    private EntityMediatr $mediatr;
    private ReviewService $service;
    public function __construct(ReviewService $reviewService)
    {
        $this->mediatr = new EntityMediatr(new Review(), new Service());
        $this->service = $reviewService;
    }

    /**
     * @param CreateReviewRequest $request
     * @return OkResponse
     * @throws RateReviewException
     * @throws UnknownProperties
     * @throws ReviewExistedException
     */
    #[Route('/api/review', methods: ["POST"])]
    public function store(CreateReviewRequest $request): OkResponse
    {
        $dto = CreateReviewDTO::createFromRequest($request);
        $this->service->create($dto);
        return OkResponse::make([])->created();
    }

    /**
     * @param PaginateWithFiltersRequest $request
     * @return AnonymousResourceCollection
     * @throws UnknownProperties
     */
    #[Route('/api/reviews', methods: ["GET"])]
    public function get(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $reviews = $this->mediatr->all(closure:  fn(Review $review)
        => $review->with(['user.profile.image'])
            ->where('reviewable_id', Auth::user()->profile->id)
            ->paginateWithFilters($dto)
        );
        return ReviewResponse::collection($reviews);
    }


    /**
     * @param PaginateWithFiltersRequest $request
     * @param int $id
     * @return AnonymousResourceCollection
     * @throws UnknownProperties
     */
    #[Route('/api/reviews/{id}', methods: ["GET"])]
    public function getReviews(PaginateWithFiltersRequest $request, int $id): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        /** @var User $user */
        $user = User::find($id);
        $user->load('profile');
        $reviews = $this->mediatr->all(
            closure: fn(Review $review) => $review->with(['user.profile.image'])
                ->where('reviewable_id', $user->profile->id)
                ->paginateWithFilters($dto)
        );
        return ReviewResponse::collection($reviews);
    }
}
