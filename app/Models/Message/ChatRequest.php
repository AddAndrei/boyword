<?php

namespace App\Models\Message;

use App\Models\Auth\Profile;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Collection\Collection;

/**
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $status
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Profile $sender
 * @property Profile $receiver
 * @property Chat $chat
 * @property Collection $unreadable
 */
class ChatRequest extends BaseModel
{
    protected $table = 'chat_requests';

    protected $fillable = [
        'status',
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

    public function chat(): HasOne
    {
        return $this->hasOne(Chat::class, 'chat_request_id', 'id')->latest();
    }

    public function unreadable(): HasMany
    {
        return $this->hasMany(Chat::class, 'chat_request_id', 'id')->where('readable', '=', false);
    }
}
