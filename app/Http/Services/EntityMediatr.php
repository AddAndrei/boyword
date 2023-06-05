<?php

namespace App\Http\Services;

use App\Http\DTO\DTO;
use App\Http\Interfaces\Mediatr;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\DataTransferObject;

class EntityMediatr implements Mediatr
{
    public function __construct(private BaseModel $model, private Service $service)
    {
    }

    public function store(DTO $dataTransferObject): Model
    {
        return $this->service->store($this->model, $dataTransferObject);
    }
}
