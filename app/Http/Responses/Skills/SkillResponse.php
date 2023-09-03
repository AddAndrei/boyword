<?php

namespace App\Http\Responses\Skills;

use App\Http\Responses\Image\ImageResponse;
use App\Http\Responses\Response;
use App\Models\Skills\Skill;
use Illuminate\Http\Request;

class SkillResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Skill $this */
        return [
            'id' => $this->getKey(),
            'level' => $this->level,
            'experience' => $this->experience,
            'attack_speed' => $this->attack_speed,
            'damage' => $this->damage,
            'skill_type' => $this->skill_type,
            'parent_id' => $this->parent_id,
            'image' => $this->relationLoaded('image')
                ? ImageResponse::make($this->image)
                : null,
        ];
    }
}
