<?php

namespace App\Http\Services\System;

use App\Models\Color\Color;
use App\Models\Mark\Mark;
use App\Models\Volume\VolumeMemory;

class SystemService
{
    public function getAll(): array
    {
        $marks = Mark::with('models.model')->get();
        $colors = Color::all();
        $memories = VolumeMemory::all();
        return [
            'marks' => $marks,
            'colors' => $colors,
            'memories' => $memories,
        ];
    }
}
