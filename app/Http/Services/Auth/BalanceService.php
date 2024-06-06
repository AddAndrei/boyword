<?php

namespace App\Http\Services\Auth;

use App\Exceptions\AnotherExceptions\InsufficientFundsException;
use App\Http\DTO\Balance\BalanceDTO;
use App\Models\Auth\Balance;
use Illuminate\Support\Facades\Auth;

class BalanceService
{
    private const INCREMENT = 'increment';
    private const DECREMENT = 'decrement';

    public  static function setBalance(Balance $balance, BalanceDTO $dto): Balance
    {
        $profile = Auth::user()->profile;
        /* @var Balance $lastBalance * */
        $lastBalance = Balance::where('profile_id', $profile->id)->latest()->first();
        $balance->profile()->associate($profile);
        $balance->rate = (float)$dto->rate;
        if ($lastBalance && $dto->operator === self::DECREMENT) {
            if ($lastBalance->balance < $dto->rate) {
                throw new InsufficientFundsException();
            }
            $balance->balance = $lastBalance->balance - (float)$dto->rate;
            return $balance;
        }
        if ($lastBalance && $dto->operator === self::INCREMENT) {
            $balance->balance = ($lastBalance->balance + (float)$dto->rate);
            return $balance;
        }
        $balance->balance = (float)$dto->rate;
        return $balance;
    }
}
