<?php

namespace App\Http\Interfaces\Notifications;

use App\Models\BaseModel;

interface NotificationInterface
{
    public function notifiable(BaseModel $model): void;
}
