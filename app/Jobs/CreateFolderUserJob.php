<?php

namespace App\Jobs;

use App\Api\YandexDisk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateFolderUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $id;
    private YandexDisk $disk;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(YandexDisk $disk, int $id)
    {
        $this->disk = $disk;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->disk->createFolder("Adds/$this->id");
    }
}
