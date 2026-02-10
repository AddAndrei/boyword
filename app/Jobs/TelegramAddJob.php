<?php

namespace App\Jobs;

use App\Http\Services\Telegram\BaseTelegram;
use App\Http\Services\Telegram\TelegramAddService;
use App\Models\BaseModel;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JsonException;

class TelegramAddJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private BaseModel $model)
    {

    }

    /**
     * @throws JsonException
     */
    public function handle(TelegramAddService $telegramAddService): void
    {
        $telegramAddService->notifiable($this->model);
    }
}
