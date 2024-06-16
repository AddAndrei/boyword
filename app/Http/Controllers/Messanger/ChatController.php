<?php

namespace App\Http\Controllers\Messanger;

use App\Http\Controllers\Controller;
use App\Http\Responses\Message\MessageResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Message\Chat;
use App\Models\Message\ChatRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new ChatRequest(), new Service());
    }

    #[Route('/api/messages', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $messages = $this->mediatr->all(closure: function (ChatRequest $chat){
            $chat = $chat::with(['chat.sender.image'])
                ->where('receiver_id', 4)
                ->orderBy('created_at', 'DESC')
                ->get()->unique('sender_id');
            $chat->load('unreadable');
            return $chat;
        });
        return MessageResponse::collection($messages);
    }


}
