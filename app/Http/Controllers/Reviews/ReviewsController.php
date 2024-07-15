<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Auth\ReviewResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Reviews\Review;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Review(), new Service());
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
        $reviews = $this->mediatr->all(
            closure: fn(Review $review) => $review->with(['user.profile.image'])
                ->where('reviewable_id', $id)
                ->paginateWithFilters($dto)
        );
        return ReviewResponse::collection($reviews);
    }
}
