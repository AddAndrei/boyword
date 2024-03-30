<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\DTO;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BanDTO extends DTO
{
    public Carbon $ban_time;
    public string $reason;
    public int $user_id;

    public static function createFromRequest(Request $request): static
    {
        return new static([
            'ban_time' => Carbon::now()->addMinutes($request->ban_time),
            'reason' => $request->reason,
            'user_id' => $request->user_id,
        ]);
    }
}
