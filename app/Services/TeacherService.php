<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TeacherService
{
    /**
     * لیست صفحه‌بندی‌شده‌ی اساتید.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Teacher::query()->latest()->paginate($perPage);
    }

    /**
     * ثبت استاد جدید.
     */
    public function create(array $data): Teacher
    {
        return DB::transaction(fn () => Teacher::create($data));
    }

    /**
     * ویرایش اطلاعات استاد.
     */
    public function update(Teacher $teacher, array $data): Teacher
    {
        DB::transaction(function () use ($teacher, $data) {
            $teacher->update($data);
        });

        return $teacher->refresh();
    }

    /**
     * حذف نرم (Soft Delete) استاد.
     */
    public function delete(Teacher $teacher): bool
    {
        return $teacher->delete();
    }

    /**
     * بازگردانی استاد حذف‌شده.
     */
    public function restore(Teacher $teacher): bool
    {
        return $teacher->restore();
    }
}
