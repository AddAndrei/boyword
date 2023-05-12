<?php

namespace App\Models;


use App\Http\DTO\DataTransferObject;
use Illuminate\Database\Eloquent\Model;

class SlavaModel extends Model
{
    public function propagateFromDTO(DataTransferObject $dto): self
    {
        foreach ($dto->toArray() as $field => $value) {
            if (array_key_exists($field, $this->attributes) || $this->hasGetMutator($field)) {
                $this->$field = $value;
            }
        }
        return $this;
    }
}
