<?php

namespace App\Services;

use App\Models\TeacherSkill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TeacherSkillService
{
    /**
     * لیست صفحه‌بندی‌شده‌ی مهارت‌های اساتید (با ارتباطات لازم برای نمایش).
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return TeacherSkill::query()
            ->with(['teacher', 'instrument'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * مهارت‌های مربوط به یک استاد خاص.
     */
    public function forTeacher(int $teacherId)
    {
        return TeacherSkill::query()
            ->with('instrument')
            ->where('teacher_id', $teacherId)
            ->latest()
            ->get();
    }

    /**
     * ثبت اتصال جدید بین استاد و ساز.
     */
    public function create(array $data): TeacherSkill
    {
        return DB::transaction(fn () => TeacherSkill::create($data));
    }

    /**
     * ویرایش رکورد مهارت.
     */
    public function update(TeacherSkill $teacherSkill, array $data): TeacherSkill
    {
        DB::transaction(function () use ($teacherSkill, $data) {
            $teacherSkill->update($data);
        });

        return $teacherSkill->refresh();
    }

    /**
     * حذف رکورد مهارت (Hard Delete؛ این جدول واسط، soft delete ندارد).
     */
    public function delete(TeacherSkill $teacherSkill): bool
    {
        return $teacherSkill->delete();
    }
}
