<?php

namespace App\Http\Responses\Quest;

use App\Http\Responses\NPC\NPCResponse;
use App\Http\Responses\Response;
use App\Models\Quests\Quest;
use Illuminate\Http\Request;

/**
 * Class QuestResponse
 * @package App\Http\Responses\Quest
 * @mixin Quest
 * @author Shcerbakov Andrei
 */
class QuestResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'description' => $this->description,
            'parent' => $this->relationLoaded('parent')
                ? QuestResponse::make($this->parent)
                : null,
            'npc' => $this->relationLoaded('npc')
                ? NPCResponse::make($this->npc)
                : null,
            'condition' => $this->relationLoaded('condition')
                ? ConditionAcceptQuestResponse::make($this->condition)
                : null,
        ];
    }
}
