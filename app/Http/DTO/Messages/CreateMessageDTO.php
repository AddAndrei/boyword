<?php

namespace App\Http\DTO\Messages;

use App\Http\DTO\DTO;

class CreateMessageDTO extends DTO
{
    public int $receiver_id;
    public string $message;
}
