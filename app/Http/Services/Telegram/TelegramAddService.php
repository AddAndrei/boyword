<?php

namespace App\Http\Services\Telegram;


use App\Http\Interfaces\Notifications\NotificationInterface;
use App\Models\Adds\Add;
use App\Models\BaseModel;
use App\Models\Image\Image;
use Illuminate\Support\Collection;
use JsonException;
use Telegram\Bot\Objects\InputMedia\InputMedia;

class TelegramAddService extends BaseTelegram implements NotificationInterface
{
    /** @throws JsonException */
    public function notifiable(BaseModel $model): void
    {
        /** @var Add $model */
        $text = view('templates.notifable', ['model' => $model])->render();
        $media = $this->createMedia($model->images, $text);
        $query = [
            "text" => $text,
            "media" => $media,
        ];
        $this->send($query);
    }

    private function createMedia(Collection $images, string $text): array
    {
        $media = [];
        foreach ($images as $i => $image) {
            $arr = [
                'type' => 'photo',
                'media' => $image->url,
            ];
            if ($i === $images->count() - 1) {
                $arr['caption'] = $text;
                $arr['parse_mode'] = 'html';
            }
            /** @var Image $image */
            $media[] = InputMedia::make($arr);
        }
        return $media;
    }

}
