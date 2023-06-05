<?php

namespace App\Http\Patterns\Mediatr;

abstract class Worker
{
    public function __construct(private string $position)
    {
    }

    public function work(): string
    {
        return $this->position . ' is working';
    }
}
