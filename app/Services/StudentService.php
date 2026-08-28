<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class StudentService
{
    /**
     * لیست صفحه‌بندی‌شده‌ی هنرجویان.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Student::query()->latest()->paginate($perPage);
    }

    /**
     * ثبت هنرجوی جدید.
     */
    public function create(array $data): Student
    {
        return DB::transaction(fn () => Student::create($data));
    }

    /**
     * ویرایش اطلاعات هنرجو.
     */
    public function update(Student $student, array $data): Student
    {
        DB::transaction(function () use ($student, $data) {
            $student->update($data);
        });

        return $student->refresh();
    }

    /**
     * حذف نرم (Soft Delete) هنرجو.
     */
    public function delete(Student $student): bool
    {
        return $student->delete();
    }

    /**
     * بازگردانی هنرجوی حذف‌شده.
     */
    public function restore(Student $student): bool
    {
        return $student->restore();
    }
}
