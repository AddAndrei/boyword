<?php

namespace App\Http\Controllers\Balance;

use App\Exceptions\AnotherExceptions\InsufficientFundsException;
use App\Http\Controllers\Controller;
use App\Http\DTO\Balance\BalanceDTO;
use App\Http\Requests\Balance\BalanceRequest;
use App\Http\Responses\OkResponse;
use App\Http\Services\Auth\BalanceService;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Auth\Balance;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class BalanceController extends Controller
{
    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Balance(), new Service());
    }


    /**
     * @param BalanceRequest $request
     * @return OkResponse
     * @throws UnknownProperties
     */
    #[Route('/api/balance', methods: ["POST"])]
    public function put(BalanceRequest $request): OkResponse
    {
        $dto = BalanceDTO::createFromRequest($request);
        $this->mediatr->store($dto, fn (Balance $balance) => BalanceService::setBalance($balance, $dto));
        return OkResponse::make([])->created();
    }
}
