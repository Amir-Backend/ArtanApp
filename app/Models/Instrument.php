<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * تمام رکوردهای مهارت (ارتباط استاد با این ساز).
     */
    public function teacherSkills(): HasMany
    {
        return $this->hasMany(TeacherSkill::class);
    }

    /**
     * اساتیدی که این ساز را تدریس می‌کنند.
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_skills')
            ->withPivot(['course_id', 'level'])
            ->withTimestamps();
    }
}
