<?php

namespace App\Http\DTO\Skills;

use App\Http\DTO\DTO;

class CreateSkillDTO extends DTO
{
    public string $skill_type;
    public ?int $parent_id;
}
