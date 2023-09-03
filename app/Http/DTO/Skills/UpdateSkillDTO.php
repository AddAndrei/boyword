<?php

namespace App\Http\DTO\Skills;

use App\Http\DTO\DTO;

class UpdateSkillDTO extends DTO
{
    public ?int $level;
    public ?int $experience;
    public ?float $attack_speed;
    public ?int $damage;
    public ?string $skill_type;
    public ?int $parent_id;
}
