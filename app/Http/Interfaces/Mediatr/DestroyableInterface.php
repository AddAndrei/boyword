<?php

namespace App\Http\Interfaces\Mediatr;

use App\Models\BaseModel;

interface DestroyableInterface
{
    public function destroy(BaseModel $model, array $ids): void;
}
