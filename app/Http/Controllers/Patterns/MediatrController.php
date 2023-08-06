<?php

namespace App\Http\Controllers\Patterns;

use App\Http\Controllers\Controller;
use App\Http\DTO\BookDTO;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use App\Http\Requests\BookRequest;
use App\Http\Responses\BookResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Books\Book;
use Symfony\Component\Routing\Annotation\Route;

class MediatrController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new Book(), new Service());
    }

    #[Route("/api/mediatr", methods: ["POST"])]
    public function store(BookRequest $request): BookResponse|Application|ResponseFactory|Response
    {
            $entity =  $this->entityMediatr->store(BookDTO::createFromRequest($request));
            return BookResponse::make($entity)->setStatusCode(SymfonyResponse::HTTP_CREATED);
    }

}
