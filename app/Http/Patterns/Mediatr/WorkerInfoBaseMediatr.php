<?php

namespace App\Http\Patterns\Mediatr;

use App\Http\Interfaces\Mediatr\Mediatr;

class WorkerInfoBaseMediatr implements Mediatr
{

    public function __construct(private Worker $worker, private InfoBase $infoBase)
    {
    }

    public function getWorker(): void
    {
        $this->infoBase->printInfo($this->worker);
    }
}
