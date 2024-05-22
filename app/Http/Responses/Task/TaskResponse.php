<?php

namespace App\Http\Responses\Task;

use App\Http\Responses\Auth\CreatorResponse;
use App\Http\Responses\Response;
use App\Models\Tasks\Task;
use Illuminate\Http\Request;

class TaskResponse extends Response
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Task $this */
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'start_date' => $this->start_date ? $this->start_date->toIso8601String() : null,
            'end_date' => $this->end_date ? $this->end_date->toIso8601String() : null,
            'creator' => $this->relationLoaded('creator')
                ? CreatorResponse::make($this->creator)
                : null,
        ];
    }
}
