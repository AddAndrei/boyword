<?php

namespace App\Http\Controllers\Messanger;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Message\DialogResponse;
use App\Http\Responses\Message\DialogUsersResponse;
use App\Http\Responses\Message\MessageResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Message\Chat;
use App\Models\Message\ChatRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends Controller
{
    private EntityMediatr $mediatr;
    private EntityMediatr $chatMediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new ChatRequest(), new Service());
        $this->chatMediatr = new EntityMediatr(new Chat(), new Service());
    }

    #[Route('/api/messages', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $messages = $this->mediatr->all(closure: function (ChatRequest $chat) {
            $chat = $chat::with(['chat.sender', 'chat.receiver', 'sender.image', 'receiver.image'])
                ->where('receiver_id', Auth::user()->profile->id)
                ->orWhere('sender_id', Auth::user()->profile->id)
                ->orderBy('created_at', 'DESC')
                ->get()->unique('sender_id');
            $chat->load('unreadable');
            return $chat;
        });
        return MessageResponse::collection($messages);
    }

    /**
     * @param PaginateWithFiltersRequest $request
     * @param int $id
     * @return AnonymousResourceCollection
     * @throws UnknownProperties
     */
    #[Route('/api/messages/{id}', methods: ["GET"])]
    public function dialog(PaginateWithFiltersRequest $request, int $id): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $messages = $this->chatMediatr->all(closure: function (Chat $chat) use ($id, $dto) {
            return $chat::with(['sender.image', 'receiver.image'])
                ->where('chat_request_id', $id)
                ->paginateWithFilters($dto);

        });
        return DialogResponse::collection($messages);
    }

    /**
     * @param int $id
     * @return DialogUsersResponse
     * @throws EntityNotFoundException
     */
    #[Route('/api/message/users/{id}', methods: ["GET"])]
    public function users(int $id): DialogUsersResponse
    {
        $users = $this->mediatr->get('id', $id, closure: function (ChatRequest $chatRequest) use($id) {
            return $chatRequest::with(['sender.image', 'receiver.image'])->where('id', $id)->firstOrFail();
        });
        return DialogUsersResponse::make($users);
    }
}
