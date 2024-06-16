<?php

namespace App\Models\Message;

use App\Models\Auth\Profile;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $message
 * @property boolean $readable
 * @property int $chat_request_id
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Profile $sender
 * @property Profile $receiver
 * @property ChatRequest $chatRequest
 */
class Chat extends BaseModel
{
    protected $table = 'chats';

    protected $fillable = [
        'message',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'receiver_id');
    }

    public function chatRequest(): BelongsTo
    {
        return $this->belongsTo(ChatRequest::class, 'chat_request_id');
    }
}
