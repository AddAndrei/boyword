<?php

namespace App\Jobs;

use App\Api\YandexDisk;
use App\Http\Services\Image\ImagesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadImageToDiskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private YandexDisk $disk;

    private array $images;
    private int $addId;
    private int $userId;

    public function __construct(YandexDisk $disk, array $images, int $addId, int $userId)
    {
        $this->disk = $disk;
        $this->images = $images;
        $this->addId = $addId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {

        foreach($this->images as $image) {
            /** @var  UploadedFile $image */
            $imageName = Storage::disk('time')->put('', $image->getBasename());
            $path = Storage::disk('time')->path('');
            $path .= $imageName;
            $newPath = storage_path("app/images/time/");
            $imageWebp = ImagesService::convertImage($path, $newPath);
            Storage::disk('time')->delete($imageName);
            $webpName = last(explode('/', $imageWebp));
            dump($webpName);

        }
    }
}
