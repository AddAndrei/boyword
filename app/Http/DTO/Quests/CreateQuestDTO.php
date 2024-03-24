<?php

namespace App\Http\DTO\Quests;

use App\Http\DTO\DTO;

class CreateQuestDTO extends DTO
{
    public string $title;
    public string $description;
    public ?int $parent_id;
    public int $npc_id;
    public ?int $condition_id;
}
