<?php

namespace App\Http\Controllers\Rows;

use App\Http\Controllers\Controller;
use App\Http\DTO\Rows\RowSortingDTO;
use App\Http\Requests\Rows\RowRequest;
use App\Http\Responses\Rows\RowResponse;
use App\Http\Services\Rows\RowService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\Routing\Annotation\Route;

class RowsController extends Controller
{
    public function __construct(private RowService $service)
    {
    }

    #[Route("/api/rows", methods: ["GET"])]
    public function show(RowRequest $request): Application|ResponseFactory|AnonymousResourceCollection|Response
    {
        $sortingDTO = RowSortingDTO::createFromRequest($request);
        $rows = $this->service->get($sortingDTO);
        return RowResponse::collection($rows);
    }

}
