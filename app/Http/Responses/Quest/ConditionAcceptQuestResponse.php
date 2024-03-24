<?php

namespace App\Http\Responses\Quest;

use App\Http\Responses\Resources\ResourceResponse;
use App\Http\Responses\Response;
use App\Models\Quests\ConditionAcceptQuest;
use Illuminate\Http\Request;

class ConditionAcceptQuestResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var ConditionAcceptQuest $this */
        return [
            'id' => $this->getKey(),
            'resource' => $this->relationLoaded('resource')
                ? ResourceResponse::make($this->resource)
                : null,
        ];
    }
}
