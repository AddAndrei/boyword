<?php

namespace App\Http\Responses\Message;

use App\Http\Responses\Response;
use App\Models\Message\ChatRequest;
use Illuminate\Http\Request;

class MessageResponse extends Response
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
                ? $this->sender->id
                : null,
            'receiver' => $this->relationLoaded('receiver')
                ? $this->receiver->id
                : null,
            'chat' => $this->relationLoaded('chat')
                ? ChatResponse::make($this->chat)
                : null,
            'unreadable' => $this->relationLoaded('unreadable')
                ? $this->unreadable()->count()
                : null,
        ];
    }
}
