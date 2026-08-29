<?php

namespace App\Policies;

use App\Models\Instrument;
use App\Models\User;

class InstrumentPolicy
{
    /**
     * NOTE: ماژول احراز هویت و نقش‌ها هنوز پیاده‌سازی نشده (مثل TeacherPolicy).
     * پارامتر User عمداً nullable است تا کاربر مهمان قفل نشه.
     */

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Instrument $instrument): bool
    {
        return true;
    }

    public function create(?User $user): bool
    {
        return true;
    }

    public function update(?User $user, Instrument $instrument): bool
    {
        return true;
    }

    public function delete(?User $user, Instrument $instrument): bool
    {
        return true;
    }

    public function restore(?User $user, Instrument $instrument): bool
    {
        return true;
    }

    public function forceDelete(?User $user, Instrument $instrument): bool
    {
        return true;
    }
}
