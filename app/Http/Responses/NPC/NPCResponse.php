<?php

namespace App\Http\Responses\NPC;

use App\Http\Responses\Response;
use App\Models\Npc\Npc;
use Illuminate\Http\Request;

class NPCResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Npc $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
        ];
    }
}
