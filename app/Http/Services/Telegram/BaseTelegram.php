<?php

namespace App\Http\Services\Telegram;

use JsonException;
use Telegram\Bot\Laravel\Facades\Telegram;

abstract class BaseTelegram
{
    protected string $botName = "caperDotabot";
    protected string $username = "caper_dota_bot";
    protected int $chat_id = -1002844691045;

    /** @throws JsonException */
    protected function send(array $query): void
    {

        if (count($query['media']) === 1) {
            Telegram::sendPhoto([
                'chat_id' => $this->chat_id,
                'photo' => $query['media'][0]['media'],
                'caption' => $query['text'],
                'parse_mode' => 'html'
            ]);
        } else {
            Telegram::sendMediaGroup([
                'chat_id' => $this->chat_id,
                'media' => json_encode($query['media'], JSON_THROW_ON_ERROR),
            ]);
        }
    }
}
