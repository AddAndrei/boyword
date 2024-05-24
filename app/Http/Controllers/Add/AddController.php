<?php

namespace App\Http\Controllers\Add;

use App\Http\Controllers\Controller;
use App\Http\DTO\Adds\CreateAddDTO;
use App\Http\Requests\Adds\CreateAddRequest;
use App\Http\Responses\Add\AddResponse;
use App\Http\Services\Add\AddService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Adds\Add;

class AddController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Add(), new Service());
    }

    public function store(CreateAddRequest $request): AddResponse
    {
        $dto = CreateAddDTO::createFromRequest($request);
        $add = $this->mediatr->store($dto, fn(Add $add) =>  AddService::create($add, $dto));
        return AddResponse::make($add)->created();
    }

}
