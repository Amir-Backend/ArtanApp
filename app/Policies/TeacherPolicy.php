<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;

class TeacherPolicy
{
    /**
     * NOTE: ماژول احراز هویت و نقش‌ها (users/roles/role_user) هنوز پیاده‌سازی نشده.
     * پارامتر User عمداً nullable است تا کاربر مهمان (قبل از پیاده‌سازی لاگین) قفل نشه.
     * بعد از ساخت ماژول Authentication و اضافه شدن middleware `auth`،
     * کافیه این‌جا شرط‌های نقش (مثلاً $user->hasRole('manager')) اضافه بشه؛
     * کنترلر و روت‌ها نیازی به تغییر ندارن.
     */

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Teacher $teacher): bool
    {
        return true;
    }

    public function create(?User $user): bool
    {
        return true;
    }

    public function update(?User $user, Teacher $teacher): bool
    {
        return true;
    }

    public function delete(?User $user, Teacher $teacher): bool
    {
        return true;
    }

    public function restore(?User $user, Teacher $teacher): bool
    {
        return true;
    }

    public function forceDelete(?User $user, Teacher $teacher): bool
    {
        return true;
    }
}
