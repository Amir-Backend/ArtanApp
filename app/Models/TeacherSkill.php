<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'instrument_id',
        'course_id',
        'level',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function instrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class);
    }

    /**
     * NOTE: ماژول Course هنوز ساخته نشده. به محض ساخت app/Models/Course.php
     * این رابطه بدون نیاز به تغییر در بقیه‌ی کد کار خواهد کرد، چون فقط
     * زمانی که واقعاً فراخوانی شود (course()) کلاس Course را نیاز دارد.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
