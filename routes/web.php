<?php

use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSkillController;

Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('instruments', InstrumentController::class);
Route::resource('teacher-skills', TeacherSkillController::class)
    ->parameter('teacher-skills', 'teacherSkill');
