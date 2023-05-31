<?php

namespace App\Http\Patterns\Mediatr;

class InfoBase
{
    public function printInfo(Worker $worker): void
    {
        echo $worker->work();
    }
}
