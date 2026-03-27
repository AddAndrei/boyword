<?php

namespace App\Http\Responses\Message;

use App\Http\Responses\Auth\ProfileResponse;
use App\Http\Responses\Response;
use App\Models\Message\Chat;
use Illuminate\Http\Request;

class ChatResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Chat $this */
        return [
            'id' => $this->getKey(),
            'date' => $this->created_at ? $this->created_at->toIso8601String() : null,
            'sender' => $this->relationLoaded('sender')
                ? ProfileResponse::make($this->sender)
                : null,
            'message' => $this->message,
            'status' => $this->readable,
        ];
    }
}
