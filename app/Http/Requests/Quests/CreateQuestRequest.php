<?php

namespace App\Http\Requests\Quests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestRequest extends FormRequest
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
            'title' => 'string|required|min:8|max:150',
            'description' => 'string|required|min:8',
            'parent_id' => 'integer|nullable|exists:quests,id',
            'npc_id' => 'integer|required|exists:npcs,id',
            'condition_id' => 'integer|required|exists:condition_accept_quests,id',
        ];
    }
}
