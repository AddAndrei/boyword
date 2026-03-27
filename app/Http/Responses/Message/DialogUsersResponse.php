<?php

namespace App\Http\Responses\Message;

use App\Http\Responses\Auth\ProfileResponse;
use App\Http\Responses\Response;
use App\Models\Message\ChatRequest;
use Illuminate\Http\Request;

class DialogUsersResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var ChatRequest $this */
        return [
            'id' => $this->getKey(),
            'sender' => $this->relationLoaded('sender')
                ? ProfileResponse::make($this->sender)
                : null,
            'receiver' => $this->relationLoaded('receiver')
                ? ProfileResponse::make($this->receiver)
                : null,
        ];
    }
}
