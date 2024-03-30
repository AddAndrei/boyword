<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\Response;
use App\Models\User\UserBlock;
use Illuminate\Http\Request;

class UserBlockResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var UserBlock $this */
        return [
            'id' => $this->getKey(),
            'reason' => $this->reason,
            'ban_time' => $this->ban_time->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
