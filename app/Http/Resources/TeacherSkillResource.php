<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherSkillResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'teacher_id' => $this->teacher_id,
            'teacher_name' => $this->whenLoaded(
                'teacher',
                fn () => trim($this->teacher->first_name.' '.$this->teacher->last_name)
            ),
            'instrument_id' => $this->instrument_id,
            'instrument_name' => $this->whenLoaded('instrument', fn () => $this->instrument->name),
            'course_id' => $this->course_id,
            'level' => $this->level,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
