<?php

namespace App\Models;

use App\Http\DTO\DTO;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Заполнение аттрибутов
     *
     * @param DTO $data
     * @return $this
     */
    public function propagateFromDTO(DTO $data): self
    {
        foreach ($data->toArray() as $field => $value) {
            $this->$field = $value;
        }
        return $this;
    }
}
