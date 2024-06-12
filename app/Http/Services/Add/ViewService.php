<?php

namespace App\Http\Services\Add;

use App\Http\DTO\Adds\GetAddDTO;
use App\Models\Adds\Add;
use App\Models\Adds\View;

class ViewService
{
    public static function createView(GetAddDTO $dto, Add $add): void
    {
        if($dto->device_id && !View::where([['device', $dto->device_id], ['viewable_id', $add->id]])->exists()) {
            /** @var $res Add*/
            $view = new View();
            $view->device = $dto->device_id;
            $add->views()->save($view);
        }
    }
}
