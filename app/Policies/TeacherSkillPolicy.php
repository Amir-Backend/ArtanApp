<?php

namespace App\Policies;

use App\Models\TeacherSkill;
use App\Models\User;

class TeacherSkillPolicy
{
    /**
     * NOTE: ماژول احراز هویت و نقش‌ها هنوز پیاده‌سازی نشده (مثل TeacherPolicy).
     * پارامتر User عمداً nullable است تا کاربر مهمان قفل نشه.
     */

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, TeacherSkill $teacherSkill): bool
    {
        return true;
    }

    public function create(?User $user): bool
    {
        return true;
    }

    public function update(?User $user, TeacherSkill $teacherSkill): bool
    {
        return true;
    }

    public function delete(?User $user, TeacherSkill $teacherSkill): bool
    {
        return true;
    }
}
