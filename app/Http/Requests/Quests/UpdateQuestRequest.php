<?php

namespace App\Http\Requests\Quests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateQuestRequest
 * @package App\Http\Requests\Quests
 * @author Shcerbakov Andrei
 */
class UpdateQuestRequest extends FormRequest
{
    public function validationData(): array
    {
        return $this->only([
            'title',
            'description',
            'parent_id',
            'npc_id',
            'condition_id',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'string|nullable|min:8|max:150',
            'description' => 'string|nullable|min:8',
            'parent_id' => 'integer|nullable|exists:quests,id',
            'npc_id' => 'integer|nullable|exists:npcs,id',
            'condition_id' => 'integer|nullable|exists:condition_accept_quests,id',
        ];
    }
}
