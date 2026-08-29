<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherSkillId = $this->route('teacherSkill')?->id;

        return [
            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
                Rule::unique('teacher_skills')
                    ->ignore($teacherSkillId)
                    ->where(function ($query) {
                        return $query
                            ->where('instrument_id', $this->input('instrument_id'))
                            ->where('course_id', $this->input('course_id'));
                    }),
            ],
            'instrument_id' => 'required|integer|exists:instruments,id',
            'course_id' => 'nullable|integer',
            'level' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'teacher_id.required' => 'انتخاب استاد الزامی است.',
            'teacher_id.exists' => 'استاد انتخاب‌شده معتبر نیست.',
            'teacher_id.unique' => 'این استاد قبلاً برای همین ساز (و دوره) ثبت شده است.',
            'instrument_id.required' => 'انتخاب ساز الزامی است.',
            'instrument_id.exists' => 'ساز انتخاب‌شده معتبر نیست.',
        ];
    }
}
