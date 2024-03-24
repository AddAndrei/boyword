<?php

namespace App\Http\Services\Quests;

use App\Http\DTO\DTO;
use App\Models\BaseModel;
use App\Models\Npc\Npc;
use App\Models\Quests\ConditionAcceptQuest;
use App\Models\Quests\Quest;

class QuestService
{
    private array $relations = [
        'npc_id' => [
            'entity' => Npc::class,
            'method' => 'npc',
        ],
        'condition_id' => [
            'entity' => ConditionAcceptQuest::class,
            'method' => 'condition'
        ],
        'parent_id' => [
            'entity' => Quest::class,
            'method' => 'parent',
        ],
    ];

    private const DEFAULT_RELATIONS = [
        'npc',
        'condition.resource',
        'parent',
    ];

    public function businessProcess(BaseModel $model, DTO $DTO, array $relations = null): BaseModel
    {
        $loadRelations = $relations ?? self::DEFAULT_RELATIONS;
        $model->updateRelations($DTO, $this->relations);
        $model->load($loadRelations);
        $model->propagateFromDTO($DTO)->save();
        return $model;
    }
}
